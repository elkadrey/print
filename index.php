<?php
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

function e($list, $class)
{
    include "templates/messages.php";
}

include "controllers.php";

class printOrder
{
    use homeController;

    protected $errors = [];
    protected $success = [];
    protected $warning = [];

    function printData($data)
    {
        try {
            $connector = new NetworkPrintConnector($data->ip, $data->port);
            $printer = new Printer($connector);
            $printer->text("$data->message\n");
            $printer->cut();
            $this->success[] = "تم طباعة الرسالة للطابعة $data->name ($data->ip:$data->port)";
        } 
        catch(Exception $e)
        {
            $this->errors[] = "خطأ بالطابعة ($data->name) - ".$e->getMessage();
        }
        finally {
            if($printer ?? null) $printer->close();
        }        
    }

    public function order()
    {
        $data = $this->readData();
        if(count($data) > 0)
        {
            foreach($data as $row)
            {
                $this->printData($row);
            }
        }
    }

    public function saveData()
    {
        file_put_contents("data.json", json_encode($_POST['data'] ?? []));
    }

    public function readData(bool $noJson = false)
    {
        $data = file_get_contents('data.json') ?? '[]';
        return $noJson ? $data : (array) json_decode($data);
    }

    public function view($page)
    {
        
        foreach($this->{$page.'Controller'}() as $k=>$v)
        {
            ${$k} = $v;
        }
        $errors = $this->errors;
        $success = $this->success;
        $warning = $this->warning;
        include "templates/main.php";
    }

    public function route()
    {
        return $this->view($_GET['p'] ?? 'home');
    }

    public function start()
    {
        echo $this->route();
    }
}



$app = new printOrder();

$app->start();
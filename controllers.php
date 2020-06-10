<?php

trait homeController
{
    public function homeController()
    {
        if(($_POST ?? null) && isset($_POST['data']) && is_array($_POST['data']))
        {
            $this->saveData();
            $this->success[] = "تم الحفظ بنجاح";
        }
        if(($_POST ?? null) && $_POST['print'] ?? null)
        {
            $this->warning[] = "جارى الطباعة";
            $this->order();
        }
        $printers = $this->readData(true);
        return compact('printers');
    }
}

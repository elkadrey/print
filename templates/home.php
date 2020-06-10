<div class="row">
    <div class="col">
        <form action="" method="POST" class="saving" disabled>
        <div class="pt-2 pb-2">
            <button type="button" class="btn btn-success" onclick="row()">
                إضافة طابعة
            </button>
            <button disabled type="submit"  class="btn btn-primary saving">
                حفظ
            </button>
        
            <button onclick="printData()" type="button" class="btn btn-warning print">
                طباعة
            </button>
        </div>
        <table class="table" id="printers">
            <tr class="table-warning">
                <th>ID</th>
                <th>إسم الطابعة/الوصف</th>
                <th>الآى بى</th>
                <th>البورت</th>
                <th>رسالة الطباعة</th>
                <th style="width: 10%;">الأدوات</th>
            </tr>
            <tbody></tbody>
        </table>
        <div class="pt-2 pb-2">
            <button type="button" class="btn btn-success" onclick="row()">
                إضافة طابعة
            </button>
            <button disabled type="submit"  class="btn btn-primary saving">
                حفظ
            </button>
          
            <button onclick="printData()" type="button" class="btn btn-warning print">
                طباعة
            </button>
        </div>
        </form>
        <form action="" method="POST" id="printing" hidden>
        <input type="name" name="print" value="1" />
        </form>
    </div>
</div>
<style>
    .ltr
    {
        direction: rtl !important;
    }
</style>
<script id="temp" type="text/templates"><?php include "js/printer_temp.php"?></script>
<script id="data" type="text/templates"><?php echo $printers?></script>
<script>
    let canPrint = true;
    let printerCols = {
        id: unique,
        name: function(that)
        {
            return "الطابعه "+that.id;
        },
        ip: function()
        {
            return '<?=$_SERVER['REMOTE_ADDR']?>';
        },
        port: '9100',
        message: 'Test Printing',
    };
    function unique()
    {
        return Math.random().toString(36).substr(2, 9);
    }
    function isString(i) {
        if (i && i != "undefined" && i != undefined)
            if (typeof i == "string" || typeof i == "STRING")
                return true;
    }
    function escapeRegExp(string) {
        return isString(string) ? string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1") : string;
    }
    function strReplace(obj, str) {
        for (var old in obj) {
            var patt = new RegExp(escapeRegExp('{'+old+'}'), 'g');
            str = str.replace(patt, obj[old]);
        }
        return str;
    }
    function isFunction(functionToCheck) {
        return functionToCheck && {}.toString.call(functionToCheck) === '[object Function]';
    }

    function row(id, rs)
    {
        let temp = $('#temp').html();
        
        if(!id) id = unique();
        if(!rs) 
        {
            rs = {};
            canPrint = false;
        }
        
        $.each(printerCols, (key,defaultValue) =>
        {
            rs[key] = !rs[key] ? (isFunction(defaultValue) ? defaultValue(rs) : defaultValue) : rs[key];            
        });
        
        
        temp = strReplace(rs, temp);
        $("#printers tbody:eq(0)").append(temp);
        togglePrinters();
    }

    function removeRow(row)
    {
        $(row).parents('tr:eq(0)').remove();
        togglePrinters(false);
    }

    function togglePrinters(status = null)
    {
        if(status !== null) canPrint = status;
        $(".print")[(canPrint ? 'remove' : 'add')+'Class']('disabled');
        $(".saving").prop('disabled', canPrint);
    }

    function printData(row)
    {
        // let that = $(row);
        // if(that.hasClass('disabled') === true) 
        // {
        //     alert("يرجى حفظ التغييرات أولا قبل الطباعة")
        //     return false;
        // }   

        if(!canPrint) 
        {
            alert("يرجى حفظ التغييرات أولا قبل الطباعة");
            return false;
        }
        $("#printing").submit();
    }

    //workspace
    let printers = JSON.parse($("#data").html());
    $.each(printers, (id, print) => {
        row(id, print);
    });
</script>
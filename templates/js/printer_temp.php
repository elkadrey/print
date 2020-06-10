<tr>
    <td>
        {id}
    </td>
    <td>
        إسم الطابعة        
        <input type="text" name="data[{id}][name]" onblur="togglePrinters(false)" value="{name}" required class="form-control">
    </td>
    <td>
        الآى بى
        <input type="text" maxlength="15" minlength="7" onblur="togglePrinters(false)" name="data[{id}][ip]" value="{ip}" required class="form-control ltr text-center">
    </td>
    <td>
        البورت
        <input type="number" name="data[{id}][port]" onblur="togglePrinters(false)" value="{port}" required class="form-control ltr text-center">
    </td>
    <td style="width: 40%;">
        الرسالة
        <input type="text" name="data[{id}][message]" onblur="togglePrinters(false)" value="{message}" required class="form-control">
    </td>
    <td>
        <button onclick="removeRow(this)" class="btn btn-danger btn-sm">
        حذف
        </button>
        &nbsp;
        <!-- <button onclick="printData(this)" class="btn btn-success btn-sm print">
        طباعة
        </button> -->
    </td>
</tr>
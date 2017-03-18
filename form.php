<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form name='fnm1'>
    <table>
        <tr>
            <td>
                <lable>Origin Zip Code : </lable>
                <input type='text' class='frm_fld' name='org_zip_code' id='org_zip_code' value='04012-090' />
                <span id='org_zip_code_err' class='txterr'></span>
            </td>
        </tr>
        <tr>
            <td>
                <lable>Destination Zip Code : </lable>
                <input type='text' class='frm_fld' name='des_zip_code' id='des_zip_code' value='04037-003' />
                <span id='des_zip_code_err' class='txterr'></span>
            </td>
        </tr>
        <tr>
            <td>
                <lable>Weight : </lable>
                <input type='text' class='frm_fld' name='weight' id='weight' value='0.5' />
                <span id='weight_err' class='txterr'></span>
            </td>
        </tr>            
        <tr>
            <td>
                <lable>Cost of Goods : </lable>
                <input type='text' class='frm_fld' name='cost_of_goods' id='cost_of_goods' value='100' />
                <span id='cost_of_goods_err' class='txterr'></span>
            </td>
        </tr>
        <tr>
            <td>
                <lable>Width : </lable>
                <input type='tel' class='frm_fld' name='width' id='width' value='10' />
                <span id='width_err' class='txterr'></span>
            </td>
        </tr>
        <tr>
            <td>
                <lable>Height : </lable>
                <input type='tel' class='frm_fld' name='height' id='height' value='10' />
                <span id='height_err' class='txterr'></span>
            </td>
        </tr>
        <tr>
            <td>
                <lable>Length : </lable>
                <input type='tel' class='frm_fld' name='length' id='length' value='25' />
                <span id='length_err' class='txterr'></span>
            </td>
        </tr>
        <tr>
            <td>
                <input type='button' value='Calculate' onclick='calculate();' />
            </td>
        </tr>
    </table>
</form>

<span id='cal_result'></span>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type='text/javascript' src='validation.js'></script>
</html>
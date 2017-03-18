function calculate() {
    var valid_flag = true;

    $('.frm_fld').removeClass('err');
    $('.txterr').html('');
    var objRegex = /(^[0-9]+[-]*[0-9]+$)/;
    var field_arr = ['org_zip_code','des_zip_code','weight','cost_of_goods','width','height','length'];
    
    var validate_val = field_arr.map(function(obj) { 
        var vflag = validate_val_fun(obj);
        var vnumflag = validate_val_num_fun(obj);
        var obj1 = obj.replace(/_/g, " ");
        if(vflag == false) {
            $('#'+obj).addClass('err');            
            $('#'+obj+'_err').html(obj1 + ' can not be empty');
            valid_flag = false;
        } else if(vflag == true && (obj == 'org_zip_code' || obj == 'des_zip_code') && objRegex.test($('#'+obj).val()) == false) {
            $('#'+obj).addClass('err');
            $('#'+obj+'_err').html(obj1 + ' value is invalid');
            valid_flag = false;
        } else if(vflag == true && vnumflag == false && obj != 'org_zip_code' && obj != 'des_zip_code') {
            $('#'+obj).addClass('err');
            $('#'+obj+'_err').html(obj1 + ' value is invalid');
            valid_flag = false;
        }
    });
    
    if(valid_flag) {
        var org_zip_code = $('#org_zip_code').val();
        var des_zip_code = $('#des_zip_code').val();
        var weight = $('#weight').val();
        var cost_of_goods = $('#cost_of_goods').val();
        var width = $('#width').val();
        var height = $('#height').val();
        var length = $('#length').val();
        
        $.ajax({
            type: "POST",
            url: 'ajx_cal.php',
            dataType: "text",
            data: {org_zip_code: org_zip_code, des_zip_code: des_zip_code, weight: weight, cost_of_goods: cost_of_goods, width: width, height: height, length: length },
            success: function(result) {
                result = JSON.parse(result);
                var cal_html = '';
                if(result.status == 'OK') {
                    var delivery_options = result.content.delivery_options;
                    //var del_op_len = delivery_options.length;
                    var delivery_options_str = delivery_options.map(function(obj) { 
                        var del_op = '';
                        var unique_id = obj.delivery_method_id;
                        del_op += '<tr>';
                            del_op += '<td><input type="checkbox" class="checkbox_cls" id="chk_'+unique_id+'" onclick="moreInfo(\''+unique_id+'\');" /></td>';
                            del_op += '<td id="days_'+unique_id+'">'+obj.delivery_estimate_business_days+'</td>';
                            del_op += '<td id="cost_'+unique_id+'">'+obj.final_shipping_cost+'</td>';
                            del_op += '<td id="desc_'+unique_id+'">'+obj.description+'</td>';
                        del_op += '</tr>';
                        return del_op;
                    });    

                    cal_html += '<table border="1">';
                        cal_html += '<tr>';
                            cal_html += '<td></td>';
                            cal_html += '<td>Estimate Business Days</td>';
                            cal_html += '<td>Shipping Cost</td>';
                            cal_html += '<td>Description</td>';
                        cal_html += '</tr>';
                        cal_html += delivery_options_str;                        
                    cal_html += '</table>';
                    $('#cal_result').html(cal_html);
                } else {
                    alert(result.messages);
                }
            }
        });
    }

}

function validate_val_fun(obj) {
    return ($('#'+obj).val() != '') ? true : false;
}

function validate_val_num_fun(obj) {
    var obj_val = $('#'+obj).val();
    return (obj_val != '' && !isNaN(obj_val)) ? true : false;
}

function moreInfo(id) {
    if($('#chk_'+id).is(':checked')) {
        var day_txt = ($('#days_'+id).html() == 1) ? 'day' : 'days';
        var str = $('#desc_'+id).html()+', '+$('#cost_'+id).html()+' $, '+$('#days_'+id).html()+' '+day_txt;
        alert(str);
    }
}



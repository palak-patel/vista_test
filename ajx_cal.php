<?php
$params = $_POST;
$response = array();
//echo "<pre>"; print_r($_POST);
if(count($params) > 0) {
    $api_url = 'https://api.intelipost.com.br/api/v1/quote';
    $ch = curl_init();
    $postvars = array();
    
    $postvars['origin_zip_code'] = $params['org_zip_code'];
    $postvars['destination_zip_code'] = $params['des_zip_code'];
    
    $postvars['volumes'][0]['weight'] = $params['weight'];
    $postvars['volumes'][0]['volume_type'] = "BOX";
    $postvars['volumes'][0]['cost_of_goods'] = $params['cost_of_goods'];
    $postvars['volumes'][0]['width'] = $params['width'];
    $postvars['volumes'][0]['height'] = $params['height'];
    $postvars['volumes'][0]['length'] = $params['length'];
    
    $delivery_method_ids_arr = array(1,2,3);

    $postvars['additional_information'] = array(
        'free_shipping' => 'false',
        'extra_cost_absolute' => 0,
        'extra_cost_percentage' => 0,
        'lead_time_business_days' => 0,
        'sales_channel' => 'hotsite',
        'tax_id' => '22337462000127',
        'client_type' => 'gold',
        'payment_type' => 'CIF',
        'is_state_tax_payer' => 'false',
        'delivery_method_ids' => $delivery_method_ids_arr
    );

    $postvars['session'] = '04e5bdf7ed15e571c0265c18333b6fdf1434658753';
    $postvars['page_name'] = 'carrinho';
    $postvars['url'] = 'http://www.intelipost.com.br/checkout/cart/';

    //echo "<pre>"; print_r($postvars);
    $postvars = json_encode($postvars);
    //echo $postvars;

    $header = array(
        "api_key: 9009f95101bf48b01a50928a2a71ed1ae9083fc1d3c08439b0613dfc38e656c5",
        "content-type: application/json",
        "platform: intelipost-docs"
    );
    curl_setopt($ch,CURLOPT_URL,$api_url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch,CURLOPT_POST, 1);               
    curl_setopt($ch,CURLOPT_HTTPHEADER, $header);     
    curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
    curl_setopt($ch,CURLOPT_TIMEOUT, 50);
    $response = curl_exec($ch);
    //echo "<pre>"; print_r(curl_getinfo($ch));
    //echo "<pre>"; print_r(curl_error($ch));
    //echo "<pre>"; print_r($response);    
    curl_close ($ch);
    echo $response;
} else {
    $response['status'] = '0';
    $response['messages'] = 'parameter missing';
    echo json_encode($response);
}
?>
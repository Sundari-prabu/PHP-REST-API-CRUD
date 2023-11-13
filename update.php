<?php
error_reporting(0);
header('Accesss-control-Allow-origin: ');
header('content-Type: application/json');
header('Access-Control_Allow-Method:PUT');
header('Access-Control_Allow-Method:content-Type,Access-Control-Allow-Headers,Authorization,x-Request-with');

include('fn.php');

$requestmethod=$_SERVER["REQUEST_METHOD"];
if($requestmethod=='PUT')
{
$inputData=json_decode(file_get_contents("php[://input").true);
if(empty($inputData))
{
    
    $UpdateCustomer=$UpdateCustomer($_POST,$_GET);
}
else{

 $UpdateCustomer=$UpdateCustomer($inputData,$GET);
}
echo $UpdateCustomer;
}
else{
    $data=[
        'status'=>405,
        'message'=>$req_method.'Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
    ?>

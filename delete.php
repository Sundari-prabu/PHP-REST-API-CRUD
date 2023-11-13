<?php
header('Accesss-control-Allow-origin: ');
header('content-Type: application/json');
header('Access-Control_Allow-Method:DELETE');
header('Access-Control_Allow-Method:content-Type,Access-Control-Allow-Headers,Authorization,x-Request-with');

include('fn.php');

$requestmethod=$_SERVER["REQUEST_METHOD"];
if($requestmethod=="DELETE")
{
    if(isset($_GET['id']))
    {
        $deleteCustomer=deleteCustomer($_GET);
        echo $deleteCustomer;
    }
     else
     {
 $CustomerList=getCustomerList();
 echo $CustomerList;
}
}

else
{
    $data=[
        'status'=>405,
        'message'=>$req_method.'Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>


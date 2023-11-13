<?php

require'../inc/dbcon.php';
function error422($message)
{
    $data=[
        'status'=>422,
        'message'=>$message,
    
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}

function storeCustomer($CustomerInput)
{
    global $conn;

$name=mysqli_real_escape_string($conn,$CustomerInput['name']);
$email=mysqli_real_escape_string($conn,$CustomerInput)['email'];
$phone=mysqli_real_escape_string($conn,$CustomerInput['phone']);

if(empty(trim($name))){
    return error422('Enter your name');

}elseif(empty(trim($email))){
    return error422('Enter your email');

}elseif(empty(trim($phone))){
    return error422('Enter your phone');

}else{
    $query="INSERT INTO  Customers(name,email,phone) values('$name','$email','$phone')";
    $result=mysqli_query($conn,$query);

    if($result)
    {
        $data=[
            'status'=>201,
            'message'=>'Customer Created Successfully';
        ];
        header("HTTP/1.0 201 Created");
        echo json_encode($data);

    }
    else{
        $data=[
            'status'=>500,
            'message'=>'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
    }
}
}

function getCustomerList()
{
global $conn;
$query="SELECT*FROM Customers";
$query_run=mysqli_query($conn,$query);

if($query_run)
{
 if(mysqli_num_rows($query-run)>0)
 {
    $res=mysqli_Fetch_all($query_run,MYSQLI_ASSOC);
    $data=[
        'status'=>200,
        'message'=>'Customer List Fetched Successfully',
        'data'=>$res
    ];
    header("HTTP/1.0 200 Customer List Fetched Successfully");
    echo json_encode($data);
 }
 else
 {
    $data=[
        'status'=>404,
        'message'=>'No Customer Found',
    ];
    header("HTTP/1.0 404 No Customer Found");
    echo json_encode($data);
  }
}
else
{

    $data=[
        'status'=>500,
        'message'=>$req_method.'Method Not Allowed',
    ];
    header("HTTP/1.0 500 Internal Server Error");
    echo json_encode($data);
}
}
function getCustomer($Customerparams)
{
    global $conn;
    if($Customerparams['id']==null) {
        return error422('Enter your name');

}

$CustomerId=mysqli_real_escape_string($conn,$Customerparams['id']);
$qurey="SELECT *FROM Customers WHERE id='$CustomerId' LIMIT 1";
$result=mysqli_query($conn,$query);

if($result)
{
    if(mysqli_num_rows($result)==1)
    {
        $res=mysqli_fetch_assoc($result);
        $data=[
            'status'=>200,
            'message'=>'Customer Fetched Successfully',
            'data'=>$res
        ];
        header("HTTP/1.0 200 Successfully");
        echo json_encode($data);
    }
    else
    {
        $data=[
            'status'=>404,
            'message'=>'No Customer Found',
            
        ];
        header("HTTP/1.0 404 No found");
        echo json_encode($data);
    }
}
}
function UPdateCustomer($CustomerInput,$customerparams)
{
    global $conn;
    if(!isset($Customerparams['id'])){
        return error422("customer id not found in url");
    }elseif($Customerparams['id']==null){
        return error422("enter the customer id");

    }

$name=mysqli_real_escape_string($conn,$CustomerInput['name']);
$email=mysqli_real_escape_string($conn,$CustomerInput['email']);
$phone=mysqli_real_escape_string($conn,$CustomerInput['phone']);

if(empty(trim($name))){
    return error42('Enter your Name');

}elseif(empty(trim($email))){
    return error422('Enter your email');

}elseif(empty(trim($phone))){
    return error422('Enter your phone');

}else{
    $query="UPDATE Customers SET name='$name',email='$email',phone='$phone' WHERE id=' '";
    $result=mysqli_query($conn,$query);

    if($result)
    {
        $data=[
            'status'=>201,
            'message'=>'Customer Updated Successfully';
        ];
        header("HTTP/1.0 201 Created");
        echo json_encode($data);

    }
    else{
        $data=[
            'status'=>500,
            'message'=>'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
    }
}
}
function deleteCustomer($Customerparams)
{
    global $conn;
    if(!isset($Customerparams['id'])){
        return error422("customer id not found in url");
    }elseif($Customerparams['id']==null){
        return error422("enter the customer id");

    $query="DELETE FROM Customers WHERE id='CustomerId' LIMIT 1";
    $result=mysqli_query($conn,$query);
    if($result){
        $data=[
            'status'=>200,
            'message'=>'Customer deleted Successfully',
        ];
        header("HTTP/1.0 204 Deleted");
        echo json_encode($data); 

    }else{
        $data=[
            'status'=>404,
            'message'=>'Customer not Found',
        ];
        header("HTTP/1.0 404 not found");
        echo json_encode($data); 
    }
    }

    }   




?>
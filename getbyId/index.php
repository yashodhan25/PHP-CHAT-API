<?php
include_once './../DBconnector.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');

$id = $_POST['id'];

$select = "SELECT * FROM `conversations` WHERE `id` = '$id' ";
$executeselect = mysqli_query($con, $select);
if($executeselect != false){
    $row = mysqli_num_rows($executeselect);
    for($i=1; $i<=$row; $i++){
        $data = mysqli_fetch_assoc($executeselect);
        $arr[] = $data;
    }
    echo json_encode(['message'=>'got all successfully', 'data'=>$data, 'success'=>true]);
}else{
    echo json_encode(['message'=>'Something Went wrong', 'success'=>false]);
}
?>
<?php
include_once './../DBconnector.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');

$sender = $_POST['email'];

$select = "SELECT * FROM `conversations` WHERE `receiver` IN ('$sender') OR `sender` IN ('$sender') ";
$executeselect = mysqli_query($con, $select);
if($executeselect != false){
    $row = mysqli_num_rows($executeselect);
    if($row != 0){
        for($i=1; $i<=$row; $i++){
            $data = mysqli_fetch_assoc($executeselect);
            $arr[] = $data;
        }
        echo json_encode(['message'=>'got all successfully', 'data'=>$arr, 'success'=>true]);
    }
}else{
    echo json_encode(['message'=>'Something Went wrong', 'success'=>false]);
}
?>
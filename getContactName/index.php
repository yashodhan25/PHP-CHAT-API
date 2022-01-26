<?php
include_once './../DBconnector.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');

$email = $_POST['email'];

$view = mysqli_query($con,"SELECT * FROM `contact` WHERE `email`='$email' ");
if($view == true){
    $row = mysqli_num_rows($view);
    for($i=1; $i<=$row; $i++){
        $data = mysqli_fetch_assoc($view);
        $arr[] = $data;
    }
    echo json_encode(['message'=>'got all successfully', 'data'=>$arr, 'success'=>true]);
}else{
    echo json_encode(['message'=>'Something Went wrong', 'success'=>false]);
}
?>
<?php
include_once './../DBconnector.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');
$data = json_decode(file_get_contents('php://input'), true);

$caption = $data["caption"];
$message = $data["message"];
$receiver = $data["receiver"];
$sender = $data["sender"];
$type = $data["type"];
$date = date("Y-m-d");
date_default_timezone_set("Asia/Calcutta");
$time = date("h:i:sA");

if($sender != '' && $receiver != ''){
    $insert = "INSERT INTO `conversations`(`caption`, `chatdate`, `message`, `receiver`, `sender`, `time`, `type`) 
            VALUES 
            ('$caption','$date','$message','$receiver','$sender','$time','$type')";

    $executeInsert = mysqli_query($con, $insert);

    if($executeInsert == true){
        $get = "SELECT * FROM `conversations` WHERE `chatdate`='$date' AND `receiver`='$receiver' AND `sender`='$sender' AND `type`='$type' ";
        $view = mysqli_query($con,$get);
        $row = mysqli_num_rows($view);
        for($i=1; $i<=$row; $i++){
            $data = mysqli_fetch_assoc($view);
        }
        echo json_encode(['message'=>'got all successfully', 'data'=>$data, 'success'=>true]);
    }else{
        echo json_encode(['message'=>'Something Went wrong', 'success'=>false]);
    }
}
?>
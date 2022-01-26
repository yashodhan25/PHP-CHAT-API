<?php

include_once './../DBconnector.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');
$data = json_decode(file_get_contents('php://input'), true);

$createdByUserEmail = $data['createdByUserEmail'];
$groupName = $data['groupName'];
$is_active = true;
$date = date("Y-m-d");
date_default_timezone_set("Asia/Calcutta");
$time = date("h:i:sA");

if($groupName != ""){

    $insert = "INSERT INTO `group_table`(`gp_table_date`, `group_name`, `is_active`, `time`, `created_by_user_email`) 
            VALUES 
            ('$date','$groupName','$is_active','$time','$createdByUserEmail')";

    $executeInsert = mysqli_query($con, $insert);

    if($executeInsert == true){
        $get = "SELECT * FROM `group_table` WHERE `created_by_user_email`='$createdByUserEmail' ";
        $view = mysqli_query($con,$get);
        $row = mysqli_num_rows($view);
        for($i=1; $i<=$row; $i++){
            $data = mysqli_fetch_assoc($view);
            $groupName = $data['group_name'];
            $id = $data['id'];
            $gpTableDate = $data['gp_table_date'];
        }
        $jsondata = ['groupName'=> $groupName, 'id'=>$id, 'gpTableDate'=>$gpTableDate];

        echo json_encode(['message'=>'got all successfully', 'data'=>$jsondata, 'success'=>true]);
    }else{
        echo json_encode(['message'=>'Something Went wrong', 'success'=>false]);
    }
}


?>
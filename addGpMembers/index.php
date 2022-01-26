<?php

include_once './../DBconnector.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');
$data = json_decode(file_get_contents('php://input'), true);

$date = date("Y-m-d");
date_default_timezone_set("Asia/Calcutta");
$time = date("h:i:sA");


class User {
      
    var $groupTableId;
    var $userEmail;
    var $groupname;
    var $joiningDate;
    var $id;

    function __construct( $par1, $par2, $par3, $par4, $par5) 
    {
        $this->groupTableId = $par1;
        $this->userEmail = $par2;
        $this->groupname = $par3;
        $this->joiningDate = $par4;
        $this->id = $par5;
    }
}


for ($i=0; $i < sizeof($data); $i++) { 
    $groupName = $data[$i]['groupName'];
    $groupTableId = $data[$i]['groupTableId'];
    $userEmail = $data[$i]['userEmail'];

    $insert = "INSERT INTO `users_from_group_table`(`group_table_id`, `joining_date`, `user_email`, `groupname`) 
               VALUES 
               ('$groupTableId','$date','$userEmail','$groupName')";

    $executeInsert = mysqli_query($con, $insert);

    if($executeInsert == true){
        $get = "SELECT * FROM `users_from_group_table` WHERE `group_table_id`='$groupTableId' AND `user_email`='$userEmail' ";
        $view = mysqli_query($con,$get);
        $row = mysqli_num_rows($view);
        for($x=1; $x<=$row; $x++){
            $data1 = mysqli_fetch_assoc($view);
            $id = $data1['id'];
            $groupTableId = $data1['group_table_id'];
            $userEmail = $data1['user_email'];
            $joiningDate = $data1['joining_date'];
            $groupname = $data1['groupname'];

            $users = new User($groupTableId, $userEmail, $groupName, $joiningDate, $id);
            $userdata = (array)$users;
            $arr[] = $userdata;
        }
    }else{
    }

}

echo json_encode(['message'=>'got all successfully', 'data'=>$arr, 'success'=>true]);

?>
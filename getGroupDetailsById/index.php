<?php

include_once './../DBconnector.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');

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

$id = $_POST['id'];

$get = "SELECT * FROM `users_from_group_table` WHERE `group_table_id`='$id' ";
$view = mysqli_query($con,$get);
if($view == true){
    $row = mysqli_num_rows($view);
    if($row != 0){
        for($x=1; $x<=$row; $x++){
            $data1 = mysqli_fetch_assoc($view);
            $id = $data1['id'];
            $groupTableId = $data1['group_table_id'];
            $userEmail = $data1['user_email'];
            $joiningDate = $data1['joining_date'];
            $groupname = $data1['groupname'];
            $users = new User($groupTableId, $userEmail, $groupname, $joiningDate, $id);
            $userdata = (array)$users;
            $arr[] = $userdata;
        }
        echo json_encode(['message'=>'got all successfully', 'data'=>$arr, 'success'=>true]);
    }
}else{
    echo json_encode(['message'=>'Something Went wrong', 'success'=>false]);
}

?>
<?php

include_once './../DBconnector.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');

class User {
      
    var $groupName;
    var $id;
    var $gpTableDate;
    var $createdByUserEmail;

    function __construct( $par1, $par2, $par3, $par4) 
    {
        $this->groupName = $par1;
        $this->id = $par2;
        $this->gpTableDate = $par3;
        $this->createdByUserEmail = $par4;
    }
}

$id = $_POST['id'];
$get = "SELECT * FROM `group_table` WHERE `id`='$id' ";
$view = mysqli_query($con,$get);

if($view != false){
    $row = mysqli_num_rows($view);
    for($i=1; $i<=$row; $i++){
        $data = mysqli_fetch_assoc($view);
        $groupName = $data['group_name'];
        $id = $data['id'];
        $gpTableDate = $data['gp_table_date'];
        $createdByUserEmail = $data['created_by_user_email'];
        $users = new User($groupName, $id, $gpTableDate, $createdByUserEmail);
        $userdata = (array)$users;
        $arr[] = $userdata;
    }
    echo json_encode(['message'=>'got all successfully', 'data'=>$arr, 'success'=>true]);
}else{
    echo json_encode(['message'=>'Something Went wrong', 'success'=>false]);
}

?>
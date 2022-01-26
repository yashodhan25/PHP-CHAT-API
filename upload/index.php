<?php
include_once './../DBconnector.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');

$id = $_POST['id'];
$file  = $_FILES['uploadfiles']['name'];

// move to destination folder
$file_source_location = $_FILES['uploadfiles']['tmp_name']; // get source path
$file_size = $_FILES['uploadfiles']['size']; // get file size
$file_target_location = "./files/$file"; // target location
$move = move_uploaded_file($file_source_location,$file_target_location); //(temp folder,"Path");

if($move != false){
    $fileurl = $url."/chat/upload/files/".$file;
    $update = "UPDATE `conversations` SET `uploadfiles`='$fileurl' WHERE `id`='$id' ";

    $executeInsert = mysqli_query($con, $update);
    if($executeInsert == true){
        $get = "SELECT * FROM `conversations` WHERE `id`='$id' ";
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
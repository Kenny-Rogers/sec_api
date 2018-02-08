<?php
    //include all the necessary files
    include('../includes/core/initialize.php');

    if($_POST){
        $code = rand(10000, 99999);
        $number = "233".$_POST['mobile_number'];
        $message = "Here's your verification code: $code";
        if(Message::send_message($number, $message)){
            echo json_encode(array("status"=>"1", "code"=>$code, "message"=>"process successfull"));
        } else {
            echo json_encode(array("status"=>"0",  "message"=>"process unsuccessfull"));
        }
    }
?>
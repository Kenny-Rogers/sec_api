<?php 

  //list of all required files {classes, objects, etc.}
  include('../includes/core/initialize.php');

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //registeration for complaint
    $complaint = new Complain();

    //create complaint object
    $complaint->set_field("nature_of_issue", $_POST['nature_of_issue']);
    $complaint->set_field("type_issue", $_POST['type_issue']);
    $complaint->set_field("complainant_id", $_POST['complainant_id']);
    $complaint->set_field('date_time_of_report', mysql_datetime_format(time()));
    $complaint->create();

    //create location object
    $location = new Location();
    $location->set_field("geo_lat", $_POST['lat']);
    $location->set_field("geo_long", $_POST['lng']);
    $location->set_update_time();
    $location->set_field("type_of_user", "complainant");
    $location->set_field("user_id", $complaint->get_field("id"));

    //create new ComplaintMedia object
    if(isset($_FILES["uploaded_file"]["name"])){
        $complaint_media = new ComplaintMedia();
        $complaint_media->set_field('complaint_id', $complaint->get_field("id"));
        $complaint_media->set_field('media_type', $_POST['media_type']);
        $file_info = pathinfo($_FILES["uploaded_file"]["name"]);
        $ext=$file_info['extension'];
        $num = rand(1000, 9999);
        $media_name = "file_$num"."_".$complaint->get_field('id').".$ext";
        $complaint_media->set_field('media_name', $media_name);

        $file_path = "complaint_media/".$media_name;

        $response = array();
        if(move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $file_path)){
            $complaint_media->create();
            $reponse["status"] = "1";
        } else{
            $reponse["status"] = "0";
        }


    }
    



    //creating a new user
    if($location->create()){
        echo json_encode(array("status" => 1, "message" => "operation successful"));
    } else {
        //if creation is unsuccessful return error message
        echo json_encode(array("status" => 0, "message" => "operation failed"));
    }

 } else {
    //if SERVER REQUEST METHOD is not specified
    echo json_encode(array("status" => 4, "message" => "no request method failed"));
  }
  
  header("Content-Type: application/json");
?>
<?php
  /** This page allows for user info to be edited the system  **/

  //list of all required files {classes, objects, etc.}
  include('../includes/core/initialize.php');

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //check the required user type to be created
      $user_type = isset($_GET['user_type']) ? $_GET['user_type'] : "";

    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));

    //Attempt to decode the incoming RAW post data from JSON.
    $decoded = json_decode($content, true);

    //if the decoded data is not an array indicate error
    if(!is_array($decoded)){
    echo json_encode(array("status" => 0, "message" => "invalid data format. Required format is JSON"));
    return; 
    }

    if($user_type == 'personnel'){
        $update_data = Personnel::find_by_id($decoded['id']);
    }elseif($user_type == 'dep_plan'){
        $update_data = DeploymentPlan::find_by_id($decoded['id']);
    }

      
    foreach ($decoded as $key => $value) {
          $update_data->set_field($key, $value);
      }

    if($update_data->update()){
       echo json_encode(array("status" => 1, "message" => "operation successful"));
    } else{
       echo json_encode(array("status" => 0, "message" => "operation failed"));
    }
  } else {
    //if SERVER REQUEST METHOD is not specified
    echo json_encode(array("status" => 0, "message" => "no request method failed"));
  }
  
  header("Content-Type: application/json");

?>
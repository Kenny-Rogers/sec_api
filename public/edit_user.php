<?php
  /** This page allows for user info to be edited the system  **/

  //list of all required files {classes, objects, etc.}
  include('../includes/core/initialize.php');

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
      //check the required user type to be created
      $user_type = isset($_GET['user_type']) ? $_GET['user_type'] : "";
      if($user_type == 'complainant'){
        //initializing for complainant
        $user = new Complainant();
      } elseif ($user_type == 'personnel') {
        //initializing for personnel
        $system_user = new SystemUser();
        $user = new Personnel();
      } else {
        //if USER TYPE is not specified
        echo json_encode(array("status" => 0, "message" => "no user type specified in url"));
        return; 
      }

      //Receive the RAW post data.
      $content = trim(file_get_contents("php://input"));

      //Attempt to decode the incoming RAW post data from JSON.
      $decoded = json_decode($content, true);

      //if the decoded data is not an array indicate error
      if(!is_array($decoded)){
        echo json_encode(array("status" => 0, "message" => "invalid data format. Required format is JSON"));
        return; 
      }

      //fetching the info 
      $system_user = SystemUser::find_by_id($decoded['uid']);
      $user = Personnel::find_by_id($system_user->get_field("personnel_id"));

      //setting the fields of the user to the data submitted to the API 
      $system_user->set_field("role", $decoded['role']);
      $system_user->set_field("user_name", $decoded['user_name']);
      $system_user->set_field("password", $decoded['password']);

      //removing unwanted indexes from the array
      unset($decoded['role'], $decoded['user_name'], $decoded['password'], $decoded['uid']);

      $user->set_fields($decoded);

      //updating user info
      if($user->update()){
        $system_user->set_field("status", "offline");
        $system_user->set_field("personnel_id", $user->get_field("id"));
        //if update is successful return success message
        if($system_user->update()){
          echo json_encode(array("status" => 1, "message" => "operation successful"));
        } else {
          echo json_encode(array("status" => 0, "message" => "operation failed"));
        }
      } else {
        //if update is unsuccessful return error message
        echo json_encode(array("status" => 0, "message" => "operation failed"));
      }
  } else {
    //if SERVER REQUEST METHOD is not specified
    echo json_encode(array("status" => 0, "message" => "no request method failed"));
  }
  
  header("Content-Type: application/json");
?>

<?php
  /** This page allows for users to be de-registered from the system  **/

  //list of all required files {classes, objects, etc.}
  include('../includes/core/initialize.php');

  if ($_SERVER['REQUEST_METHOD'] == "GET") {
      //check the required user type to be created
      $user_type = isset($_GET['user_type']) ? $_GET['user_type'] : "";
      if($user_type == 'complainant'){
        //registeration for complainant
        $user = new Complainant();
      } elseif ($user_type == 'personnel') {
        $system_user = new SystemUser();
        $user = new Personnel();
      } else {
        //if USER TYPE is not specified
        echo json_encode(array("status" => 0, "message" => "no user type specified in url"));
        return; 
      }

      //fetching the details of the user to be deleted
      $system_user = SystemUser::find_by_id($_GET['uid']);
      $user = Personnel::find_by_id($system_user->get_field("personnel_id"));

      //deleting user info
      if($user->delete()){
        //deleting user info
        if($system_user->delete()){
          echo json_encode(array("status" => 1, "message" => "operation successful"));
        } else {
          echo json_encode(array("status" => 0, "message" => "operation failed"));
        }
      } else {
        //if deletion is unsuccessful return error message
        echo json_encode(array("status" => 0, "message" => "operation failed"));
      }
  } else {
    //if SERVER REQUEST METHOD is not specified
    echo json_encode(array("status" => 0, "message" => "no request method failed"));
  }
  
  header("Content-Type: application/json");
?>

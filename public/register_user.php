<?php
  /** This page allows all types of users to register unto the system  **/

  //list of all required files {classes, objects, etc.}
  include('../includes/core/initialize.php');

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
      //check the required user type to be created
      $user_type = isset($_GET['user_type']) ? $_GET['user_type'] : "";
      if($user_type == 'complainant'){
        //registeration for complainant
        $user = new Complainant();
      } elseif ($user_type == 'personnel') {
        //registeration for personnel
        $user = new Personnel();
      } elseif ($user_type == 'secretariat') {
        //registeration for personnel
        $user = new Secretariat(); 
      } elseif ($user_type == 'system_user') {
        //registeration for personnel
        $user = new SystemUser(); 
        $user->set_field("status", "offline");
      } elseif ($user_type == 'patrol_team') {
        //registeration for personnel
        $user = new PatrolTeam(); 
        $user->set_field("expiration", "false");
        $user->set_field("status", "offline");
        $user->set_field("date_created", '2017-10-10');
      }  elseif ($user_type == 'patrol_team_assign') {
        //registeration for personnel
        $user = new PatrolTeamMember(); 
      }  elseif ($user_type == 'dep_plan') {
        //registeration for personnel
        $user = new DeploymentPlan(); 
        $user->set_field("date_created", get_current_date('d'));
      } elseif ($user_type == 'enroll_team') {
        //registeration for personnel
        $user = new Enrollment(); 
      }elseif ($user_type == 'location') {
        //registeration for location
        $user = new Location(); 
      }elseif ($user_type == 'complainant') {
        //registeration for location
        $user = new Complainant(); 
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

      $user->set_fields($decoded);
      if ($user_type == 'dep_plan') {
        //registeration for deployment_plan
        $date = $user->get_field("schedule_for_date");
        $user->set_field("schedule_for_date", mysql_date_format(strtotime($date)));
      } elseif ($user_type == "location"){
        //setting the last_updated time
        $user->set_update_time(); 
      }

      //creating a new user
      if($user->create()){
        echo json_encode(array("status" => 1, "message" => "operation successful"));
      } else {
        //if creation is unsuccessful return error message
        echo json_encode(array("status" => 0, "message" => "operation failed"));
      }
  } else {
    //if SERVER REQUEST METHOD is not specified
    echo json_encode(array("status" => 0, "message" => "no request method failed"));
  }
  
  header("Content-Type: application/json");
?>

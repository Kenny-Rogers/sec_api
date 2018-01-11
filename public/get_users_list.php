<?php
  /** This page allows all types of users to register unto the system  **/

  //list of all required files {classes, objects, etc.}
  include('../includes/core/initialize.php');

  if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $response = array();

    
    if ($_GET['user_type'] == 'personnel'){
      //get a list of all registered personnel
      $personnels = Personnel::find_all();

      foreach($personnels as $personel){
          $response[] = $personel->get_array(); 
        }

    } elseif ($_GET['user_type'] == 'non_user_personnel'){
      $sql = "SELECT * FROM personnel WHERE id NOT IN "
            ."(SELECT personnel_id FROM system_user)";
      //get a list of all registered personnel
      $personnels = Personnel::find_by_sql($sql);

      foreach($personnels as $personel){
          $response[] = $personel->get_array(); 
        }
 
    } elseif ($_GET['user_type'] == 'non_team_member'){
      $sql = "SELECT * FROM personnel WHERE id NOT IN "
            ."(SELECT personnel_id FROM system_user) AND id NOT IN "
            ."(SELECT leader_id FROM patrol_team) AND id NOT IN "
            ."(SELECT personnel_id FROM patrol_team_member)";
      //get a list of all registered personnel
      $personnels = Personnel::find_by_sql($sql);

      foreach($personnels as $personel){
          $response[] = $personel->get_array(); 
        }
 
    } elseif ($_GET['user_type'] == 'non_leader_personnel'){
      $sql = "SELECT * FROM personnel WHERE id NOT IN "
            ."(SELECT personnel_id FROM system_user) AND id NOT IN "
            ."(SELECT leader_id FROM patrol_team)";
      //get a list of all registered personnel
      $personnels = Personnel::find_by_sql($sql);

      foreach($personnels as $personel){
          $response[] = $personel->get_array(); 
        }

    } elseif ($_GET['user_type'] == 'sec_rep'){
      $sql = "SELECT * FROM system_user WHERE role ='secretariat representative'  ".
             "AND id NOT IN (SELECT rep_id FROM secretariat)";
      //get a list of all registered personnel
      $system_users = SystemUser::find_by_sql($sql);

      $index = 0 ;
      foreach($system_users as $user){
          $personel = Personnel::find_by_id($user->get_field('personnel_id'));
          $response[$index]['personnel'] = $personel->get_array(); 
          $response[$index]['system_user'] = $user->get_array(); 
          $index++;
        }

    } elseif($_GET['user_type'] == 'system_user') {
      //get all system users
      $system_users = SystemUser::find_all();
      //initialize empty array to hold thier details
      $personnels = array();

      $index = 0; 
      foreach($system_users as $user){
          $personel = Personnel::find_by_id($user->get_field('personnel_id'));
          $response[$index]['personnel'] = $personel->get_array(); 
          $response[$index]['system_user'] = $user->get_array(); 
          $index++;
        }
    } elseif ($_GET['user_type'] == 'secretariat'){
      //get a list of all registered personnel
      $secretariats = Secretariat::find_all();

      foreach($secretariats as $secretariat){
          $response[] = $secretariat->get_array(); 
        }

    } elseif ($_GET['user_type'] == 'patrol_team'){
      //get a list of all registered personnel
      $patrol_teams = PatrolTeam::find_all();

      foreach($patrol_teams as $patrol_team){
          $response[] = $patrol_team->get_array(); 
        }

    } elseif ($_GET['user_type'] == 'dep_plan'){
      //get a list of all registered personnel
      $dep_plans = DeploymentPlan::find_all();

      foreach($dep_plans as $dep_plan){
          $response[] = $dep_plan->get_array(); 
        }

    }


        echo json_encode($response);
  }else {
        //if USER TYPE is not specified
        echo json_encode(array("status" => 0, "message" => "no user type specified in url"));
        return; 
  }
        

    header("Content-Type: application/json");
?>

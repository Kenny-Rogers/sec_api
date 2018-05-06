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

    } elseif ($_GET['user_type'] == 'system_user') {
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
      //check if request came with a date
      $last_date = isset($_GET['date'])?$_GET['date']:'';
      if ($last_date != ''){
        //then use date
        $sql = "SELECT * FROM secretariat WHERE date_published>'$last_date'";  
        $secretariats = Secretariat::find_by_sql($sql);

      } else {
        //else provide all the secs
        $secretariats = Secretariat::find_all();

      }

      
      foreach($secretariats as $secretariat){
          $response[] = $secretariat->get_array(); 
        }

    } elseif ($_GET['user_type'] == 'patrol_team'){
      $status = isset($_GET['status']) ? $_GET['status'] : '';
      if($status != ''){
        $sql = "SELECT * FROM patrol_team WHERE status='online'";
        $patrol_teams = PatrolTeam::find_by_sql($sql);
      } else {
        //get a list of all registered personnel
        $patrol_teams = PatrolTeam::find_all();
      }

      foreach($patrol_teams as $patrol_team){
          $response[] = $patrol_team->get_array(); 
        }

    } elseif ($_GET['user_type'] == 'dep_plan'){
      //get a list of all registered personnel
      $dep_plans = DeploymentPlan::find_all();

      foreach($dep_plans as $dep_plan){
          $response[] = $dep_plan->get_array(); 
        }

    } elseif ($_GET['user_type'] == 'location') {
        $for_user = $_GET['for_user']; //patrol_team or complain

        if($for_user == 'complain'){
          $user_id  = $_GET['user_id'];
            //sql stmnt for getting the locations
          $sql = "SELECT * FROM location WHERE type_of_user='$for_user' AND user_id='{$user_id}'";
        } else {
          //sql stmnt for getting the locations
          $sql = "SELECT * FROM location WHERE type_of_user='$for_user'";
        }

        //receiving the locations
        $locations = Location::find_by_sql($sql);

        //checking for the type of user for which location details are being requested for
        if($for_user == 'complain'){
          $response['type'] = 'complain';
          //if locations for a complain
          $location = $locations[0];
          $response['complainant_loc'] = $location->get_array();

          $sql = "SELECT * FROM location WHERE type_of_user='patrol_team'";
          //receiving the locations
          $locations = Location::find_by_sql($sql);

          $index = 1;
          //forming results
          foreach ($locations as $location) {
              //get complainant details
              $patrol_team = PatrolTeam::find_by_id($location->get_field('user_id'));

              //checking if the patrol_team is online
              if (trim($patrol_team->get_field('status')) == "online") {
                  //creating data
                  $data = array();

                  //adding info to data array
                  $data['patrol_team'] = $patrol_team->get_array();
                  $data['location'] = $location->get_array();

                  //adding the data to final response array
                  $response['data'][$index] = $data;
                  $index++;
              }

          }

        } elseif($for_user == 'patrol_team') {
          //if a patrol team
          $response['type'] = 'patrol_team';

          $index = 1;
          //forming results
          foreach ($locations as $location) {
            //get complainant details
            $patrol_team = PatrolTeam::find_by_id($location->get_field('user_id'));
            
            //checking if the patrol_team is online
            if(trim($patrol_team->get_field('status')) == "online"){
              //creating data
              $data = array();

              //adding info to data array
              $data['patrol_team'] = $patrol_team->get_array();
              $data['location'] = $location->get_array();

              //adding the data to final response array
              $response['data'][$index] = $data; 
              $index++;  
            }
            
          }

        }

      //  return json_encode($response);
      //  exit;        
    } elseif ($_GET['user_type'] == 'announcement'){
      $last_date = isset($_GET['date'])?$_GET['date']:'';
      if ($last_date != ''){
        $sql = "SELECT * FROM announcement WHERE date_published>'$last_date'";  
      } else {
        $sql = "SELECT * FROM announcement";
      }
      
      //get a list of all registered personnel
      $announcements = Announcement::find_by_sql($sql);

      foreach($announcements as $announcement){
          $response[] = $announcement->get_array(); 
        }

    } elseif ($_GET['user_type'] == 'complaint'){
      $complaint_id = isset($_GET['complaint_id']) ? $_GET['complaint_id'] : '';
      if ($complaint_id != '') {
          $sql = "SELECT * FROM complain WHERE id='{$complaint_id}'";
      } else {
          $sql = "SELECT * FROM complain WHERE id NOT IN (SELECT id FROM complain_action)";
      }

      $complains = Complain::find_by_sql($sql);
      foreach ($complains as $complain) {
        $response[] = $complain->get_array();
      }
    } elseif ($_GET['user_type'] == 'complainant'){ 
      $complainant_id = isset($_GET['complainant_id']) ? $_GET['complainant_id'] : '';
      $complainant = Complainant::find_by_id($complainant_id);
      $response[] = $complainant->get_array();
    } elseif ($_GET['user_type'] == 'patrol_complainant'){ 
      $patrol_team_id = $_GET["patrol_team_id"];
      $sql = "SELECT c.* FROM complain c JOIN complain_action ca ON c.id=ca.complain_id "
            ."WHERE ca.personnel_id='{$patrol_team_id}' AND ca.details_of_action='' "
            ."ORDER BY c.id DESC";
      $complaints = Complain::find_by_sql($sql);
      if (!$complaints){
        $response["status"] = 1;
        $response["message"] = "no complaints assigned to patrol team";
      } else {
        $response["status"] = 0;
        $i = 0;
        $response["complaint_objects"] = array();
        $complaint_objects = array();
        foreach ($complaints as $complaint) {
          $complaint_objects = array();
          $sql = "SELECT * FROM location WHERE type_of_user='complain' AND user_id='{$complaint->get_field("id")}'";
          $location = Location::find_by_sql($sql);
          $location = array_shift($location);
          $complainant = Complainant::find_by_id($complaint->get_field("complainant_id"));
          $sql = "SELECT * FROM complaint_media WHERE complaint_id='".$complaint->get_field("id")."'";
          //  echo $sql;
          $object = array(); 
          $object = ComplaintMedia::find_by_sql($sql);
          if(count($object) != 0){
            $complaint_media = array_shift($object);
            $complaint_objects["complaint_media"] = $complaint_media->get_array();
            $complain_media = array();
          } 
          $complaint_objects["location"] = $location->get_array();
          $complaint_objects["complaint"] = $complaint->get_array();
          $complaint_objects["complainant"] =  $complainant->get_array();
          $response["complaint_objects"][$i] = $complaint_objects;
          $i++;
        }
      }
    } elseif($_GET['user_type'] == 'patrol_complainant_detail') {
      $complaint_id = $_GET["complaint_id"];
      $sql = "SELECT c.* FROM complain c JOIN complain_action ca ON c.id=ca.complain_id "
            ."WHERE ca.personnel_id='{$patrol_team_id}'";
      $complaints = Complain::find_by_sql($sql);
      if (!$complaints){
        $response["status"] = 1;
        $response["message"] = "no complaints assigned to patrol team";
      } else {
        $response["status"] = 0;
        $i = 0;
        $response["complaint_objects"] = array();
        $complaint_objects = array();
        foreach ($complaints as $complaint) {
          // $sql = "SELECT * FROM location WHERE type_of_user='complain' AND user_id='{$complaint->get_field("id")}'";
          // $location = Location::find_by_sql($sql);
          // $location = array_shift($location);
          // $complaint_objects["location"] = $location->get_array();
          $complaint_objects["complaint"] = $complaint->get_array();
          $response["complaint_objects"][$i] = $complaint_objects;
          $i++;
        }
      }
    } elseif ($_GET['user_type'] == 'complaint_media'){ 
      $complaint_id = isset($_GET['complaint_id']) ? $_GET['complaint_id'] : '';
      $sql = "SELECT * FROM complaint_media WHERE complaint_id='{$complaint_id}'";
      $object = ComplaintMedia::find_by_sql($sql);
      $complaint_media = array_shift($object);
      $response = $complaint_media->get_array();
    } 
    
        header('Content-type: application/json');
        echo json_encode($response);
  }else {
    
        header("Content-Type: application/json");
        //if USER TYPE is not specified
        echo json_encode(array("status" => 0, "message" => "no user type specified in url"));
        return; 
  }
        

   
?>

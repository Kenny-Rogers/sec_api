<?php
  /** This page allows all types of users to register unto the system  **/

  //list of all required files {classes, objects, etc.}
  include('../includes/core/initialize.php');

  if ($_SERVER['REQUEST_METHOD'] == "GET") {
      $response = array();
    if( $_GET['user_type'] == 'secretariat'){
       if (!isset($_GET['uid'])) {
         $query = ($_GET['col'] == 'region')? "region='".$_GET['val']."'"
                                         :  "type='".$_GET['val']."'";
        $secretariats = Secretariat::find_all_with(" $query");
        foreach ($secretariats as $secretariat) {
          $response[] = $secretariat->get_array();
        }
       } else {
        $secretariat = Secretariat::find_by_id($_GET['uid']);
         $response[] = $secretariat->get_array(); 
      }
    } elseif( $_GET['user_type'] == 'system_user' ){
        $user = SystemUser::find_by_id($_GET['uid']);
        $personel = Personnel::find_by_id($user->get_field('personnel_id'));
        $response[0]['personnel'] = $personel->get_array(); 
        $response[0]['system_user'] = $user->get_array(); 
    
    }elseif( $_GET['user_type'] == 'personnel' ){
        $personel = Personnel::find_by_id($_GET['uid']);
        $response = $personel->get_array(); 
    
    }


    echo json_encode($response);
  }else {
            //if USER TYPE is not specified
            echo json_encode(array("status" => 0, "message" => "no user type specified in url"));
            return; 
  }
        

    header("Content-Type: application/json");
?>

<?php 
    //this file is responsible for login users into the system
    include('../includes/core/initialize.php');

    //checking if the info is submitted via POST
    if(isset($_POST)){
        //recieve the type of user trying to login
        $user_type = $_GET['user_type'];

        switch ($user_type) {
            case 'location':
                //login details
                $team_id = $_POST['team_id'];
                $geo_lat = $_POST['geo_lat'];
                $geo_long = $_POST['geo_long'];

                //checking from the db
                $condition = " user_id='$team_id' AND user_id IN ".
                "(SELECT id FROM patrol_team WHERE status='online' AND expiration='false')"; 
                $array = Location::find_all_with($condition);
                $team_location = array_shift($array);

                //checking the results of the db
                if($team_location){
                    $team_location->set_field('geo_lat', $_POST['geo_lat']);
                    $team_location->set_field('geo_long', $_POST['geo_long']);
                    $team_location->set_update_time();
                    if($team_location->update()){
                        echo json_encode(array("status" => 4, "message" => "login details valid")); 
                    }else{
                        echo json_encode(array("status" => 0, "message" => "failed to update location"));
                    }   
                } else {
                    echo json_encode(array("status" => 0, "message" => "invalid location id"));
                }
                break;
            
            case 'complainant':
                # code...
                break;

            case 'complain_action':
                $id = $_POST['id'];
                $details_of_action = $_POST['details_of_action'];
                $sql = "SELECT * FROM complain_action WHERE complain_id='$id'";
                $object = ComplainAction::find_by_sql($sql);
                $complain_action = array_shift($object);
                $complain_action->set_field("details_of_action", $details_of_action);
                
                if($complain_action->update()){
                    echo json_encode(array("status" => 0, "message" => "details updated successfully")); 
                }else{
                    echo json_encode(array("status" => 1, "message" => "details failed to update"));
                }   
                break;

            default:
                 echo json_encode(array("status" => 4, "message" => "no user type specified"));
                 return;
                break;
        }

    } else{
        echo json_encode(array("status" => 0, "message" => "request method not POST"));
    }

?>
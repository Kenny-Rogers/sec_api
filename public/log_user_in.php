<?php 
    //this file is responsible for login users into the system
    include('../includes/core/initialize.php');

    //checking if the info is submitted via POST
    if(isset($_POST)){
        //recieve the type of user trying to login
        $user_type = $_POST['user_type'];

        switch ($user_type) {
            case 'patrol_team':
                //login details
                $team_name = $_POST['team_name'];
                $password = $_POST['password'];

                //checking from the db
                $condition = " team_name='$team_name' AND password='$password'"; 
                $result_array = PatrolTeam::find_all_with($condition);
                $patrol_team = array_shift($result_array);

                //checking the results of the db
                if($patrol_team){
                    //changing status to online
                    $patrol_team->set_field('status', 'online');
                    if($patrol_team->update()){
                        echo json_encode(array("status" => 4, "message" => "login details valid")); 
                    } else {
                       echo json_encode(array("status" => 0, "message" => "failed to login")); 
                    }
                } else {
                    echo json_encode(array("status" => 0, "message" => "login details invalid"));
                }
                break;
            
            case 'complainant':
                //login details
                $email = $_POST['email'];
                $password = $_POST['password'];

                //checking from the db
                $condition = " email='$email' AND password='$password'"; 
                $result_array = Complainant::find_all_with($condition);
                $complainant = array_shift($result_array);

                //checking the results of the db
                if($complainant){
                    echo json_encode(array("status" => 4, "message" => "login details valid")); 
                } else {
                    echo json_encode(array("status" => 0, "message" => "login details invalid"));
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
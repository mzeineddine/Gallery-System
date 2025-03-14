<?php
    require_once __DIR__."/../../models/User.php";
    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }
    class User_Controller{
        static function signup(){
            global $data;
            if(User_Controller::no_missing_parm($data, ["email", "pass", "user_name"])){
                User::create($data["email"],hash("sha3-256",$data["pass"]), $data["user_name"]);
                if(User::check_email()){
                    if(User::save()){
                        echo json_encode(["result"=>true,"message"=>"successfully signed up"]);
                        return true;
                    }
                    echo json_encode(["result"=>false,"message"=>"Something went wrong during signing up"]);
                    return false;
                }else{
                    echo json_encode(["result"=>false,"message"=>"Email already used"]);
                    return false;
                }
            }
            echo json_encode(["result"=>false,"message"=>"Missing Parameters"]);
            return false;
        }

        static function login(){
            global $data;
            if(User_Controller::no_missing_parm($data, ["email", "pass"])){
                User::create($data["email"],hash("sha3-256",$data["pass"]));
                $user = User::get_by_email_and_pass();
                if($user){
                    echo json_encode(["result"=>$user['id'],"message"=>"successfully logged in"] );
                    return true;
                }
                echo json_encode(["result"=>false,"message"=>"Email and Password mismatch"]);
                return false;
            }
            echo json_encode(["result"=>false,"message"=>"Missing Parameters"]);
            return false;
        }
        static function no_missing_parm($data, $args){
            $no_missing = true;
            for($i = 0; $i<sizeof($args); $i++){
                if(!isset($data[$args[$i]])){
                    echo "missing " . $args[$i];
                    return false;
                }
                if($data[$args[$i]]==""){
                    echo "missing " . $args[$i];
                    return false;
                }
            }
            return $no_missing;
        }
    }
?>
<?php
    require_once "../../models/User.php";
    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }

    if(no_missing_parm($data, ["email", "pass"])){
        User::create($data["email"],hash("sha3-256",$data["pass"]));
        $user = User::get_by_email_and_pass();
        if($user){
            echo json_encode(["result"=>$user[0]['id']]);
            echo json_encode(["message"=>"successfully logged in"]);
            return true;
        }
        echo json_encode(["result"=>false]);
        echo json_encode(["message"=>"Something went wrong during logging up"]);
        return false;
    }
    echo json_encode(["result"=>false]);
    echo json_encode(["message"=>"Missing Parameters"]);
    return false;

    function no_missing_parm($data, $args){
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
?>
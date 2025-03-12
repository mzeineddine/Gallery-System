<?php
    require_once "../../models/Image_metadata.php";
    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }
    if(no_missing_parm($data, ["user_id", "img", "title", "description","tag", "id"])){
        Image_metadata::create($data["user_id"],$data["img"], $data["title"],
                                $data["description"],$data["tag"],$data["id"]);
        if(Image_metadata::update()){
            echo json_encode(["result"=>true]);
            echo json_encode(["message"=>"Image deleted successfully"]);
            return true;
        }
        echo json_encode(["result"=>false]);
        echo json_encode(["message"=>"Something went wrong during deleting image"]);
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
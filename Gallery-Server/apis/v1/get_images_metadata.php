<?php
    require_once "../../models/Image_metadata.php";
    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }

    if(no_missing_parm($data, ["user_id", "img", "title", "description","tag"])){
        $imgs_metadata = Image_metadata::all();
        if($imgs_metadata){
            foreach($imgs_metadata as $img_metadata){
                echo json_encode(["result"=>$img_metadata,"message"=>"images retrieved"]);
                return true;
            }
        }
        echo json_encode(["result"=>false, "message"=>"Something went wrong during fetching images"]);
        return false;
    }
    echo json_encode(["result"=>false,"message"=>"Missing Parameters"]);
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
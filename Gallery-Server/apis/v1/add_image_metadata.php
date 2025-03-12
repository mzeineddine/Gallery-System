<?php
    require_once "../../models/Image_metadata.php";
    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }

    if(no_missing_parm($data, ["user_id", "img", "title", "description","tag", "file_name"])){
        $out_path =  "../../uploads/".time().$data['fileName'];
        $ifp = fopen( $out_path, 'wb' ); 
        $splitted_data = explode(',', $data["img"]);
        fwrite($ifp, base64_decode( $splitted_data[1]));
        fclose($ifp); 

        
        Image_metadata::create($data["user_id"],$out_path, $data["title"],
                                $data["description"],$data["tag"]);
        if(Image_metadata::save()){
            echo json_encode(["result"=>true,"message"=>"Image added successfully"]);
            return true;
        }
        echo json_encode(["result"=>false,"message"=>"Something went wrong during uploading image"]);
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
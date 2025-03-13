<?php
    require_once "../../models/Image_metadata.php";
    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }
    if(no_missing_parm($data, ["user_id", "title", "description","tag", "id"])){
        
        $base = "/Projects/Gallery-System/Gallery-Server";
        if(isset($data['img'])&&$data['img']!="" &&  isset($data['file_name'])&&$data['file_name']!=""){
            Image_metadata::create($data["user_id"],$data['img'], $data["title"],
            $data["description"],$data["tag"],$data["id"]);
            
            $filePath = Image_metadata::get_image_by_id();
            $filePath = explode("http://localhost/Projects/Gallery-System/Gallery-Server",$filePath);
            $filePath ="../../".$filePath[1];            
            
            unlink($filePath);
                
            
            $out_path = save_image($data['file_name'], $data['img'], $base);
            Image_metadata::create($data["user_id"],$out_path, $data["title"],
            $data["description"],$data["tag"],$data["id"]);
            if(Image_metadata::update()){
                echo json_encode(["result"=>true,"message"=>"Image updated successfully"]);
                return true;
            }
        }
        else{
            Image_metadata::create(user_id: $data["user_id"], title: $data["title"],
                description: $data["description"],tag: $data["tag"],id: $data["id"]);
            if(Image_metadata::update_without_img()){
                echo json_encode(["result"=>true,"message"=>"Image updated successfully"]);
                return true;
            }
        }

        
        echo json_encode(["result"=>false,"message"=>"Something went wrong during updating image"]);
        return false;
    }
    echo json_encode(["result"=>false,"message"=>"Missing Parameters"]);
    return false;

    function save_image($file_name,$img, $base){
        $time = time();
        $out_path =  "../../uploads/".$time.$file_name;
        $ifp = fopen( $out_path, 'wb' ); 
        $splitted_data = explode(',', $img);
        fwrite($ifp, base64_decode( $splitted_data[1]));
        fclose($ifp);         
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];
        $imagePath = $base."/uploads/".$time.$file_name;
        $out_path = $protocol . $host . $imagePath;
        return $out_path;
}

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
<?php
    require_once __DIR__."/../../models/Image_metadata.php";
    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }
    class Image_metadata_Controller{
        static function add_image_metadata(){
            global $data;
            if(Image_metadata_Controller::no_missing_parm($data, ["user_id", "img", "title", "description","tag", "file_name"])){
                
                $out_path = Image_metadata_Controller::save_image($data['file_name'], $data['img']);
        
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
        }
        
        static function delete_image_metadata(){
            global $data;
            if(Image_metadata_Controller::no_missing_parm($data, ["user_id", "id"])){
                Image_metadata::create(user_id: $data["user_id"],id: $data["id"]);
// 
                $ip_address = "127.0.0.1/Projects/Gallery-System";
                $img_base =  __DIR__."/../../../";
                $filePath = Image_metadata::get_image_by_id();
                $filePath = $img_base.$filePath;      
                unlink($filePath);
//  
                Image_metadata::create(user_id: $data["user_id"],id: $data["id"]);
                if(Image_metadata::delete()){
                    echo json_encode(["result"=>true,"message"=>"Image deleted successfully"]);
                    return true;
                }
                echo json_encode(["result"=>false, "message"=>"Something went wrong during deleting image"]);
                return false;
            }
            echo json_encode(["result"=>false, "message"=>"Missing Parameters"]);
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

        static function update_image_metadata(){
            global $data;
            if(Image_metadata_Controller::no_missing_parm($data, ["user_id", "title", "description","tag", "id"])){
                if(isset($data['img'])&&$data['img']!="" &&  isset($data['file_name'])&&$data['file_name']!=""){
                    Image_metadata::create($data["user_id"],$data['img'], $data["title"],
                    $data["description"],$data["tag"],$data["id"]);
                    // 
                    $ip_address = "127.0.0.1/Projects/Gallery-System";
                    $img_base =  __DIR__."/../../../";
                    $filePath = Image_metadata::get_image_by_id();
                    $filePath = $img_base.$filePath;      
                    unlink($filePath);
                    // 

                    $out_path = Image_metadata_Controller::save_image($data['file_name'], $data['img']);
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
        }
        static function get_images_metadata(){
            global $data;
            if(Image_metadata_Controller::no_missing_parm($data, ["user_id"])){
                Image_metadata::create($data["user_id"]);
                $imgs_metadata = Image_metadata::all();
                if($imgs_metadata){
                    echo json_encode(["result"=>$imgs_metadata,"message"=>"images retrieved"]);
                    return true;
                }
                echo json_encode(["result"=>false, "message"=>"Something went wrong during fetching images"]);
                return false;
            }
            echo json_encode(["result"=>false,"message"=>"Missing Parameters"]);
            return false;
        
        }
        static function save_image($file_name, $img){
            $time = time();
            $out_path =  __DIR__."/../../uploads/".$time.$file_name;
            $ifp = fopen( $out_path, 'wb' ); 
            $splitted_data = explode(',', $img);
            fwrite($ifp, base64_decode( $splitted_data[1]));
            fclose($ifp);         
            // Should be changed
            $imagePath = "/Gallery-Server/uploads/".$time.$file_name;
            $out_path = $imagePath;
            return $out_path;
        }
    }
?>
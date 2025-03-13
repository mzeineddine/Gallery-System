<?php
    require_once __DIR__ . "/Image_metadata_Skeleton.php";
    require_once __DIR__ . "/../connection/connection.php";
    class Image_metadata extends Image_metadata_Skeleton{
        static function save(){
            global $conn;
            $query = $conn->prepare("INSERT INTO images_metadata (user_id, img, title, `description`, tag) VALUES (?,?,?,?,?)");
            $query->bind_param("issss", self::$user_id, self::$img,
                                        self::$title,self::$description, self::$tag);
            $query->execute();
            return $query->affected_rows>0;
        }

        static function all(){
            global $conn;
            $query = $conn->prepare("SELECT * FROM images_metadata WHERE user_id=?");
            $query->bind_param("i",self::$user_id);
            if($query->execute()){
                $response = $query->get_result();
                $result = [];
                while($img_metadata = mysqli_fetch_assoc($response)){
                    $result[] = $img_metadata;
                }return sizeof($result)>0 ? $result : false;
            }return false;
        }

        static function update(){
            if(self::$id!=-1){
                global $conn;
                $query = $conn->prepare("UPDATE images_metadata SET img = ?,  title = ?, 
                                                `description` = ?, tag = ? WHERE id=?");
                $query->bind_param("ssssi",self::$img,self::$title,
                                    self::$description,self::$tag,self::$id);
                $query->execute();
                return $query->affected_rows>0;

            }return false;
        }
        static function update_without_img(){
            if(self::$id!=-1){
                global $conn;
                $query = $conn->prepare("UPDATE images_metadata SET  title = ?, 
                                                `description` = ?, tag = ? WHERE id=?");
                $query->bind_param("sssi",self::$title,
                                    self::$description,self::$tag,self::$id);
                $query->execute();
                return $query->affected_rows>0;
            }return false;
        }
        static function delete(){
            if(self::$id!=-1){
                global $conn;
                $query = $conn->prepare("DELETE FROM images_metadata WHERE id=?");
                $query->bind_param("i",self::$id);
                $query->execute();
                return $query->affected_rows>0;
            }return false;
        }
    }
?>
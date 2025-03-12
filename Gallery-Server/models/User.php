<?php
    require_once "./User_Skeleton.php";
    require_once "../connection/connection.php";
    class User extends User_Skeleton{
        static function check_email(){
            global $conn;
            $query = $conn->prepare("SELECT * FROM users WHERE email=?");
            $query->bind_param("ss",self::$email);
            if($query->execute()){
                $response = $query->get_result();
                return !$response->num_rows>0;
            }return false;
        }
        static function save(){
            global $conn;
            if(!self::check_email()){
                $query = $conn->prepare("INSERT INTO users (user_name, email, pass) VALUES (?,?,?)");
                $query->bind_param("sss", self::$user_name, self::$email,self::$pass);
                $query->execute();
                return $query->affected_rows>0;
            }return false;
        }

        static function get_by_email_and_pass(){
            global $conn;
            $query = $conn->prepare("SELECT * FROM users WHERE email=? AND pass=?");
            $query->bind_param("ss",self::$email,self::$pass);
            if($query->execute()){
                $response = $query->get_result();
                $result = [];
                while($user_db = mysqli_fetch_assoc($response)){
                    $result[] = $user_db;
                }return sizeof($result)>0 ? $result : false;
            }return false;
        }

        static function update_user_name(){
            if(self::$id!=-1){
                global $conn;
                $query = $conn->prepare("UPDATE users set user_name = ? WHERE id=?");
                $query->bind_param("si",self::$user_name,self::$id);
                return $query->execute();
            }return false;
        }

        static function delete(){
            if(self::$id!=-1){
                global $conn;
                $query = $conn->prepare("DELETE FROM users WHERE id=?");
                $query->bind_param("i",self::$id);
                return $query->execute();
            }return false;
        }
    }
?>
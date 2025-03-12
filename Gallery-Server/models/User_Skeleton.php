<?php
    class User_Skeleton{
        public static $id;
        public static $user_name;
        public static $email;
        public static $pass;

        static function create($email, $pass, $name = null, $id = -1){
            self::$id=$id;
            self::$user_name = $name;
            self::$email = $email;
            self::$pass = $pass;
        }
    }
?>
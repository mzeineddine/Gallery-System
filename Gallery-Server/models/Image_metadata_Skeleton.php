<?php
    class Image_metadata_Skeleton{
        public static $id;
        public static $user_id;
        public static $img;
        public static $title;
        public static $description;
        public static $tag;


        static function create($user_id, $img, $title = null, $description = null, $tag, $id=-1){
            self::$id=$id;
            self::$user_id = $user_id;
            self::$img = $img;
            self::$title = $title;
            self::$description = $description;
            self::$tag = $tag;

        }
    }
?>
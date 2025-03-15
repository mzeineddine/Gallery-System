<?php
    $base = "..";
    require $base . "/connections/connection.php";
    
    function save_image_metadata($user_id, $img,$title,$description, $tag){
        global $conn;
        $query = $conn->prepare("INSERT INTO images_metadata (user_id, img, title, `description`, tag) VALUES (?,?,?,?,?)");
        $query->bind_param("issss",$user_id, $img,$title,$description, $tag);
        $query->execute();
    }

    function save_user($id,$user_name, $email,$pass){
        global $conn;
        $query = $conn->prepare("INSERT INTO users (id,user_name, email, pass) VALUES (?,?,?,?)");
        $query->bind_param("isss", $id,$user_name, $email,$pass);
        $query->execute();
    }

    save_image_metadata( 1, '/Gallery-Server/uploads/174204598802.jpg', 'wireless earphones', 'rechargeable Bluetooth earphone ', 'Earphones');
    save_image_metadata( 1, '/Gallery-Server/uploads/1742046014blue.jpg', 'Thermal Camera', 'Thermal Camera with Games', 'Camera');
    save_image_metadata(1, '/Gallery-Server/uploads/1742046057Screenshot 2024-05-25 123541.png', 'Employee Application', 'QMS Employee Application', 'QMS');
    save_image_metadata( 1, '/Gallery-Server/uploads/1742046105Screenshot 2024-05-25 123612.png', 'Business Application', 'QMS Business Application ', 'QMS');
    save_image_metadata(1, '/Gallery-Server/uploads/1742046142Screenshot 2024-05-25 123623.png', 'Client Application', 'QMS Client Application', 'QMS');
    save_image_metadata( 1, '/Gallery-Server/uploads/1742046180Screenshot 2024-05-25 123632.png', 'Kiosk Application', 'QMS Kiosk Application', 'QMS');

    save_user(1,'mohammad_zeineddine', 'mohammad.zeineddine50@gmail.com', 'a03ab19b866fc585b5cb1812a2f63ca861e7e7643ee5d43fd7106b623725fd67');

?>
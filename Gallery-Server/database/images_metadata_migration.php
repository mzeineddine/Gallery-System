<?php
$base = "..";
    require $base . "/connection/connection.php";
    $query = $conn->prepare("CREATE TABLE IF NOT EXISTS`images_metadata` (
                                        `id` int(11) INT AUTO_INCREMENT PRIMARY KEY,
                                        `user_id` int(11) NOT NULL,
                                        `img` varchar(255) NOT NULL,
                                        `title` varchar(255) NOT NULL,
                                        `description` varchar(255) NOT NULL,
                                        `tag` varchar(255) NOT NULL)"
                            );
    $query->execute();

?>
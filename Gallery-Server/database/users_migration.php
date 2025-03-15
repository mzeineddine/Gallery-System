<?php
    $base = "..";
    require $base . "/connection/connection.php";
    $query = $conn->prepare("CREATE TABLE IF NOT EXISTS `users` (
                                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                                `user_name` varchar(255) NOT NULL,
                                                `email` varchar(255) NOT NULL,
                                                `pass` varchar(255) NOT NULL
                            )");
    $query->execute();
?>
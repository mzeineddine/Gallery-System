<?php
    $base = "..";
    require $base . "/connection/connection.php";
    $query = $conn->prepare("CREATE TABLE IF NOT EXISTS `users` (
                                                `id` int(11) NOT NULL,
                                                `user_name` varchar(255) NOT NULL,
                                                `email` varchar(255) NOT NULL,
                                                `pass` varchar(255) NOT NULL
                            )");
    $query->execute();
?>
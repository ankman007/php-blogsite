<?php 
    $hostname = 'localhost';
    $user = 'root';
    $password = '';
    $db_name = 'streamline_db';

    $conn = mysqli_connect($hostname, $user, $password, $db_name);

    if ($conn->connect_error){
        die('Database connection failed.');
    }
?>
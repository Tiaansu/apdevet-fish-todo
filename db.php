<?php

$MYSQL_HOST = "localhost";
$MYSQL_USERNAME = "root";
$MYSQL_PASSWORD = "root";

$is_failed = false;

try {
    // Initializing the MySQL connection
    $conn = new mysqli($MYSQL_HOST, $MYSQL_USERNAME, $MYSQL_PASSWORD);

    // Preparing the prepared statement ;-;
    $stmt = $conn->prepare('CREATE DATABASE IF NOT EXISTS cabading_fish_todo;');

    // Executing the statement
    $stmt->execute();

    // Reinitializing the MySQL connection
    $conn = new mysqli($MYSQL_HOST, $MYSQL_USERNAME, $MYSQL_PASSWORD, 'cabading_fish_todo');

    // Creating the `users` table
    $stmt = $conn->prepare('
        CREATE TABLE IF NOT EXISTS `users` (
            uid INT(10) NOT NULL AUTO_INCREMENT,
            username VARCHAR(64) NOT NULL,
            password VARCHAR(61) NOT NULL,
            PRIMARY KEY(`uid`)
        );
    ');

    $stmt->execute();
} catch (\Throwable $th) {
    $is_failed = true;
    echo $th;
    echo "<script>console.log('Failed to connect to the database');</script>";
}

?>
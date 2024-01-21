<?php
session_start(); 
require 'db.php';

if (isset($_POST["username"]) && isset($_POST["password"])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST["username"]);
    $password = validate($_POST["password"]);

    if (empty($username)) {
        header("Location: index.php?error=Username is required.");
        exit();
    } else if (empty($password)) {
        header("Location: index.php?error=Password is required.");
        exit();
    } else {
        $stmt = $conn->prepare('SELECT * FROM `users` WHERE `username` = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (password_verify($password, $result['password']) === false) {
            header("Location: index.php?error=Incorrect username or password.");
            exit();
        }

        $_SESSION['username'] = $result['username'];
        $_SESSION['id'] = $result['uid'];

        header("Location: home.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
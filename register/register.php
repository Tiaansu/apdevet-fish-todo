<?php
require '../db.php';

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm-password"])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST["username"]);
    $password = validate($_POST["password"]);
    $confirm_password = validate($_POST["confirm-password"]);

    if (empty($username)) {
        header("Location: index.php?error=Username is required.");
        exit();
    } else if (empty($password)) {
        header("Location: index.php?error=Password is required.");
        exit();
    } else if (empty($confirm_password)) {
        header("Location: index.php?error=Confirm password is required.");
        exit();
    } else {
        $options = [
            'cost' => 12
        ];
        $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
        if (password_verify($confirm_password, $password_hash) === false) {
            header("Location: index.php?error=Password and confirmation password does not match.");
            exit();
        }

        $stmt = $conn->prepare('SELECT * FROM `users` WHERE `username` = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result) > 0) {
            header("Location: index.php?error=Username already taken.");
            exit();
        }

        $stmt = $conn->prepare('INSERT INTO `users` (`username`, `password`) VALUES (?, ?);');
        $stmt->bind_param('ss', $username, $password_hash);
        $stmt->execute();
        header("Location: ../");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
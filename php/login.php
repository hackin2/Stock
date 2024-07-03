<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM User WHERE userid = '$userid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //if (password_verify($password, $row['password'])) {
		if ($password == $row['password']) {
            $_SESSION['userid'] = $userid;
            header("Location: ../index.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }
}
?>

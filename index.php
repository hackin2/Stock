<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Management</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js"></script>
</head>
<body>
    <div class="container">
        <h1>Welcome to Stock Management System</h1>
        <nav>
            <ul>
                <li><a href="php/add_student.php">Add Product</a></li>
                <li><a href="php/update_student.php">Update Product</a></li>
                <li><a href="php/delete_student.php">Delete Product</a></li>
                <li><a href="php/list_students.php">List Product</a></li>
                <li><a href="php/result.php">Find Product</a></li>
                <li><a href="php/logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>

<?php
include 'db.php';
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roll = $_POST['roll'];
    $name = $_POST['name'];
    $phy = $_POST['phy'];
    $chem = $_POST['chem'];
    $math = $_POST['math'];

    $sql = "INSERT INTO Mark (roll, name, phy, chem, math) VALUES ('$roll', '$name', '$phy', '$chem', '$math')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Add New Product</h2>
        <form action="" method="post">
            <label for="roll">Product ID:</label>
            <input type="number" id="roll" name="roll" required>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="phy">Catagory:</label>
            <input type="number" id="phy" name="phy" required>
            <label for="chem">Quantity:</label>
            <input type="number" id="chem" name="chem" required>
            <label for="math">Price:</label>
            <input type="number" id="math" name="math" required>
            <button type="submit" onclick="location.href='../index.php'">Add Product</button>
        </form>
		<br>
        <div>
        <button onclick="location.href='../index.php'">Home</button>
        </div>
    </div>
</body>
</html>

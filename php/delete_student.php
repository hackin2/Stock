<?php
include 'db.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: ../login.php");
    exit();
}

$student = null;
$rollNumberError = null;
$deleteSuccess = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['search'])) {
        // Handle search for student by roll number
        $roll = $_POST['roll'];
        $sql = "SELECT * FROM Mark WHERE roll = '$roll'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
        } else {
            $rollNumberError = "No student found with the given roll number.";
        }
    } elseif (isset($_POST['delete'])) {
        // Handle delete of student
        $roll = $_POST['roll'];
        $sql = "DELETE FROM Mark WHERE roll='$roll'";
        if ($conn->query($sql) === TRUE) {
            $deleteSuccess = "Record deleted successfully.";
            $student = null; // Clear the student details after deletion
        } else {
            $deleteSuccess = "Error deleting record: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Product</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Delete Product</h2>

        

        <?php if ($rollNumberError): ?>
            <p class="error"><?php echo $rollNumberError; ?></p>
        <?php endif; ?>

        <?php if ($deleteSuccess): ?>
            <p class="success"><?php echo $deleteSuccess; ?></p>
        <?php endif; ?>

        <?php if (!$student): ?>
            <form action="" method="post">
                <label for="roll">Enter Product ID:</label>
                <input type="number" id="roll" name="roll" required>
                <button type="submit" name="search">Search</button>
            </form>
        <?php else: ?>
            <h3>Product Details</h3>
            <p>Product ID: <?php echo $student['roll']; ?></p>
            <p>Name: <?php echo $student['name']; ?></p>
            <p>Catagory: <?php echo $student['phy']; ?></p>
            <p>Quantity: <?php echo $student['chem']; ?></p>
            <p>Price: <?php echo $student['math']; ?></p>
            <form action="" method="post">
                <input type="hidden" name="roll" value="<?php echo $student['roll']; ?>">
                <button type="submit" name="delete">Delete Product</button>
            </form>
        <?php endif; ?>
    </div>
	<br>
	<button onclick="location.href='../index.php'">Home</button>
</body>
</html>

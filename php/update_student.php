<?php
include 'db.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: ../login.php");
    exit();
}

$student = null;
$rollNumberError = null;
$updateSuccess = null;

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
    } elseif (isset($_POST['update'])) {
        // Handle update of student details
        $roll = $_POST['roll'];
        $name = $_POST['name'];
        $phy = $_POST['phy'];
        $chem = $_POST['chem'];
        $math = $_POST['math'];

        $sql = "UPDATE Mark SET name='$name', phy='$phy', chem='$chem', math='$math' WHERE roll='$roll'";
        if ($conn->query($sql) === TRUE) {
            $updateSuccess = "Record updated successfully.";
        } else {
            $updateSuccess = "Error updating record: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Update Product</h2>

        <?php if ($rollNumberError): ?>
            <p class="error"><?php echo $rollNumberError; ?></p>
        <?php endif; ?>

        <?php if ($updateSuccess): ?>
            <p class="success"><?php echo $updateSuccess; ?></p>
        <?php endif; ?>

        <?php if (!$student): ?>
            <form action="" method="post">
                <label for="roll">Enter Product Id:</label>
                <input type="number" id="roll" name="roll" required>
                <button type="submit" name="search">Search</button>
            </form>
        <?php else: ?>
            <form action="" method="post">
                <input type="hidden" name="roll" value="<?php echo $student['roll']; ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required>
                <label for="phy">Catagory:</label>
                <input type="number" id="phy" name="phy" value="<?php echo $student['phy']; ?>" required>
                <label for="chem">Quantity:</label>
                <input type="number" id="chem" name="chem" value="<?php echo $student['chem']; ?>" required>
                <label for="math">Price:</label>
                <input type="number" id="math" name="math" value="<?php echo $student['math']; ?>" required>
                <button type="submit" name="update" onclick="location.href='../index.php'">Update Product</button>
            </form>
        <?php endif; ?>
		<br>
		<button onclick="location.href='../index.php'">Home</button>
    </div>
</body>
</html>

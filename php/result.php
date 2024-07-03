<?php
include 'db.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: ../login.php");
    exit();
}

$resultData = null;
$totalMarks = 0;
$percentage = 0;
$rank = 0;
$maxMarksPerSubject = 100; // Assuming the maximum marks per subject is 100
$totalSubjects = 3; // Number of subjects

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roll = $_POST['roll'];

    // Fetch student details
    $sql = "SELECT * FROM Mark WHERE roll='$roll'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $resultData = $result->fetch_assoc();
        // $totalMarks = $resultData['phy'] + $resultData['chem'] + $resultData['math'];
        // $percentage = ($totalMarks / ($maxMarksPerSubject * $totalSubjects)) * 100;

        // Fetch all students' total marks
        // $sql = "SELECT roll, (phy + chem + math) AS total FROM Mark ORDER BY total DESC";
        $result = $conn->query($sql);

        // if ($result->num_rows > 0) {
        //     $rank = 1;
        //     while ($row = $result->fetch_assoc()) {
        //         if ($row['roll'] == $roll) {
        //             break;
        //         }
        //         $rank++;
        //     }
        // }
    } else {
        echo "No record found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find Product</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Find Product</h2>

     

        <form action="" method="post">
            <label for="roll">Product ID:</label>
            <input type="number" id="roll" name="roll" required>
            <button type="submit">Find</button>
        </form>
        <?php if ($resultData): ?>
            <h3>Result for Product ID: <?php echo $resultData['roll']; ?></h3>
            <p>Product Name: <?php echo $resultData['name']; ?></p>
            <p>Catagory: <?php echo $resultData['phy']; ?></p>
            <p>Quantity: <?php echo $resultData['chem']; ?></p>
            <p>Price: <?php echo $resultData['math']; ?></p>
            <!-- <p>Total Marks: <?php echo $totalMarks; ?></p> -->
            <!-- <p>Percentage: <?php echo number_format($percentage, 2); ?>%</p> -->
            <!-- <p>Rank: <?php echo $rank; ?></p> -->
        <?php endif; ?>
    </div>
	<br>
	<button onclick="location.href='../index.php'">Home</button>
</body>
</html>

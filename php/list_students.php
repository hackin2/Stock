<?php
include 'db.php';
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM Mark";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Products</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Product List</h2>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Catagory</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['roll']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['phy']}</td>
                            <td>{$row['chem']}</td>
                            <td>{$row['math']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            ?>
        </table>
    </div>
	<br>
	<button onclick="location.href='../index.php'">Home</button>
</body>
</html>

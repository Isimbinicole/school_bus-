<?php
include '../includes/db_conn.php';

$parent_ID = isset($_GET['parent_ID']) ? intval($_GET['parent_ID']) : 0;

$sql = "SELECT * FROM students WHERE parent_ID = '$parent_ID'";
$exe = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students of Parent #<?= $parent_ID ?></title>
    <link rel="stylesheet" href="../path-to-css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h4>Students Registered under Parent ID <?= $parent_ID ?></h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Names</th>
                <th>DOB</th>
                <th>Sex</th>
                <th>Card Number</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $exe->fetch_assoc()): ?>
            <tr>
                <td><?= $row['student_ID'] ?></td>
                <td><?= $row['student_names'] ?></td>
                <td><?= $row['DOB'] ?></td>
                <td><?= $row['sex'] ?></td>
                <td><?= $row['card_number'] ?></td>
                <td><?= ($row['status'] == 1) ? "Active" : "Inactive" ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a href="manage-parents.php" class="btn btn-secondary">Back to Parent List</a>
</div>



</body>
</html>

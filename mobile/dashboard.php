<?php
include '../database/db_config.php';

$card = isset($_GET['card']) ? $conn->real_escape_string($_GET['card']) : '';

$sql = "SELECT s.student_names, s.profile_image, s.DOB, s.sex, s.card_number,
        p.latitude, p.longitude
        FROM students s
        JOIN parents p ON s.parent_ID = p.parent_ID
        WHERE s.card_number = '$card' AND s.status = 1";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Student Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      padding: 20px;
      color: #333;
    }
    .card {
      max-width: 400px;
      margin: 0 auto;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      overflow: hidden;
      padding: 20px;
    }
    .card img {
      width: 100%;
      height: auto;
      border-radius: 10px;
      margin-bottom: 15px;
    }
    .info {
      line-height: 1.6;
    }
    .info b {
      display: inline-block;
      width: 120px;
    }
  </style>
</head>
<body>

<div class="card">
<?php if ($result && $result->num_rows > 0): 
    $row = $result->fetch_assoc();
    $imageUrl = "../images/students/" . $row['profile_image'];
?>
  <img src="<?= $imageUrl ?>" alt="Student Image">
  <div class="info">
    <p><b>Name:</b> <?= $row['student_names'] ?></p>
    <p><b>Sex:</b> <?= $row['sex'] ?></p>
    <p><b>DOB:</b> <?= $row['DOB'] ?></p>
    <p><b>Card No:</b> <?= $row['card_number'] ?></p>
    <p><b>Latitude:</b> <?= $row['latitude'] ?></p>
    <p><b>Longitude:</b> <?= $row['longitude'] ?></p>
  </div>
<?php else: ?>
  <p>Student not found.</p>
<?php endif; ?>
</div>

</body>
</html>

<?php
// database connection
session_start();
if (!isset($_SESSION['admin_ID'])) {
    header("location:../index.php");
    exit();
} else {
    $admin_ID = $_SESSION['admin_ID'];
}

include '../../includes/db_conn.php';

$valid = array('success' => false, 'messages' => '');

$admin_name = mysqli_real_escape_string($conn, $_POST['admin_name'] ?? '');
$email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');

// Validate name and email first
if (empty($admin_name)) {
    $valid['success'] = false;
    $valid['messages'] = "Please enter your name";
} elseif (empty($email)) {
    $valid['success'] = false;
    $valid['messages'] = "Please enter email";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $valid['success'] = false;
    $valid['messages'] = "Invalid email address";
} else {
    // Check if a new image is uploaded
    if (isset($_FILES['driver_image']) && $_FILES['driver_image']['error'] != UPLOAD_ERR_NO_FILE) {
        $type = pathinfo($_FILES['driver_image']['name'], PATHINFO_EXTENSION);
        $type = strtolower($type);

        if (!in_array($type, ['gif', 'jpg', 'jpeg', 'png'])) {
            $valid['success'] = false;
            $valid['messages'] = "Invalid image format. Allowed: gif, jpg, jpeg, png";
            echo json_encode($valid);
            exit();
        }

        $img1 = uniqid(rand()) . '.' . $type;
        $uploadDir = '../../images/admin/';
        $url = $uploadDir . $img1;

        if (is_uploaded_file($_FILES['driver_image']['tmp_name'])) {
            if (move_uploaded_file($_FILES['driver_image']['tmp_name'], $url)) {
                // Update including new image
                $sql = "UPDATE `admin` SET 
                        `admin_names` = '$admin_name',
                        `profile` = '$img1',
                        `email` = '$email' 
                        WHERE admin_ID = '$admin_ID'";
            } else {
                $valid['success'] = false;
                $valid['messages'] = "Error while uploading the image";
                echo json_encode($valid);
                exit();
            }
        } else {
            $valid['success'] = false;
            $valid['messages'] = "File upload error";
            echo json_encode($valid);
            exit();
        }
    } else {
        // No new image uploaded, update only name and email
        $sql = "UPDATE `admin` SET 
                `admin_names` = '$admin_name',
                `email` = '$email' 
                WHERE admin_ID = '$admin_ID'";
    }

    if ($conn->query($sql) === TRUE) {
    header("Location: ../../admin/profile.php");
    exit();
    } else {
        echo "<script>alert('Error while recording the data'); window.history.back();</script>";
    }

}

echo json_encode($valid);
?>

<?php
session_start();
include 'database/dbconfig.php';

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['UserID'];
    $planID = $_POST['plan_id'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["payment_screenshot"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a valid image (you can add more validations if needed)
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["payment_screenshot"]["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
            $error = "File is not an image.";
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
        $error = "Sorry, file already exists.";
    }

    // Check file size
    if ($_FILES["payment_screenshot"]["size"] > 5000000) { // 5MB
        $uploadOk = 0;
        $error = "Sorry, your file is too large.";
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo $error;
    } else {
        if (move_uploaded_file($_FILES["payment_screenshot"]["tmp_name"], $target_file)) {
            // Insert payment details into paymentconfirmation with Pending status
            $query = "INSERT INTO paymentconfirmation (PlanID, UserID, ScreenshotPath, Status) VALUES (?, ?, ?, 'Pending')";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iis", $planID, $userID, $target_file);
            $stmt->execute();

            echo "The file " . basename($_FILES["payment_screenshot"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Complete Your Payment</h2>
        <p>Please confirm your payment and upload the receipt screenshot.</p>
        <form method="POST" action="payment.php" enctype="multipart/form-data">
            <input type="file" name="payment_screenshot" required>
            <button type="submit" name="submit">Submit Payment</button>
        </form>
    </div>
</body>
</html>

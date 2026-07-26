<?php
include 'header.php';
include 'database/dbconfig.php'; // Ensure database connection is included

// Check if user is logged in
if (!isset($_SESSION['UserID'])) {
    echo '<p>Error: You must be logged in to submit a payment.</p>';
    exit();
}

$userID = $_SESSION['UserID']; // Get logged-in user ID

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $planID = $_POST['plan_id'];

    // Handle file upload
    $targetDir = "backend/admin/manage memberships/uploads/";  // Correct path with spaces in the folder name
    $fileName = basename($_FILES["payment_screenshot"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    // Check file type
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    if (in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
        if (move_uploaded_file($_FILES["payment_screenshot"]["tmp_name"], $targetFilePath)) {
            // Save payment confirmation to the database with UserID and default status
            $query = "INSERT INTO paymentconfirmation (UserID, PlanID, ScreenshotPath, DateSubmitted, Status) 
                      VALUES ('$userID', '$planID', '$fileName', NOW(), 'pending')";

            if ($conn->query($query)) {
                echo '<p>Payment confirmation submitted successfully. Awaiting admin approval.</p>';
                echo '<a href="index.php">Go back to the homepage</a>';
            } else {
                echo '<p>Error saving payment details: ' . $conn->error . '</p>';
            }
        } else {
            echo '<p>Error uploading file. Please try again.</p>';
        }
    } else {
        echo '<p>Invalid file type. Only JPG, PNG, and JPEG files are allowed.</p>';
    }
}

include 'footer.php';
?>

<?php
session_start();
include 'database/dbconfig.php';

if (!isset($_SESSION['UserID'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$userID = $_SESSION['UserID'];

// Corrected SQL query (Removed 'Link')
$query = "SELECT NotificationID, Message, Is_Read, Created_AT 
          FROM notifications 
          WHERE UserID = ? 
          ORDER BY Created_AT DESC";

if (!$stmt = $conn->prepare($query)) {
    die(json_encode(["error" => "SQL Error: " . $conn->error])); // Show SQL error if any
}

$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

header('Content-Type: application/json');
echo json_encode(["success" => true, "notifications" => $notifications]);

$stmt->close();
$conn->close();
?>

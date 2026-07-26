<?php
session_start();
include 'database/dbconfig.php';

if (!isset($_SESSION['UserID'])) {
    echo json_encode(["success" => false, "error" => "User not logged in"]);
    exit();
}

if (isset($_GET['id'])) {
    $notificationID = intval($_GET['id']);
    $userID = $_SESSION['UserID'];

    $query = "UPDATE notifications SET Is_Read = 1 WHERE NotificationID = ? AND UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $notificationID, $userID);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>

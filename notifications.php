<?php
include 'database/dbconfig.php';


if (!isset($_SESSION['UserID'])) {
    header("Location: backend/login.php");
    exit();
}

$userID = $_SESSION['UserID'];
$query = "SELECT NotificationID, Message, Is_Read, Created_AT FROM Notifications WHERE UserID = ? ORDER BY Created_AT DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Notifications</h2>
        <ul class="list-group">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list-group-item <?= $row['Is_Read'] ? '' : 'list-group-item-warning' ?>">
    <?= htmlspecialchars($row['Message']) ?>
    <span class="badge bg-secondary"><?= $row['Created_AT'] ?></span>
</li>

            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>

<?php
// Start output buffering
ob_start();

// Include the header
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

// Get the reservation ID from the POST request
if (isset($_POST['reservationID'])) {
    $reservationID = $_POST['reservationID'];
    $userID = $_SESSION['UserID'];

    // Check if the reservation exists and belongs to the current user
    $checkReservationQuery = "SELECT * FROM book_reservations WHERE ReservationID = ? AND UserID = ? AND Status = 'reserved'";
    $stmtCheck = $conn->prepare($checkReservationQuery);
    $stmtCheck->bind_param("ii", $reservationID, $userID);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    // If reservation exists and is "reserved", proceed with deletion
    if ($resultCheck->num_rows > 0) {
        // Delete the reservation from the database
        $deleteReservationQuery = "DELETE FROM book_reservations WHERE ReservationID = ?";
        $stmtDelete = $conn->prepare($deleteReservationQuery);
        $stmtDelete->bind_param("i", $reservationID);

        if ($stmtDelete->execute()) {
            $_SESSION['message'] = "Your reservation has been cancelled and removed successfully.";
        } else {
            $_SESSION['message'] = "Error cancelling your reservation. Please try again.";
        }
    } else {
        $_SESSION['message'] = "No reservation found or you don't have permission to cancel it.";
    }

    // Redirect to the 'my_books.php' page to see the updated list
    header("Location: my_books.php");
    exit();
} else {
    // If no reservation ID is passed, show an error message
    $_SESSION['message'] = "Invalid request.";
    header("Location: my_books.php");
    exit();
}

// Flush output buffer
ob_end_flush();
?>

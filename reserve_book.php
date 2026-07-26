<?php
// Start output buffering to prevent output before header() is called
ob_start();

include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

// Check if book_id is set
if (isset($_POST['book_id'])) {
    $bookID = $_POST['book_id'];
    $userID = $_SESSION['UserID'];

    // Get current timestamp for reservation date
    $reservationDate = date('Y-m-d H:i:s');

    // Check if the book is already reserved by the user
    $checkReservationQuery = "SELECT * FROM book_reservations WHERE BookID = ? AND UserID = ? AND Status = 'reserved'";
    $stmtCheck = $conn->prepare($checkReservationQuery);
    $stmtCheck->bind_param("ii", $bookID, $userID);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    // If a reservation already exists, prevent further reservations
    if ($resultCheck->num_rows > 0) {
        $_SESSION['message'] = "You have already reserved this book.";
        header("Location: bookdetails.php?id=" . $bookID);
        exit();
    }

    // Insert reservation into the book_reservations table
    $reserveBookQuery = "INSERT INTO book_reservations (BookID, UserID, ReservationDate, Status) VALUES (?, ?, ?, 'reserved')";
    $stmtReserve = $conn->prepare($reserveBookQuery);
    $stmtReserve->bind_param("iis", $bookID, $userID, $reservationDate);

    if ($stmtReserve->execute()) {
        $_SESSION['message'] = "Book reserved successfully!";
    } else {
        $_SESSION['message'] = "Error reserving the book. Please try again.";
    }

    // Redirect back to the book details page
    header("Location: bookdetails.php?id=" . $bookID);
    exit();
} else {
    die("Invalid request.");
}

// End output buffering and flush it to the browser
ob_end_flush();
?>

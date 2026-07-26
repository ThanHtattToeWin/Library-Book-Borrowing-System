<?php
session_start();
include 'database/dbconfig.php'; 

if (!isset($_SESSION['UserID'])) {
    $_SESSION['message'] = "You must log in to submit a review.";
    header("Location: bookdetails.php?id=" . $_POST['book_id']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['UserID'];
    $bookId = $_POST['book_id'];
    $rating = intval($_POST['rating']);
    $comment = trim($_POST['comment']);

    if ($rating < 1 || $rating > 5 || empty($comment)) {
        $_SESSION['message'] = "Invalid rating or empty comment.";
        header("Location: bookdetails.php?id=" . $bookId);
        exit();
    }

    // Insert review into the Review table
    $stmt = $conn->prepare("INSERT INTO Review (UserID, BookID, Rating, Comment, ReviewDate) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiis", $userId, $bookId, $rating, $comment);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Review submitted successfully!";
    } else {
        $_SESSION['message'] = "Error submitting review. Please try again.";
    }

    $stmt->close();
    $conn->close();

    header("Location: bookdetails.php?id=" . $bookId);
    exit();
}
?>

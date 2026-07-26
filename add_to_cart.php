<?php

session_start();
include 'database/dbconfig.php'; // Database connection

if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    // Check available copies
    $checkQuery = "SELECT NumberCopies FROM Book WHERE BookID = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if ($book['NumberCopies'] > 0) {
        // Proceed with adding to cart
        if (!isset($_SESSION['cart'][$bookId])) {
            $_SESSION['cart'][$bookId] = 1; // Set book in cart
            $_SESSION['message'] = "Book added to cart successfully!";
        } else {
            $_SESSION['message'] = "You have already added this book to the cart.";
        }
    } else {
        $_SESSION['message'] = "This book is currently unavailable.";
    }
    $stmt->close();
}

// Redirect to cart page
header("Location: cart.php");
exit();

?>

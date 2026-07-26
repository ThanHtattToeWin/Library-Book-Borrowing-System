<?php
session_start();

$bookId = $_GET['book_id'] ?? null;

if ($bookId && isset($_SESSION['cart'][$bookId])) {
    unset($_SESSION['cart'][$bookId]); // Remove book
}

header("Location: cart.php");
exit;
?>

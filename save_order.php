<?php
include 'header.php'; // Ensure database connection is included

// Check if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Ensure user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

// Get user inputs from POST
$region = $_POST['region'] ?? '';
$city = $_POST['city'] ?? '';
$address = $_POST['address'] ?? '';
$phone = $_POST['phone'] ?? '';
$deliveryFee = $_POST['deliveryFee'] ?? 0;
$userID = $_SESSION['UserID']; // Corrected to use UserID from session
$totalBooks = count($_SESSION['cart']);

// Calculate RentDate and OverdueDate
$rentDate = date("Y-m-d H:i:s"); // Current timestamp
$overdueDate = date("Y-m-d H:i:s", strtotime($rentDate . ' + 14 days')); // 14 days later

// Begin transaction
$conn->begin_transaction();

try {
    // Insert order into order_details table
    $stmt = $conn->prepare("INSERT INTO order_details (UserID, Address, TotalBooks, DeliveryFee, PhoneNumber, RentDate, OverdueDate, ReturnDate) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, NULL)");
    $stmt->bind_param("isidsss", $userID, $address, $totalBooks, $deliveryFee, $phone, $rentDate, $overdueDate);
    $stmt->execute();
    $orderID = $stmt->insert_id; // Get last inserted OrderID
    $stmt->close();

    // Insert order items into order_books table
    $stmt = $conn->prepare("INSERT INTO order_books (OrderID, BookID) VALUES (?, ?)");
    foreach ($_SESSION['cart'] as $bookID => $quantity) {
        for ($i = 0; $i < $quantity; $i++) {
            $stmt->bind_param("ii", $orderID, $bookID);
            $stmt->execute();
        }
    }
    $stmt->close();

    // Commit transaction
    $conn->commit();

    // Clear session cart
    unset($_SESSION['cart']);

    // Redirect to success page
    header("Location: order_success.php");
    exit();
} catch (Exception $e) {
    // Rollback if there’s an error
    $conn->rollback();
    error_log("Order failed: " . $e->getMessage()); // Log error
    header("Location: error.php?msg=Order failed, please try again");
    exit();
}
?>

<?php include 'header.php';?>

<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentID = $_POST['payment_id'];

    // Update the payment status
    $query = "UPDATE PaymentConfirmation SET Status = 'Approved' WHERE PaymentID = '$paymentID'";
    if ($conn->query($query)) {
        echo '<p>Payment approved successfully.</p>';
        echo '<a href="admin.php">Back to Admin Panel</a>';
    } else {
        echo '<p>Error updating payment: ' . $conn->error . '</p>';
    }
}
?>


<?php include 'footer.php';?>
<?php 
// Start output buffering to prevent the "headers already sent" issue
ob_start();

// Include DB connection
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

// Check if OrderID is set
if (isset($_POST['orderID'])) {
    $orderID = $_POST['orderID'];
    $userID = $_SESSION['UserID'];

    // Get current date and time
    $returnDate = date('Y-m-d H:i:s');

    // Begin transaction to ensure all updates complete
    $conn->begin_transaction();

    try {
        // Update the return date in order_details
        $updateOrderQuery = "UPDATE order_details SET ReturnDate = ? WHERE OrderID = ? AND UserID = ?";
        $stmt = $conn->prepare($updateOrderQuery);
        $stmt->bind_param("sii", $returnDate, $orderID, $userID);
        $stmt->execute();

        // Fetch all books in this order
        $bookQuery = "SELECT BookID FROM order_books WHERE OrderID = ?";
        $stmtBook = $conn->prepare($bookQuery);
        $stmtBook->bind_param("i", $orderID);
        $stmtBook->execute();
        $result = $stmtBook->get_result();

        // Restore book availability
        while ($row = $result->fetch_assoc()) {
            $bookID = $row['BookID'];
            
            // Ensure the book availability is updated in NumberCopies
            $updateBookQuery = "UPDATE Book SET NumberCopies = NumberCopies + 1 WHERE BookID = ?";
            $stmtUpdateBook = $conn->prepare($updateBookQuery);
            $stmtUpdateBook->bind_param("i", $bookID);
            $stmtUpdateBook->execute();

            // Check if the update was successful
            if ($stmtUpdateBook->affected_rows <= 0) {
                throw new Exception("Error updating book availability for BookID: " . $bookID);
            }
        }

        // Commit transaction
        $conn->commit();

        // Redirect to my_books.php with success message
        header("Location: my_books.php?status=returned");
        exit(); // Ensure no further code is executed after the redirect
    } catch (Exception $e) {
        $conn->rollback(); // Rollback changes on error
        echo "Error updating record: " . $e->getMessage();
    }
}

// Optionally, the rest of your HTML output can be below this line.
?>

<!-- HTML content (if any) would go below here -->

<?php
// Include footer if needed
include 'footer.php';

// End output buffering
ob_end_flush();
?>

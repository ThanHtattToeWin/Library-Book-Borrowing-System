<?php 
session_start();

// Start output buffering to prevent "headers already sent" issue
ob_start();

// Check if session cart exists
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='container mt-5 text-center'><p>Your cart is empty.</p></div>";
    include 'footer.php';
    exit();
}

// Retrieve form data from previous checkout page
$region = $_POST['region'] ?? '';
$city = $_POST['city'] ?? '';
$address = $_POST['address'] ?? '';
$phone = $_POST['phone'] ?? '';
$deliveryFee = isset($_POST['deliveryFee']) ? (int) $_POST['deliveryFee'] : 0; // Ensure deliveryFee is integer

include 'database/dbconfig.php'; // Include DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['UserID']; // Ensure user is logged in
    $orderDate = date('Y-m-d'); // Current date
    $returnDate = date('Y-m-d', strtotime('+14 days')); // Default return date (2 weeks)
    
    // Assign form values to variables
    $totalBooks = array_sum($_SESSION['cart']); // Total quantity of books

    // Insert order details
    $insertOrder = "INSERT INTO order_details (UserID, Address, TotalBooks, DeliveryFee, PhoneNumber, RentDate, OverdueDate) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertOrder);
    
    if ($stmt === false) {
        die("Error in preparing order statement: " . $conn->error);
    }

    $stmt->bind_param("isisiss", $userId, $address, $totalBooks, $deliveryFee, $phone, $orderDate, $returnDate);
    $stmt->execute();
    $orderId = $stmt->insert_id; // Get the newly created OrderID
    $stmt->close(); // Close statement after use

    // Insert books into order_books and update book copies
    foreach ($_SESSION['cart'] as $bookId => $qty) {
        // Insert each book based on quantity
        for ($i = 0; $i < $qty; $i++) { 
            $insertOrderBook = "INSERT INTO order_books (OrderID, BookID) VALUES (?, ?)";
            $stmt = $conn->prepare($insertOrderBook);
            if ($stmt === false) {
                die("Error in preparing order_books statement: " . $conn->error);
            }
            $stmt->bind_param("ii", $orderId, $bookId);
            $stmt->execute();
            $stmt->close();
        }

        // Reduce book copies in the Book table
        $updateCopies = "UPDATE Book SET NumberCopies = NumberCopies - ? WHERE BookID = ? AND NumberCopies >= ?";
        $stmt = $conn->prepare($updateCopies);
        if ($stmt === false) {
            die("Error in preparing book update statement: " . $conn->error);
        }
        $stmt->bind_param("iii", $qty, $bookId, $qty);
        $stmt->execute();
        $stmt->close();
    }

    // Clear cart after checkout
    unset($_SESSION['cart']);
    $_SESSION['message'] = "Borrow request successful! Please return books by " . $returnDate;

    // Move header() before the HTML output to prevent "headers already sent"
    header("Location: my_books.php");
    exit();  // Ensure no further code runs
}
?>

<!-- The HTML part will now be after the PHP code -->
<div class="container mt-4">
    <h2 class="text-center mb-4">Confirm Your Order</h2>
    
    <!-- User Information -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Delivery Details</div>
        <div class="card-body">
            <p><strong>Region:</strong> <?= htmlspecialchars($region) ?></p>
            <p><strong>City:</strong> <?= htmlspecialchars($city) ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($address) ?></p>
            <p><strong>Phone Number:</strong> <?= htmlspecialchars($phone) ?></p>
            <p><strong>Delivery Fee:</strong> MMK <?= number_format($deliveryFee) ?></p>
        </div>
    </div>

    <!-- Selected Books -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Selected Books</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Book Title</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION['cart'] as $bookId => $quantity):
                        $query = "SELECT BookTitle, BookImage FROM Book WHERE BookID = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $bookId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $book = $result->fetch_assoc();
                        $stmt->close();
                    ?>
                    <tr>
                        <td><img src="images/<?= htmlspecialchars($book['BookImage']) ?>" alt="<?= htmlspecialchars($book['BookTitle']) ?>" style="width: 80px; height: 100px;"></td>
                        <td><?= htmlspecialchars($book['BookTitle']) ?></td>
                        <td><?= $quantity ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Confirm Checkout Button -->
    <div class="text-center mb-5">
        <form method="post" action="confirmcheckout.php">
            <input type="hidden" name="region" value="<?= htmlspecialchars($region) ?>">
            <input type="hidden" name="city" value="<?= htmlspecialchars($city) ?>">
            <input type="hidden" name="address" value="<?= htmlspecialchars($address) ?>">
            <input type="hidden" name="phone" value="<?= htmlspecialchars($phone) ?>">
            <input type="hidden" name="deliveryFee" value="<?= htmlspecialchars($deliveryFee) ?>">
            <button type="submit" class="btn btn-success">Confirm Checkout</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

<?php
// Include header (with session and DB connection)
include 'header.php'; 

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['UserID']; // Get the logged-in user's ID

// Query to fetch reserved books with images
$query_reserved = "
    SELECT 
        r.ReservationDate, 
        r.Status AS ReservationStatus, 
        b.BookTitle, 
        b.BookImage, 
        r.ReservationID,
        b.BookID  -- Add the BookID here
    FROM 
        book_reservations r
    LEFT JOIN 
        Book b ON r.BookID = b.BookID
    WHERE 
        r.UserID = '$userID'
    ORDER BY 
        r.ReservationDate DESC";

$result_reserved = $conn->query($query_reserved);

// Query to fetch borrowing history with images
$query = "
    SELECT 
        DATE(od.RentDate) AS RentDate, 
        DATE(od.ReturnDate) AS ReturnDate, 
        od.TotalBooks, 
        od.Address, 
        od.PhoneNumber, 
        od.DeliveryFee,
        GROUP_CONCAT(b.BookTitle ORDER BY b.BookTitle ASC) AS BookTitles,
        GROUP_CONCAT(b.BookImage ORDER BY b.BookTitle ASC) AS BookImages,
        GROUP_CONCAT(b.BookID ORDER BY b.BookTitle ASC) AS BookIDs,  -- Add BookID for each book
        DATE( DATE_ADD(od.RentDate, INTERVAL 14 DAY) ) AS OverdueDate, 
        od.OrderID
    FROM 
        order_details od
    LEFT JOIN 
        order_books ob ON od.OrderID = ob.OrderID
    LEFT JOIN 
        Book b ON ob.BookID = b.BookID
    WHERE 
        od.UserID = '$userID'
    GROUP BY 
        od.RentDate, od.ReturnDate, od.TotalBooks, od.Address, od.PhoneNumber, od.DeliveryFee, od.OrderID
    ORDER BY 
        od.OrderID DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Borrowed Books History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="account-style.css" rel="stylesheet">
    <style>
        /* Scoped Styles for Borrowed Books History */
        .account-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .account-title {
            font-size: 2rem;
            font-weight: bold;
            color: #4e73df;
            margin-bottom: 20px;
            text-align: center;
        }
        .table-container {
            margin-top: 20px;
        }
        .table-title {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 15px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table thead {
            background-color: #f1f1f1;
            font-weight: bold;
            color: #6c757d;
        }
        .table th, .table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            vertical-align: middle;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-primary {
            background-color: #4e73df;
            border: none;
            padding: 8px 16px;
            font-size: 0.9rem;
            border-radius: 20px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #375a8a;
        }
        .status {
            font-weight: bold;
        }
        .overdue {
            color: #dc3545;
        }
        .pending {
            color: #ffc107;
        }
        .returned {
            color: #28a745;
        }
        .reserved {
            color: #007bff;
        }

        /* Make sure Reserved Books section is on top and Borrowed Books section below */
        .reserved-books, .borrowed-books {
            display: block;
            margin-bottom: 40px;
        }

        /* Display images horizontally */
        .book-images-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .book-images-container img {
            width: 80px;
            height: 120px;
            object-fit: cover;
        }
        
        /* This ensures everything is stacked vertically */
        .container {
            display: block;
        }

        .account-container {
            display: block;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="account-container">
        
        <!-- Reserved Books Section -->
        <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif; ?>


        <div class="reserved-books">
            <!-- <h2 class="account-title">My Reserved Books</h2> -->
            <div class="table-container">
                <h3 class="table-title">Reserved Books</h3>
                <?php if ($result_reserved->num_rows > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>Reservation Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_reserved->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['BookTitle']); ?></td>
                                    <td><?php echo htmlspecialchars($row['ReservationDate']); ?></td>
                                    <td>
                                        <?php 
                                        if ($row['ReservationStatus'] == 'reserved') {
                                            echo "<span class='status reserved'>Reserved</span>";
                                        } elseif ($row['ReservationStatus'] == 'cancelled') {
                                            echo "<span class='status cancelled'>Cancelled</span>";
                                        } elseif ($row['ReservationStatus'] == 'completed') {
                                            echo "<span class='status completed'>Completed</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($row['ReservationStatus'] == 'reserved'): ?>
                                            <form action="cancel_reservation.php" method="POST">
                                                <input type="hidden" name="reservationID" value="<?php echo $row['ReservationID']; ?>">
                                                <button type="submit" class="btn btn-danger">Cancel Reservation</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <!-- Display reserved book images horizontally with clickable link to book details -->
                                        <div class="book-images-container">
                                            <?php if (isset($row['BookImage']) && !empty($row['BookImage'])): ?>
                                                <a href="bookdetails.php?id=<?php echo $row['BookID']; ?>">
                                                    <img src="images/<?php echo htmlspecialchars($row['BookImage']); ?>" alt="Book Image">
                                                </a>
                                            <?php else: ?>
                                                <a href="bookdetails.php?id=<?php echo $row['BookID']; ?>">
                                                    <img src="default_book_image.jpg" alt="Default Book Image">
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">No reserved books found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Borrowing History Section -->
        <div class="borrowed-books">
            <!-- <h2 class="account-title mt-4">My Borrowed Books History</h2> -->
            <div class="table-container">
                <h3 class="table-title">Borrowing History</h3>
                <?php if ($result->num_rows > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Books Borrowed</th>
                                <th>Rent Date</th>
                                <th>Overdue Date</th>
                                <th>Return Date</th>
                                <th>Total Books</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Delivery Fee</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['BookTitles']); ?></td>
                                    <td><?php echo htmlspecialchars($row['RentDate']); ?></td>
                                    <td><?php echo htmlspecialchars($row['OverdueDate']); ?></td>
                                    <td><?php echo htmlspecialchars($row['ReturnDate'] ?? 'Pending'); ?></td>
                                    <td><?php echo htmlspecialchars($row['TotalBooks']); ?></td>
                                    <td style="white-space: normal;"><?php echo nl2br(htmlspecialchars($row['Address'])); ?></td>
                                    <td><?php echo htmlspecialchars($row['PhoneNumber']); ?></td>
                                    <td><?php echo htmlspecialchars($row['DeliveryFee']); ?></td>
                                    <td>
                                        <?php 
                                        if ($row['ReturnDate'] == null && strtotime($row['OverdueDate']) < time()) {
                                            echo "<span class='status overdue'>Overdue</span>";
                                        } else if ($row['ReturnDate'] != null) {
                                            echo "<span class='status returned'>Returned</span>";
                                        } else {
                                            echo "<span class='status pending'>Pending</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($row['ReturnDate'] == null): ?>
                                            <form action="return_book.php" method="POST">
                                                <input type="hidden" name="orderID" value="<?php echo $row['OrderID']; ?>">
                                                <button type="submit" class="btn btn-primary">Ready to Return</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="10">
                                        <!-- Display borrowed book images horizontally with clickable link to book details -->
                                        <div class="book-images-container">
                                            <?php 
                                            $images = explode(',', $row['BookImages']);
                                            $ids = explode(',', $row['BookIDs']);
                                            foreach ($images as $index => $image):
                                            ?>
                                                <a href="bookdetails.php?id=<?php echo $ids[$index]; ?>">
                                                    <img src="images/<?php echo htmlspecialchars($image); ?>" alt="Book Image">
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">No borrowed books found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

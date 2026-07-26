<?php 
include 'header.php'; 
?>

<div class="container my-4">
    <h2 class="text-center">Your Borrowed Books</h2>

    <!-- Display message if exists -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info text-center">
            <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']); // Clear message after showing 
            ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>Book Title</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($_SESSION['cart'] as $bookId => $quantity):
                    // Fetch book details from database
                    $query = "SELECT BookTitle, BookImage FROM Book WHERE BookID = $bookId";
                    $result = $conn->query($query);
                    $book = $result->fetch_assoc();
                ?>
                <tr>
                    <td>
                        <img src="images/<?php echo $book['BookImage']; ?>" alt="<?php echo $book['BookTitle']; ?>" style="width: 80px; height: 100px;">
                    </td>
                    <td><?php echo $book['BookTitle']; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>
                        <a href="remove_from_cart.php?book_id=<?php echo $bookId; ?>" class="btn btn-danger btn-sm">Remove</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <a href="categories.php" class="btn btn-secondary">Add More Books</a>
            <a href="checkout.php" class="btn btn-primary ml-2">Check Out</a>
        </div>
    <?php else: ?>
        <p class="text-center mt-4">Your cart is empty.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>



<?php
include 'header.php';
 // Start the session to track logged-in users

?>

<!-- Welcome Section for Logged-in Users -->
<section class="bg-primary text-white text-center py-5">
    <div class="container">
        <h1>Welcome!</h1>
        <p>Explore our library and enjoy your reading journey.</p>
        <div>
            <a href="membership_plan.php" class="btn btn-light me-2">View Membership</a>
            <a href="books.php" class="btn btn-outline-light">Browse Books</a>
            <a href="backend/logout.php" class="btn btn-danger">Log Out</a>
        </div>
    </div>
</section>






 <!-- Membership Packages Section -->
 <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Membership Packages</h2>
            <div class="row text-center">
                <?php
                // Fetch membership packages from the database
                $query = "SELECT * FROM PackagePlan";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    // Loop through the packages and display them
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-3 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row['PlanName'] . '</h5>
                                        <p class="card-text">📖 ' . $row['Price'] . '</p>
                                        <p class="card-text">Books per Rent: ' . $row['BooksPerRent'] . '</p>
                                        <p class="card-text">Rent Duration: ' . $row['RentDuration'] . ' days</p>
                                        <a href="membership_plan.php?id=' . $row['PlanID'] . '" class="btn btn-success">View</a>

                                    </div>
                                </div>
                            </div>';
                    }
                } else {
                    // If no packages are available, display a message
                    echo '<p class="text-center">No membership packages available.</p>';
                }
                ?>
            </div>
        </div>
    </section>



   
    <?php
// Query to get all categories
$categoryQuery = "SELECT * FROM Category";
$categoriesResult = $conn->query($categoryQuery);

// Loop through categories and display books for each category
if ($categoriesResult->num_rows > 0) {
    echo '<section class="container py-5">';
    echo '<h2 class="text-center mb-4">Books by Categories</h2>';
    
    // Loop through categories
    while ($category = $categoriesResult->fetch_assoc()) {
        echo '<div class="mb-4">';
        
        // Create a flex container to align category name and "View All" to opposite sides
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<h4>' . $category['CategoryName'] . '</h4>';
        echo '<a href="#" class="text-primary view-all">View All</a>';
        echo '</div>';
        
        // Query to get the first 4 books by category (limit 4)
        $bookQuery = "SELECT * FROM Book WHERE CategoryID = " . $category['CategoryID'] . " LIMIT 4";
        $booksResult = $conn->query($bookQuery);
        
        echo '<div class="row">';
        
        if ($booksResult->num_rows > 0) {
            // Loop through books and display them
            while ($book = $booksResult->fetch_assoc()) {
                // Dynamically set the image path by combining 'images/' and the image filename
                $imagePath = 'images/' . $book['BookImage'];

                echo '<div class="col-md-3 mb-4">';
                echo '<img src="' . $imagePath . '" class="img-fluid book-img" alt="Book Cover">';
                echo '<h5>' . $book['BookTitle'] . '</h5>';
                echo '</div>';
            }
        } else {
            echo '<p>No books available in this category.</p>';
        }
        
        echo '</div>'; // Close row
        echo '</div>'; // Close category div
    }

    echo '</section>';
} else {
    echo '<p>No categories available.</p>';
}
?>
<?php include 'footer.php';?>






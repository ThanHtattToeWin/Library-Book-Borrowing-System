<?php 
include 'header.php'; // Includes header.php
// Start the session to track logged-in users
?>

<!-- Welcome Section with Image Carousel -->
<section class="position-relative">
    <div id="libraryCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/image1.jpg" class="d-block w-100" alt="Library Image 1" style="height: 60vh; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="images/image2.jpg" class="d-block w-100" alt="Library Image 2" style="height: 60vh; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="images/image3.jpg" class="d-block w-100" alt="Library Image 3" style="height: 60vh; object-fit: cover;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#libraryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#libraryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Membership Packages Section -->
<section class="membership-section">
    <div class="container">
        <h2 class="text-center mb-5">Membership Packages</h2>
        <div class="row text-center">

            <?php
            // Fetch membership packages from the database
            $query = "SELECT * FROM PackagePlan";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // Loop through the packages and display them
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-lg-3 col-md-6 mb-4">
                            <div class="card package-card">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['PlanName'] . '</h5>
                                    <p class="card-text">📖 Price: ' . $row['Price'] . '</p>
                                    <p class="card-text">📚 Books per Rent: ' . $row['BooksPerRent'] . '</p>
                                    <p class="card-text">📅 Rent Duration: ' . $row['RentDuration'] . ' days</p>
                                    <p class="card-text">⏳ Duration: ' . $row['Duration'] . ' </p> <!-- Displaying Duration here --> 
                                    <a href="membership_plan.php?id=' . $row['PlanID'] . '" class="btn btn-view">View Plan</a>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                // If no packages are available, display a message
                echo '<p class="text-center col-12">No membership packages available at the moment.</p>';
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
    echo '<h2 class="text-center mb-5" style="font-size: 2rem; font-weight: 700; color: #333;">Books by Categories</h2>';
    
    // Loop through categories
    while ($category = $categoriesResult->fetch_assoc()) {
        echo '<div class="mb-5">';
        
        // Create a flex container to align category name and "View All" to opposite sides
        echo '<div class="d-flex justify-content-between align-items-center mb-3">';
        echo '<h4 class="category-title" style="font-size: 1.75rem; font-weight: 600; color: #2c3e50;">' . $category['CategoryName'] . '</h4>';
        
        // "View All" link redirects to category.php with CategoryID as a GET parameter
        echo '<a href="category.php?category_id=' . $category['CategoryID'] . '" class="text-primary view-all" style="font-size: 1.1rem; font-weight: 500;">View All</a>';
        echo '</div>';
        
        // Query to get the first 4 books by category (limit 4)
        $bookQuery = "SELECT * FROM Book WHERE CategoryID = " . $category['CategoryID'] . " LIMIT 4";
        $booksResult = $conn->query($bookQuery);
        
        echo '<div class="row row-cols-1 row-cols-md-4 g-4">';

        if ($booksResult->num_rows > 0) {
            // Loop through books and display them
            while ($book = $booksResult->fetch_assoc()) {
                // Dynamically set the image path by combining 'images/' and the image filename
                $imagePath = 'images/' . $book['BookImage'];

                echo '<div class="col mb-4">';
                
                // Create a link to the book detail page
                echo '<a href="bookdetails.php?id=' . $book['BookID'] . '" class="text-decoration-none">';

                // Card with hover effect
                echo '<div class="card h-100 border shadow-sm rounded-3 hover-card" style="max-width: 220px; transition: transform 0.3s ease, box-shadow 0.3s ease;">';

                // Book image
                echo '<img src="' . $imagePath . '" class="card-img-top img-fluid" alt="Book Cover" style="object-fit: contain; height: 300px; width: 100%; margin: 0 auto;">';

                // Book title
                echo '<div class="card-body text-center">';
                echo '<h5 class="card-title" style="font-size: 1.2rem; color: #2c3e50; font-weight: 500;">' . $book['BookTitle'] . '</h5>';
                echo '</div>';

                echo '</div>'; // Close card
                echo '</a>'; // Close link
                echo '</div>'; // Close column
            }
        } else {
            echo '<p>No books available in this category.</p>';
        }
        
        echo '</div>'; // Close row
        echo '</div>'; // Close category div
    }

    echo '</section>';
} else {
    echo '<p class="text-center" style="font-size: 1.25rem; color: #888;">No categories available.</p>';
}
?>

<?php include 'footer.php'; // Includes footer.php ?>

<?php include 'header.php';?>



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

   



<?php include 'footer.php';?>

<?php
include 'header.php'; // Include the header for navigation

// Check if a search query is provided
if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Create database connection (if not included in header.php)
    include 'database/dbconfig.php';

    // Updated query to search by book title, author, category, and genre (keyword)
    $sql = "
        SELECT DISTINCT b.BookID, b.BookTitle, b.BookImage, a.AuthorName, c.CategoryName
        FROM Book b
        LEFT JOIN BookAuthor ba ON b.BookID = ba.BookID
        LEFT JOIN Author a ON ba.AuthorID = a.AuthorID
        LEFT JOIN Category c ON b.CategoryID = c.CategoryID
        LEFT JOIN BookKeyword bk ON b.BookID = bk.BookID
        LEFT JOIN Keyword k ON bk.KeywordID = k.KeywordID
        WHERE b.BookTitle LIKE ? 
        OR a.AuthorName LIKE ? 
        OR c.CategoryName LIKE ?
        OR k.KeywordName LIKE ?
    ";

    // Check if the statement was prepared successfully
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $searchTerm = '%' . $query . '%'; // Wildcard search
        $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm); // Bind parameters

        // Execute the statement
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();

            // Check if any books were found
            if ($result->num_rows > 0) {
                echo '<div class="container py-5">';
                echo '<h2 class="text-center mb-4">Search Results for: ' . htmlspecialchars($query) . '</h2>';
                echo '<div class="row">';
                
                // Loop through the results and display each book
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-3 mb-4">';
                    echo '<div class="card">';
                    echo '<img src="images/' . $row['BookImage'] . '" class="card-img-top" alt="' . $row['BookTitle'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['BookTitle'] . '</h5>';
                    echo '<p class="card-text">By ' . $row['AuthorName'] . '</p>';
                    echo '<p class="card-text">Category: ' . $row['CategoryName'] . '</p>';
                    echo '<a href="bookdetails.php?id=' . $row['BookID'] . '" class="btn btn-primary">View Details</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo '<p class="text-center">No books found for your search query.</p>';
            }

            // Close the statement
            $stmt->close();
        } else {
            // Display error if the statement fails to execute
            echo '<p class="text-center text-danger">Error executing the query: ' . $stmt->error . '</p>';
        }
    } else {
        // Display error if the query preparation fails
        echo '<p class="text-center text-danger">Error preparing the query: ' . $conn->error . '</p>';
    }
}

include 'footer.php';
?>

<?php include 'header.php';?>





<?php


// Get the category ID from the URL
$categoryId = $_GET['category_id'] ?? null;

// Check if the category ID is provided
if ($categoryId) {
    // Query to get the category name
    $categoryQuery = "SELECT CategoryName FROM Category WHERE CategoryID = $categoryId";
    $categoryResult = $conn->query($categoryQuery);
    $categoryName = $categoryResult->fetch_assoc()['CategoryName'] ?? 'Unknown Category';

    // Query to get all books in this category
    $bookQuery = "SELECT * FROM Book WHERE CategoryID = $categoryId";
    $booksResult = $conn->query($bookQuery);
} else {
    die("Category not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books in <?php echo $categoryName; ?></title>
    <link rel="stylesheet" href="your_styles.css">
</head>
<body>
    <section class="container py-5">
        <h2 class="text-center mb-5" style="font-size: 2rem; font-weight: 700; color: #333;">
            Books in <?php echo $categoryName; ?>
        </h2>

        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            if ($booksResult->num_rows > 0) {
                while ($book = $booksResult->fetch_assoc()) {
                    $imagePath = 'images/' . $book['BookImage'];
                    echo '<div class="col mb-4">';
                    echo '<a href="bookdetails.php?id=' . $book['BookID'] . '" class="text-decoration-none">';
                    echo '<div class="card h-100 border shadow-sm rounded-3 hover-card" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">';
                    echo '<img src="' . $imagePath . '" class="card-img-top img-fluid" alt="Book Cover" style="object-fit: contain; height: 300px; width: 100%; margin: 0 auto;">';
                    echo '<div class="card-body text-center">';
                    echo '<h5 class="card-title" style="font-size: 1.2rem; color: #2c3e50; font-weight: 500;">' . $book['BookTitle'] . '</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>No books available in this category.</p>';
            }
            ?>
        </div>
    </section>
</body>
</html>

<?php include 'footer.php';?>
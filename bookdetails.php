<?php
// Start output buffering to prevent output before header() is called
ob_start();

// Include the header file (make sure there's no output before this)
include 'header.php';

// Function to display stars based on the rating
function displayStars($rating) {
    $output = '';
    
    // Convert rating to integer and ensure it's within the range (1 to 5)
    $rating = (int) $rating;

    // Loop through the number of stars (1 to 5)
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $output .= '<span class="fa fa-star text-warning"></span>'; // Full star
        } else {
            $output .= '<span class="fa fa-star-o text-muted"></span>'; // Empty star
        }
    }

    return $output;
}

// Check if there is a message to display (success/error)
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Unset the message after displaying
}

// Check if the user is logged in and has a valid membership
if (isset($_SESSION['UserID'])) {
    // User is logged in, let's check for membership
    $userID = $_SESSION['UserID'];
    
    // Query to check if the user has an active membership
    $membershipQuery = "SELECT * FROM UserMembership WHERE UserID = $userID AND Status = 'active' LIMIT 1";
    $membershipResult = $conn->query($membershipQuery);

    if ($membershipResult->num_rows > 0) {
        // User has an active membership, continue with the process
        $isActiveMember = true;
    } else {
        // If the user doesn't have an active membership, flag as not a member
        $isActiveMember = false;
    }

    // Get the Book ID from the URL
    $bookId = $_GET['id'] ?? null;

    if ($bookId) {
        // Query to fetch book details
        $bookQuery = "
            SELECT 
              Book.BookID, 
              Book.BookTitle, 
              Book.CategoryID, 
              Book.NumberCopies, 
              Book.BookImage, 
              Book.Genre, 
              Book.Description, 
              Category.CategoryName 
            FROM 
              Book 
            INNER JOIN 
              Category ON Book.CategoryID = Category.CategoryID
            WHERE 
              Book.BookID = $bookId";
        $bookResult = $conn->query($bookQuery);
        $book = $bookResult->fetch_assoc();

        // Query to fetch authors of the book
        $authorsQuery = "
            SELECT 
              Author.AuthorName 
            FROM 
              Author 
            INNER JOIN 
              BookAuthor ON Author.AuthorID = BookAuthor.AuthorID
            WHERE 
              BookAuthor.BookID = $bookId";
        $authorsResult = $conn->query($authorsQuery);

        // Query to fetch reviews of the book
        $reviewsQuery = "
            SELECT 
              Review.Rating, 
              Review.Comment, 
              Review.ReviewDate, 
              User.UserName 
            FROM 
              Review 
            INNER JOIN 
              User ON Review.UserID = User.UserID
            WHERE 
              Review.BookID = $bookId";
        $reviewsResult = $conn->query($reviewsQuery);

        // Query to fetch related books in the same category
        $relatedBooksQuery = "
            SELECT 
              Book.BookID, 
              Book.BookTitle, 
              Book.BookImage 
            FROM 
              Book 
            WHERE 
              Book.CategoryID = {$book['CategoryID']} 
              AND Book.BookID != $bookId 
            LIMIT 4";
        $relatedBooksResult = $conn->query($relatedBooksQuery);

        // Query to calculate the average rating and total reviews for the book
        $averageRatingQuery = "
            SELECT 
              AVG(Review.Rating) AS AverageRating, 
              COUNT(Review.Rating) AS TotalReviews
            FROM 
              Review
            WHERE 
              BookID = $bookId";
        $averageRatingResult = $conn->query($averageRatingQuery);
        $averageRatingData = $averageRatingResult->fetch_assoc();

        $averageRating = round($averageRatingData['AverageRating'], 1); // Rounded to 1 decimal
        $totalReviews = $averageRatingData['TotalReviews'];
    } else {
        die("Book not found.");
    }
} else {
    // If the user is not logged in, redirect to login page
    $_SESSION['message'] = "Please log in to borrow or reserve books.";
    header("Location: backend/login.php");
    exit(); // Stop further execution after redirect
}

// End output buffering and flush it to the browser
ob_end_flush();
?>

<section class="container py-5">
  <h2 class="text-center mb-5"><?php echo htmlspecialchars($book['BookTitle']); ?></h2>
  <div class="row">
    <!-- Book Image -->
    <div class="col-md-4 text-center">
      <img src="images/<?php echo htmlspecialchars($book['BookImage']); ?>" alt="<?php echo htmlspecialchars($book['BookTitle']); ?>" class="img-fluid shadow-sm rounded" style="max-width: 300px;">
    </div>
    <!-- Book Information -->
    <div class="col-md-8">
      <h4>Category: <span class="text-primary"><?php echo htmlspecialchars($book['CategoryName']); ?></span></h4>
      <h4>Genre: <span class="text-secondary"><?php echo htmlspecialchars($book['Genre']); ?></span></h4>
      <p class="mt-3"><strong>Description:</strong> <?php echo htmlspecialchars($book['Description']); ?></p>
      <h5>Authors:</h5>
      <ul>
        <?php
        if ($authorsResult->num_rows > 0) {
            while ($author = $authorsResult->fetch_assoc()) {
                echo '<li>' . htmlspecialchars($author['AuthorName']) . '</li>';
            }
        } else {
            echo '<li>No authors found.</li>';
        }
        ?>
      </ul>
      <p><strong>Number of Copies Available:</strong> <?php echo htmlspecialchars($book['NumberCopies']); ?></p>
      <!-- Average Rating -->
      <div class="rating-section mt-4">
        <h5>Average Rating: <?php echo $averageRating; ?>/5</h5>
        <div class="stars">
          <?php echo displayStars($averageRating); ?>
        </div>
        <p class="text-muted"><?php echo $totalReviews; ?> reviews</p>
      </div>

      <!-- Buttons Logic: Select or Reserve -->
      <?php if ($book['NumberCopies'] > 0): ?>
          <!-- If copies available, show 'Select this Book' -->
          <?php if ($isActiveMember): ?>
              <a href="add_to_cart.php?book_id=<?php echo htmlspecialchars($book['BookID']); ?>" class="btn btn-primary mt-3">
                  Select this Book
              </a>
          <?php else: ?>
              <a href="index.php" class="btn btn-danger mt-3">
                  To Borrow this Book, Please Buy a Membership First
              </a>
          <?php endif; ?>
      <?php else: ?>
          <!-- If no copies available, show 'Reserve this Book' -->
          <?php if ($isActiveMember): ?>
              <form action="reserve_book.php" method="POST">
                  <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['BookID']); ?>">
                  <button type="submit" class="btn btn-success mt-3">
                      Reserve this Book
                  </button>
              </form>
          <?php else: ?>
              <a href="index.php" class="btn btn-success mt-3">
              To Borrow this Book, Please Buy a Membership First
              </a>
          <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- Reviews Section -->
  <div class="mt-4">
    <h3>Reviews</h3>
    <?php
    if ($reviewsResult->num_rows > 0) {
        while ($review = $reviewsResult->fetch_assoc()) {
            echo '<div class="review-card mb-3 p-3 border rounded">';
            echo '<h5>' . htmlspecialchars($review['UserName']) . '</h5>';
            echo '<p><strong>Rating:</strong> ' . htmlspecialchars($review['Rating']) . '/5</p>';
            echo '<p><strong>Comment:</strong> ' . htmlspecialchars($review['Comment']) . '</p>';
            echo '<p class="text-muted"><small>Reviewed on: ' . date('d M Y', strtotime($review['ReviewDate'])) . '</small></p>';
            echo '</div>';
        }
    } else {
        echo '<p>No reviews available for this book.</p>';
    }
    ?>
  </div>

  <!-- Write a Review Section -->
  <?php if (isset($_SESSION['UserID'])): ?>
  <div class="mt-4">
    <h3>Write a Review</h3>
    <form action="submit_review.php" method="POST">
      <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
      <div class="mb-3">
        <label for="rating" class="form-label"><strong>Rating:</strong></label>
        <select name="rating" id="rating" class="form-select" required>
          <option value="5">5 - Excellent</option>
          <option value="4">4 - Very Good</option>
          <option value="3">3 - Good</option>
          <option value="2">2 - Fair</option>
          <option value="1">1 - Poor</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="comment" class="form-label"><strong>Comment:</strong></label>
        <textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
  </div>
  <?php else: ?>
  <p><a href="backend/login.php" class="btn btn-warning">Log in to write a review</a></p>
  <?php endif; ?>

  <!-- Related Books Section -->
  <div class="mt-5">
    <h3>Related Books</h3>
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <?php
      if ($relatedBooksResult->num_rows > 0) {
          while ($relatedBook = $relatedBooksResult->fetch_assoc()) {
              $relatedImagePath = 'images/' . htmlspecialchars($relatedBook['BookImage']);
              echo '<div class="col">';
              echo '<a href="bookdetails.php?id=' . htmlspecialchars($relatedBook['BookID']) . '">';
              echo '<div class="card">';
              echo '<img src="' . $relatedImagePath . '" alt="' . htmlspecialchars($relatedBook['BookTitle']) . '" class="card-img-top">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">' . htmlspecialchars($relatedBook['BookTitle']) . '</h5>';
              echo '</div>';
              echo '</div>';
              echo '</a>';
              echo '</div>';
          }
      } else {
          echo '<p>No related books found.</p>';
      }
      ?>
    </div>
  </div>
</section>

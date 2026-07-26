<?php 
include 'header.php';

// Get the PlanID from the URL (e.g., ?id=1)
$planID = isset($_GET['id']) ? $_GET['id'] : 0;

// Query to get the plan details from the database
$planQuery = "SELECT * FROM PackagePlan WHERE PlanID = " . $planID;
$planResult = $conn->query($planQuery);

if ($planResult->num_rows > 0) {
    $plan = $planResult->fetch_assoc();
    
    echo '<section class="container py-5">';
    echo '<h2 class="text-center mb-4 text-purple">' . $plan['PlanName'] . ' Details</h2>';
    
    // Plan details section
    echo '<div class="row">';
    echo '<div class="col-md-6 text-center">';
    echo '<img src="images/' . $plan['PlanImage'] . '" class="img-fluid rounded shadow" alt="' . $plan['PlanName'] . '" style="max-width: 80%;">';
    echo '</div>';
    
    echo '<div class="col-md-6">';
    echo '<div class="plan-details">';
    //echo '<h3 class="text-primary">' . $plan['PlanName'] . '</h3>';
    
    // Plan details with improved layout
    echo '<p><strong class="text-dark">Price: </strong><span class="text-success">' . $plan['Price'] . ' </span></p>';
    echo '<p><strong class="text-dark">Books Per Rent: </strong><span class="text-success">' . $plan['BooksPerRent'] . ' </span></p>';
    echo '<p><strong class="text-dark">Rent Duration: </strong><span class="text-success">' . $plan['RentDuration'] . ' days </span></p>';
    echo '<p><strong class="text-dark">Duration: </strong><span class="text-success">' . $plan['Duration'] . ' </span></p>'; // Added Duration
    echo '<p><strong class="text-dark">Note: </strong>' . $plan['Note'] . '</p>';
    
    // Check if the user is logged in
    if (isset($_SESSION['UserID']) && $_SESSION['UserID'] > 0) {
        // Logged-in user, show the proceed to payment button
        echo '<a href="payment_page.php?plan_id=' . $plan['PlanID'] . '" class="btn btn-success btn-lg">Proceed to Payment</a>';
    } else {
        // Not logged in, show a message or redirect to the login page
        echo '<p class="mt-3">Please <a href="backend/login.php" class="text-primary">log in</a> to proceed with the payment.</p>';
    }
    
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
} else {
    echo '<p class="text-center text-danger">Plan not found.</p>';
}
?>


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



<?php include 'footer.php';?>


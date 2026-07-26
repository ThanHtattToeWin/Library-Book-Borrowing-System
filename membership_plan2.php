
<?php include 'header.php';

// Get the PlanID from the URL (e.g., ?id=1)
$planID = isset($_GET['id']) ? $_GET['id'] : 0;

// Query to get the plan details from the database
$planQuery = "SELECT * FROM PackagePlan WHERE PlanID = " . $planID;
$planResult = $conn->query($planQuery);

if ($planResult->num_rows > 0) {
    $plan = $planResult->fetch_assoc();
    
    echo '<section class="container py-5">';
    echo '<h2 class="text-center mb-4">' . $plan['PlanName'] . ' Details</h2>';
    
    // Plan details section
    echo '<div class="row">';
    echo '<div class="col-md-6">';
    echo '<img src="images/' . $plan['PlanImage'] . '" class="img-fluid" alt="' . $plan['PlanName'] . '">';
    echo '</div>';
    echo '<div class="col-md-6">';
    echo '<h3>' . $plan['PlanName'] . '</h3>';
    echo '<p><strong>Price: </strong>' . $plan['Price'] . ' Ks</p>';
    echo '<p><strong>Books Per Rent: </strong>' . $plan['BooksPerRent'] . '</p>';
    echo '<p><strong>Rent Duration: </strong>' . $plan['RentDuration'] . ' days</p>';
    echo '<p><strong>Note: </strong>' . $plan['Note'] . '</p>';
    
    // Directly proceed to payment button
    echo '<a href="payment_page.php?plan_id=' . $plan['PlanID'] . '" class="btn btn-success">Proceed to Payment</a>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
} else {
    echo '<p>Plan not found.</p>';
}
?>
<?php include 'footer.php';?>





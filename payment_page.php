<?php include 'header.php';

// Get the PlanID from the URL (e.g., ?plan_id=1)
$planID = isset($_GET['plan_id']) ? $_GET['plan_id'] : 0;

// Query to get the plan details from the database
$planQuery = "SELECT * FROM PackagePlan WHERE PlanID = " . $planID;
$planResult = $conn->query($planQuery);

if ($planResult->num_rows > 0) {
    $plan = $planResult->fetch_assoc();
    
    echo '<section class="container py-5">';
    echo '<h2 class="text-center mb-4">Payment Details</h2>';
    
    // Payment details section
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
    
    // KPay payment instructions
    echo '<p><strong>Payment Instructions:</strong> Please transfer the payment of <strong>' . $plan['Price'] . ' Ks</strong> using KBZPay to the following number: <strong>+959123456789</strong></p>';
    echo '<p>After completing the payment, please upload a screenshot of the transaction below.</p>';

    // Form for uploading payment screenshot
    echo '<form action="upload_payment.php" method="POST" enctype="multipart/form-data">';
    echo '<input type="hidden" name="plan_id" value="' . $plan['PlanID'] . '">';
    echo '<input type="hidden" name="price" value="' . $plan['Price'] . '">';
    echo '<div class="form-group">';
    echo '<label for="payment_screenshot">Upload Payment Screenshot:</label>';
    echo '<input type="file" name="payment_screenshot" class="form-control" required>';
    echo '</div>';
    echo '<button type="submit" class="btn btn-primary">Submit Screenshot</button>';
    echo '</form>';
    
    echo '</div>';
    echo '</div>';
    echo '</section>';
} else {
    echo '<p>Plan not found.</p>';
}
?> 


<?php include 'footer.php';?>

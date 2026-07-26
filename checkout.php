<?php
include 'header.php';

// Sample delivery fees
$deliveryFees = [
    "Ahlon" => 2000,
    "Bahan" => 2500,
    "Botataung" => 3000,
    "South Dagon" => 3500,
    "Insein" => 4000,
    "North Dagon" => 2000,
    "North Okkalapa" => 2500,
    "Sanchaung" => 3000,
    "Tarmwe" => 3500,
    "South Okkalapa" => 4000
];

// Get user's phone number from session (if logged in)
$userPhone = isset($_SESSION['user_phone']) ? $_SESSION['user_phone'] : "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $region = $_POST['region'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $deliveryFee = $deliveryFees[$city] ?? 0;

    // Store checkout details in session
    $_SESSION['checkout_details'] = [
        'region' => $region,
        'city' => $city,
        'address' => $address,
        'phone' => $phone,
        'deliveryFee' => $deliveryFee
    ];

    // Redirect to confirmcheckout.php
    header("Location: confirmcheckout.php");
    exit();
}
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Fill your info</h2>
    <form method="post" action="confirmcheckout.php">
        <div class="row">
            <!-- Region (Fixed) -->
            <div class="col-md-6">
                <label class="form-label">Region</label>
                <select name="region" class="form-control" readonly>
                    <option value="Yangon">Yangon</option>
                </select>
            </div>

            <!-- City Dropdown -->
            <div class="col-md-6">
                <label class="form-label">City</label>
                <select name="city" id="city" class="form-control" onchange="updateDeliveryFee()" required>
                    <option value="">Select City</option>
                    <?php foreach ($deliveryFees as $city => $fee) { ?>
                        <option value="<?= $city ?>"><?= $city ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <!-- Delivery Fee (Auto-updated) -->
            <div class="col-md-6">
                <label class="form-label">Delivery Fee (MMK)</label>
                <input type="text" id="deliveryFee" name="deliveryFee" class="form-control" readonly>
            </div>

            <!-- Address -->
            <div class="col-md-6">
                <label class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Enter your address" required>
            </div>
        </div>

        <div class="row mt-3">
            <!-- Phone Number -->
            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text">🇲🇲 +95</span>
                    <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($userPhone) ?>" required>
                </div>
            </div>
        </div>

        <!-- Continue Button -->
        <div class="text-center mt-5 mb-5">
            <button type="submit" class="btn btn-primary">Continue</button>
        </div>
    </form>
</div>

<script>
    function updateDeliveryFee() {
        let city = document.getElementById("city").value;
        let fees = {
            "Ahlon": 2000,
            "Bahan": 2500,
            "Botataung": 3000,
            "South Dagon": 3500,
            "Insein": 4000,
            "North Dagon": 2000,
            "North Okkalapa": 2500,
            "Sanchaung": 3000,
            "Tarmwe": 3500,
            "South Okkalapa": 4000
        };
        document.getElementById("deliveryFee").value = fees[city] || "";
    }
</script>

<?php include 'footer.php'; ?>

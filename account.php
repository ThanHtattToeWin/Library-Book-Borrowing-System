<?php
ob_start(); // Start output buffering

include 'header.php'; 

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: backend/login.php");
    exit();
}

$userID = $_SESSION['UserID']; // Get the logged-in user's ID

// Fetch user details from the database
$query = "SELECT * FROM User WHERE UserID = '$userID'"; 
$result = $conn->query($query);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Handle updating user details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_details'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $updateQuery = "UPDATE User SET UserName = '$username', Email = '$email', Phone = '$phone', Address = '$address' WHERE UserID = '$userID'";
    if ($conn->query($updateQuery)) {
        $user['UserName'] = $username;
        $user['Email'] = $email;
        $user['Phone'] = $phone;
        $user['Address'] = $address;
        $successMessage = "Details updated successfully!";
    } else {
        $errorMessage = "Error updating details. Please try again.";
    }
}

// Handle changing password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $passwordQuery = "SELECT Password FROM User WHERE UserID = '$userID'";
    $passwordResult = $conn->query($passwordQuery);
    $passwordRow = $passwordResult->fetch_assoc();

    if (password_verify($currentPassword, $passwordRow['Password'])) {
        if ($newPassword === $confirmPassword) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $changePasswordQuery = "UPDATE User SET Password = '$hashedNewPassword' WHERE UserID = '$userID'";
            if ($conn->query($changePasswordQuery)) {
                $passwordSuccessMessage = "Password changed successfully!";
            } else {
                $passwordErrorMessage = "Error changing password. Please try again.";
            }
        } else {
            $passwordErrorMessage = "New passwords do not match.";
        }
    } else {
        $passwordErrorMessage = "Current password is incorrect.";
    }
}

// Fetch user's membership details
$membershipQuery = "SELECT m.PlanName, um.StartDate, um.EndDate FROM UserMembership um
                    JOIN PackagePlan m ON um.PlanID = m.PlanID
                    WHERE um.UserID = '$userID' ORDER BY um.StartDate DESC";
$membershipResult = $conn->query($membershipQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="account-style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 900px; /* Wider container */
            margin-top: 50px;
        }

        .card-header {
            background-color: #28a745;
            color: white;
            text-align: center;
            font-size: 18px;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .btn-primary, .btn-warning {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
        }

        .text-center {
            font-size: 18px;
            font-weight: bold;
        }

        .card-title {
            font-size: 22px;
            color: #333;
            font-weight: bold;
        }

        .mb-3 label {
            font-weight: bold;
        }

        .days-left {
            color: #28a745;
            font-weight: bold;
        }

        .expired {
            color: #dc3545;
            font-weight: bold;
        }

        .alert {
            margin-top: 15px;
        }

        .form-control {
            font-size: 16px; /* Slightly larger input text */
            padding: 12px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Membership Details -->
    <div class="card">
        <div class="card-header">
            <h4>Membership Details</h4>
        </div>
        <div class="card-body">
            <?php if ($membershipResult->num_rows > 0): ?>
                <?php while ($membership = $membershipResult->fetch_assoc()): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><?php echo htmlspecialchars($membership['PlanName']); ?></h5>
                            <p><strong>Start Date:</strong> <?php echo htmlspecialchars($membership['StartDate']); ?></p>
                            <p><strong>End Date:</strong> <?php echo htmlspecialchars($membership['EndDate']); ?></p>

                            <?php
                            // Calculate the remaining days
                            $endDate = new DateTime($membership['EndDate']);
                            $currentDate = new DateTime();
                            $interval = $currentDate->diff($endDate);
                            $daysLeft = $interval->format('%r%a'); // %r to get the sign for negative and positive values

                            if ($daysLeft >= 0) {
                                echo "<p class='days-left'>Days Left: " . $daysLeft . " days</p>";
                            } else {
                                echo "<p class='expired'>Membership Expired</p>";
                            }
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No active memberships.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- User Account -->
    <div class="card">
        <div class="card-header">
            <h4>User Account</h4>
        </div>
        <div class="card-body">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['UserName']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['Phone']); ?></p>
            <p><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($user['Address'])); ?></p>

            <?php if (isset($successMessage)) echo "<div class='alert alert-success'>$successMessage</div>"; ?>
            <?php if (isset($errorMessage)) echo "<div class='alert alert-danger'>$errorMessage</div>"; ?>
            <?php if (isset($passwordSuccessMessage)) echo "<div class='alert alert-success'>$passwordSuccessMessage</div>"; ?>
            <?php if (isset($passwordErrorMessage)) echo "<div class='alert alert-danger'>$passwordErrorMessage</div>"; ?>

            <br>
            <form method="POST">
                <h4>Edit Profile</h4>
                <div class="mb-3 mt-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['UserName']); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['Phone']); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control" required><?php echo htmlspecialchars($user['Address']); ?></textarea>
                </div>
                <button type="submit" name="update_details" class="btn btn-primary">Update Details</button>
            </form>

            <form method="POST" class="mt-4">
                <h4>Change Password</h4>
                <div class="mb-3">
                    <label>Current Password</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <button type="submit" name="change_password" class="btn btn-warning">Change Password</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

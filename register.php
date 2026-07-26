<?php
include '../database/dbconfig.php';  
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    if (!isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $_POST['phone'], $_POST['address'])) {
        die("All fields are required.");
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Here, we're directly using the password without hashing
        $plainPassword = $password;  // Use password directly (plain text)

        // Prepare the SQL statement
        $query = "INSERT INTO user (UserName, Email, Phone, Address, Password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);  // Now $conn is defined

        if ($stmt) {
            // Bind the parameters
            $stmt->bind_param("sssss", $username, $email, $phone, $address, $plainPassword);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: login.php"); // Redirect to login page
                exit;
            } else {
                $error = "Error: " . $stmt->error;
            }
        } else {
            $error = "Error preparing query: " . $conn->error;
        }

        $stmt->close();
    }
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }
        .register-card {
            width: 100%;
            max-width: 500px;
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .register-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 5px;
        }
        button[type="submit"] {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-bottom: 15px;
        }
        .form-text {
            font-size: 14px;
            color: #888;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="register-container">
    <div class="register-card">
        <h2>Register</h2>
        
        <!-- Display error message if any -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
                <small class="form-text">Password should be at least 6 characters long.</small>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" name="confirmPassword" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</div>
</body>
</html>

<?php include '../footer.php'; ?>  <!-- Include footer -->








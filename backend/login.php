<?php session_start(); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Full screen container for centering */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            padding: 20px;
        }
        .login-card {
            width: 100%;
            max-width: 500px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .btn-custom {
            width: 100%;
            padding: 10px;
        }
        .btn-register {
            background-color: #28a745;
            color: white;
        }
        .btn-register:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <h5 class="mb-3 text-center">Log in to Your Account</h5>

        <!-- Display error message if login fails -->
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['login_error'];
                unset($_SESSION['login_error']); // Clear error after showing
                ?>
            </div>
        <?php endif; ?>

        <form action="loginsuccess.php" method="post">
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-custom">Log In</button>
        </form>

        <div class="mt-3 text-center">
            <p>Don't have an account?</p>
            <a href="register.php" class="btn btn-register btn-custom">Register</a>
        </div>
    </div>
</div>
</body>
</html>

<?php include '../footer.php'; ?> <!-- Include footer -->

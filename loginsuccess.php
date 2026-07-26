<?php
session_start();
include '../database/dbconfig.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the email exists
    $query = "SELECT * FROM User WHERE Email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Check if the password matches (don't change this if your passwords are not hashed)
        if ($password === $user['Password']) {
            // Successful login, set session variables
            $_SESSION['UserID'] = $user['UserID'];
            $_SESSION['UserName'] = $user['UserName']; 
            $_SESSION['UserEmail'] = $user['Email']; 
            $_SESSION['UserRole'] = $user['UserRole'];  // Save user role (admin or normal)

            // Redirect based on user role
            if ($user['UserRole'] === 'Admin') {
                // Admin redirection (This should go to backend/admin folder)
                header("Location: ../backend/admin/admin_dashboard.php"); 
            } else {
                // Normal user redirection
                header("Location: ../index.php");
            }
            exit();
        } else {
            // Incorrect password
            $_SESSION['login_error'] = "Invalid email or password.";
            header("Location: login.php");
            exit();
        }
    } else {
        // No user found
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: login.php");
        exit();
    }
}
?>
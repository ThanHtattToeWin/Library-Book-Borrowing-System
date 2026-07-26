<?php
  session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookOasis</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <!-- FontAwesome -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body>
<header>
    <div class="container-fill">
        <?php include 'database/dbconfig.php'; ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">BookOasis</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                        <li class="nav-item"><a class="nav-link" href="account.php">Account</a></li>

                        <?php if (isset($_SESSION['UserID'])): ?>
                            <li class="nav-item"><a class="nav-link" href="my_books.php">My Books</a></li>
                        <?php endif; ?>

                        <!-- Search Bar -->
                        <li class="nav-item">
                            <form class="d-flex" action="search.php" method="GET">
                                <input class="form-control me-2" type="search" name="query" placeholder="Search in site">
                                <button class="btn btn-outline-light" type="submit">Search</button>
                            </form>
                        </li>

                        <!-- 🔔 Notification Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link position-relative dropdown-toggle" href="#" id="notificationDropdown"
                               role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-bell-fill text-white"></i>
                                <span class="badge bg-danger" id="notification-count">0</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" id="notification-menu">
                                <li><a class="dropdown-item text-center" href="#">No new notifications</a></li>
                            </ul>
                        </li>

                        <!-- Login/Logout Button -->
                        <li class="nav-item ms-3">
                            <?php if (isset($_SESSION['UserID'])): ?>
                                <button class="btn btn-danger">
                                    <a href="backend/logout.php" class="text-white text-decoration-none">Logout</a>
                                </button>
                            <?php else: ?>
                                <button class="btn btn-primary">
                                    <a href="backend/login.php" class="text-white text-decoration-none">Login</a>
                                </button>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</header>

<!-- Bootstrap Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- 🔔 Notifications Script -->
<script>

document.addEventListener("DOMContentLoaded", function () {
    function loadNotifications() {
        fetch("fetch_notifications.php")
            .then(response => response.json())
            .then(data => {
                let notificationMenu = document.getElementById("notification-menu");
                let notificationCount = document.getElementById("notification-count");

                if (!data.success || !data.notifications) {
                    console.error("Error fetching notifications:", data.error);
                    return;
                }

                let notifications = data.notifications;
                notificationMenu.innerHTML = ""; // Clear existing notifications
                let unreadCount = 0;

                if (notifications.length > 0) {
                    notifications.forEach(notification => {
                        if (notification.Is_Read == 0) unreadCount++; // Count unread

                        let listItem = document.createElement("li");
                        listItem.innerHTML = ` 
                            <a class="dropdown-item notification-item ${notification.Is_Read == 0 ? 'bg-warning' : ''}" 
                               href="#" 
                               data-id="${notification.NotificationID}">
                               ${notification.Message}
                            </a>`;
                        notificationMenu.appendChild(listItem);
                    });

                    notificationCount.textContent = unreadCount > 0 ? unreadCount : "0";
                } else {
                    notificationCount.textContent = "0";
                    notificationMenu.innerHTML = `<li><a class="dropdown-item text-center" href="#">No new notifications</a></li>`;
                }
            })
            .catch(error => console.error("Error fetching notifications:", error));
    }

    // ✅ Handle notification clicks and mark as read **WITHOUT redirecting**
    document.getElementById("notification-menu").addEventListener("click", function (event) {
        if (event.target.classList.contains("notification-item")) {
            event.preventDefault();
            let notificationID = event.target.getAttribute("data-id");

            fetch(`mark_notifications.php?id=${notificationID}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        event.target.classList.remove("bg-warning"); // Remove highlight
                        event.target.classList.add("bg-white"); // Change to normal background
                        loadNotifications(); // Refresh notifications count
                    } else {
                        console.error("Failed to mark notification as read:", data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    });

    // Load notifications on page load and refresh every 30 seconds
    loadNotifications();
    setInterval(loadNotifications, 30000);
});
</script>

</body>
</html>

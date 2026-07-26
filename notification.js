document.addEventListener("DOMContentLoaded", function () {
    function loadNotifications() {
        fetch("fetch_notifications.php")
            .then(response => response.json())
            .then(data => {
                let notificationMenu = document.getElementById("notification-menu");
                let notificationCount = document.getElementById("notification-count");

                if (data.length > 0) {
                    notificationCount.textContent = data.length;
                    notificationMenu.innerHTML = "";

                    // Create and add each notification item
                    data.forEach(notification => {
                        let listItem = document.createElement("li");
                        listItem.innerHTML = `<a class="dropdown-item" href="notifications.php">${notification.message}</a>`;
                        notificationMenu.appendChild(listItem);
                    });
                } else {
                    notificationCount.textContent = "0";
                    notificationMenu.innerHTML = `<li><a class="dropdown-item text-center" href="#">No new notifications</a></li>`;
                }
            })
            .catch(error => console.error("Error fetching notifications:", error));
    }

    // Load notifications on page load and refresh every 30 seconds
    loadNotifications();
    setInterval(loadNotifications, 30000);
});

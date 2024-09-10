<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    include ("sidebar.php");
?>
    <div class="main-content">
        <header>
            <h1>Welcome, Admin</h1>
            <button id="menu-toggle">Menu</button>
        </header>
        <div class="content">
            <h2>Register User</h2>
            <form id="registration-form">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Register</button>
            </form>

            <h2>Registered Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="user-table">
                    <!-- Sample registered users -->
                    <tr>
                        <td>john_doe</td>
                        <td>john@example.com</td>
                        <td>
                            <button onclick="viewUserDetails('john_doe', 'john@example.com')">View</button>
                            <button onclick="deleteUser(this)">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>jane_smith</td>
                        <td>jane@example.com</td>
                        <td>
                            <button onclick="viewUserDetails('jane_smith', 'jane@example.com')">View</button>
                            <button onclick="deleteUser(this)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- User Details Modal -->
    <div id="user-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>User Details</h2>
            <p><strong>Username:</strong> <span id="modal-username"></span></p>
            <p><strong>Email:</strong> <span id="modal-email"></span></p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

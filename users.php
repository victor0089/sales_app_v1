<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch user data
$result = $conn->query("SELECT * FROM users");
$users = $result->fetch_all(MYSQLI_ASSOC);

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        // Add new user
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
        $permissions = $_POST["permissions"];

        $conn->query("INSERT INTO users (username, password, permissions) VALUES ('$username', '$password', '$permissions')");
    } elseif (isset($_POST["edit"])) {
        // Edit user
        $user_id = $_POST["user_id"];
        $username = $_POST["username"];
        $permissions = $_POST["permissions"];

        $conn->query("UPDATE users SET username = '$username', permissions = '$permissions' WHERE id = $user_id");
    } elseif (isset($_POST["delete"])) {
        // Delete user
        $user_id = $_POST["user_id"];
        $conn->query("DELETE FROM users WHERE id = $user_id");
    }

    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <h1>User Management</h1>

    <!-- Add new user form -->
    <h2>Add New User</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="permissions">Permissions:</label>
        <input type="text" name="permissions" id="permissions" required>

        <button type="submit" name="add">Add User</button>
    </form>

    <!-- Display user data -->
    <h2>User List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Permissions</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['permissions'] ?></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <button type="submit" name="edit">Edit</button>
                        <button type="submit" name="delete" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Edit user form (hidden by default) -->
    <h2>Edit User</h2>
    <form method="post" action="">
        <input type="hidden" name="user_id" id="edit_user_id">
        <label for="edit_username">Username:</label>
        <input type="text" name="username" id="edit_username" required>

        <label for="edit_permissions">Permissions:</label>
        <input type="text" name="permissions" id="edit_permissions" required>

        <button type="submit" name="edit">Save Changes</button>
    </form>

    <!-- JavaScript to toggle the edit form -->
    <script>
        function showEditForm(user_id, username, permissions) {
            document.getElementById("edit_user_id").value = user_id;
            document.getElementById("edit_username").value = username;
            document.getElementById("edit_permissions").value = permissions;

            // Scroll to the edit form
            document.getElementById("edit_user_id").scrollIntoView();
        }
    </script>
</body>
</html>

<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch customer data
$result = $conn->query("SELECT * FROM customers");
$customerData = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Module</title>
</head>
<body>
    <h1>Customer Module</h1>

    <!-- Display customer data -->
    <table border="1">
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Credit Limit</th>
            <th>Action</th>
        </tr>
        <?php foreach ($customerData as $customer): ?>
            <tr>
                <td><?= $customer['id'] ?></td>
                <td><?= $customer['name'] ?></td>
                <td><?= $customer['credit_limit'] ?></td>
                <td>
                    <a href="edit_customer.php?id=<?= $customer['id'] ?>">Edit</a>
                    <a href="delete_customer.php?id=<?= $customer['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>

    <!-- Add new customer form -->
    <h2>Add New Customer</h2>
    <form method="post" action="add_customer.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="credit_limit">Credit Limit:</label>
        <input type="number" name="credit_limit" id="credit_limit" required>

        <button type="submit">Add Customer</button>
    </form>
</body>
</html>

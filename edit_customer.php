<?php
require_once 'auth.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch customer data
    $result = $conn->query("SELECT * FROM customers WHERE id = $id");
    $customer = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $credit_limit = $_POST["credit_limit"];

    // Update customer data in the database
    $conn->query("UPDATE customers SET name = '$name', credit_limit = $credit_limit WHERE id = $id");

    header("Location: customers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
</head>
<body>
    <h1>Edit Customer</h1>

    <form method="post" action="">
        <input type="hidden" name="id" value="<?= $customer['id'] ?>">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= $customer['name'] ?>" required>

        <label for="credit_limit">Credit Limit:</label>
        <input type="number" name="credit_limit" id="credit_limit" value="<?= $customer['credit_limit'] ?>" required>

        <button type="submit">Save Changes</button>
    </form>
</body>
</html>

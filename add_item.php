<?php
require_once 'auth.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];

    // Insert new item into the products table
    $conn->query("INSERT INTO products (name, price) VALUES ('$name', $price)");

    header("Location: inventory.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>
</head>
<body>
    <h1>Add New Item</h1>

    <form method="post" action="">
        <label for="name">Item Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="price">Item Price:</label>
        <input type="number" name="price" id="price" step="0.01" required>

        <button type="submit">Add Item</button>
    </form>
</body>
</html>

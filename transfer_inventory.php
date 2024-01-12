<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch products and branches data
$resultProducts = $conn->query("SELECT id, name FROM products");
$products = $resultProducts->fetch_all(MYSQLI_ASSOC);

$resultBranches = $conn->query("SELECT id, name FROM branches");
$branches = $resultBranches->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    $from_branch_id = $_POST["from_branch_id"];
    $to_branch_id = $_POST["to_branch_id"];

    // Check if there is enough quantity in the from branch
    $resultFromBranch = $conn->query("SELECT quantity FROM inventory WHERE product_id = $product_id AND branch_id = $from_branch_id");
    $fromBranchData = $resultFromBranch->fetch_assoc();

    if ($fromBranchData && $fromBranchData["quantity"] >= $quantity) {
        // Perform the transfer
        $conn->query("INSERT INTO inventory_transfers (product_id, quantity, from_branch_id, to_branch_id, transfer_date) 
                      VALUES ($product_id, $quantity, $from_branch_id, $to_branch_id, NOW())");

        // Update inventory quantities for the involved branches
        $conn->query("UPDATE inventory SET quantity = quantity - $quantity WHERE product_id = $product_id AND branch_id = $from_branch_id");
        $conn->query("INSERT INTO inventory (product_id, branch_id, quantity) 
                      VALUES ($product_id, $to_branch_id, $quantity)");

        header("Location: view_inventory_transfer.php");
        exit();
    } else {
        $error_message = "Not enough quantity in the from branch.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Inventory</title>
</head>
<body>
    <h1>Transfer Inventory Between Branches</h1>

    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?= $error_message ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="product_id">Select Product:</label>
        <select name="product_id" id="product_id" required>
            <?php foreach ($products as $product): ?>
                <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="1" required>

        <label for="from_branch_id">From Branch:</label>
        <select name="from_branch_id" id="from_branch_id" required>
            <?php foreach ($branches as $branch): ?>
                <option value="<?= $branch['id'] ?>"><?= $branch['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="to_branch_id">To Branch:</label>
        <select name="to_branch_id" id="to_branch_id" required>
            <?php foreach ($branches as $branch): ?>
                <option value="<?= $branch['id'] ?>"><?= $branch['name'] ?></option>
            <?php endforeach; ?>
        </select>


        <button type="submit">Initiate Transfer</button>
    </form>
    // ... Existing code ...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... Existing code ...

    // Update daily record for expense
    $conn->query("INSERT INTO daily_records (record_date, expense) VALUES (CURDATE(), $total)");

    // ... Existing code ...
}

</body>
</html>

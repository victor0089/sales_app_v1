<?php
require_once 'auth.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Fetch sales data for the chosen period
    $result = $conn->query("SELECT * FROM sales WHERE sale_date BETWEEN '$start_date' AND '$end_date'");
    $salesData = $result->fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
</head>
<body>
    <h1>Sales Report</h1>

    <form method="post" action="">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required>

        <button type="submit">Generate Report</button>
    </form>

    <?php if (isset($salesData)): ?>
        <table border="1">
            <tr>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Sale Date</th>
            </tr>
            <?php foreach ($salesData as $sale): ?>
                <tr>
                    <td><?= $sale['product_id'] ?></td>
                    <td><?= $sale['quantity'] ?></td>
                    <td><?= $sale['total'] ?></td>
                    <td><?= $sale['sale_date'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>

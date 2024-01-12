<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch daily records data
$result = $conn->query("SELECT * FROM daily_records");
$dailyRecords = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Daily Records</title>
</head>
<body>
    <h1>View Daily Records</h1>

    <table border="1">
        <tr>
            <th>Record Date</th>
            <th>Income</th>
            <th>Expense</th>
        </tr>
        <?php foreach ($dailyRecords as $record): ?>
            <tr>
                <td><?= $record['record_date'] ?></td>
                <td><?= $record['income'] ?></td>
                <td><?= $record['expense'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

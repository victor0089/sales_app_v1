<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch general journal data
$result = $conn->query("SELECT * FROM general_journal");
$journalEntries = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Journal</title>
</head>
<body>
    <h1>General Journal</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Entry Date</th>
            <th>Description</th>
        </tr>
        <?php foreach ($journalEntries as $entry): ?>
            <tr>
                <td><?= $entry['id'] ?></td>
                <td><?= $entry['entry_date'] ?></td>
                <td><?= $entry['description'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

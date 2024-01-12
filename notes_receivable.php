<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch notes receivable data
$result = $conn->query("SELECT * FROM notes_receivable");
$notesReceivable = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes Receivable</title>
</head>
<body>
    <h1>Notes Receivable</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>General Journal ID</th>
            <th>Amount</th>
        </tr>
        <?php foreach ($notesReceivable as $note): ?>
            <tr>
                <td><?= $note['id'] ?></td>
                <td><?= $note['general_journal_id'] ?></td>
                <td><?= $note['amount'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

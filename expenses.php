<?php
require_once 'auth.php';
require_once 'config.php';

// Fetch expenses data
$result = $conn->query("SELECT * FROM expenses");
$expenses = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        // Add new expense
        $description = $_POST["description"];
        $amount = $_POST["amount"];
        $date = $_POST["date"];

        $conn->query("INSERT INTO expenses (description, amount, expense_date) VALUES ('$description', $amount, '$date')");
    } elseif (isset($_POST["edit"])) {
        // Edit expense
        $expense_id = $_POST["expense_id"];
        $description = $_POST["description"];
        $amount = $_POST["amount"];
        $date = $_POST["date"];

        $conn->query("UPDATE expenses SET description = '$description', amount = $amount, expense_date = '$date' WHERE id = $expense_id");
    } elseif (isset($_POST["delete"])) {
        // Delete expense
        $expense_id = $_POST["expense_id"];

        $conn->query("DELETE FROM expenses WHERE id = $expense_id");
    }

    header("Location: expenses.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Expenses</title>
</head>
<body>
    <h1>Manage Expenses</h1>

    <!-- Add new expense form -->
    <h2>Add New Expense</h2>
    <form method="post" action="">
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" required>

        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" step="0.01" required>

        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>

        <button type="submit" name="add">Add Expense</button>
    </form>

    <!-- Display expenses data -->
    <h2>Expense List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php foreach ($expenses as $expense): ?>
            <tr>
                <td><?= $expense['id'] ?></td>
                <td><?= $expense['description'] ?></td>
                <td><?= $expense['amount'] ?></td>
                <td><?= $expense['expense_date'] ?></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="expense_id" value="<?= $expense['id'] ?>">
                        <button type="submit" name="edit">Edit</button>
                        <button type="submit" name="delete" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Edit expense form (hidden by default) -->
    <h2>Edit Expense</h2>
    <form method="post" action="">
        <input type="hidden" name="expense_id" id="edit_expense_id">
        <label for="edit_description">Description:</label>
        <input type="text" name="description" id="edit_description" required>

        <label for="edit_amount">Amount:</label>
        <input type="number" name="amount" id="edit_amount" step="0.01" required>

        <label for="edit_date">Date:</label>
        <input type="date" name="date" id="edit_date" required>

        <button type="submit" name="edit">Save Changes</button>
    </form>

    <!-- JavaScript to toggle the edit form -->
    <script>
        function showEditForm(expense_id, description, amount, date) {
            document.getElementById("edit_expense_id").value = expense_id;
            document.getElementById("edit_description").value = description;
            document.getElementById("edit_amount").value = amount;
            document.getElementById("edit_date").value = date;

            // Scroll to the edit form
            document.getElementById("edit_expense_id").scrollIntoView();
        }
    </script>
</body>
</html>

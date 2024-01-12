<?php
require_once 'auth.php';
require_once 'config.php';
require_once 'vendor/autoload.php'; // Composer autoload

use Phpml\Regression\LeastSquares;

// Sample Data for demonstration
$salesData = [
    [1, 200],
    [2, 400],
    [3, 600],
    [4, 800],
    // Add more data as needed
];

// Separate features and labels
$features = array_column($salesData, 0);
$labels = array_column($salesData, 1);

// Train the model (linear regression)
$model = new LeastSquares();
$model->train($features, $labels);

// Make predictions
$predictedValues = [];
for ($i = 1; $i <= 5; $i++) {
    $predictedValues[] = [$i, $model->predict([$i])];
}

// Display the predictions
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction Module</title>
</head>
<body>
    <h1>Prediction Module</h1>

    <table border="1">
        <tr>
            <th>Input</th>
            <th>Predicted Output</th>
        </tr>
        <?php foreach ($predictedValues as $prediction): ?>
            <tr>
                <td><?php echo $prediction[0]; ?></td>
                <td><?php echo $prediction[1]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

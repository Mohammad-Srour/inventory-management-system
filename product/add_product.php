<?php
require_once '../db_config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $name = $_POST['product_name'];

    $check = $pdo->prepare("SELECT COUNT(*) FROM products WHERE product_id = ?");
    $check->execute([$product_id]);
    if ($check->fetchColumn() > 0) {
        $message = "❌ This Product ID already exists. Please choose a different ID.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO products (product_id, name) VALUES (?, ?)");
        $stmt->execute([$product_id, $name]);
        $message = "✅ Product added successfully with ID: $product_id";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>

<body>
    <h1>➕Add New Product</h1>

    <form method="post">
        <fieldset>
            <legend>Add Product:</legend>

            <label>Product Id:
                <input type="text" name="product_id" required>
            </label>
            <br><br>

            <label>Product Name:
                <input type="text" name="product_name" required>
            </label>
            <br><br>

            <input type="submit" value="Add">
            <br><br>

            <p>
                <?= $message ?>
            </p>
            <br>
            <a href="./view_products.php">🔙 Back to View_Product</a>
            <br><br>
            <a href="../index.html">🔙Back To HomePage</a>

        </fieldset>
    </form>
</body>

</html>
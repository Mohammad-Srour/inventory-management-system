<?php

require_once '../db_config.php';
$message = '';
if (!isset($_GET['id'])) {
    die('Product ID Not Provided❌');
}
$product_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newName = $_POST['product_name'];

    $stmt = $pdo->prepare('UPDATE products SET name = ? WHERE product_id =? ');
    $stmt->execute([$newName, $product_id]);

    $message = 'Update Successfully ✅';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit_Product</title>
</head>

<body>
    <h1>✏️ Edit_Product</h1>
    <form method="post">
        <fieldset>
            <legend>Edit_Product </legend>
            <label>
                Product_ID:
                <strong><?= $product_id ?></strong>
            </label>
            <br><br>
            <label for="product_name">ProductName:
                <input type="text" name="product_name" id="product_name">
            </label>
            <br><br>
            <input type="submit" value="Update">
            <br><br>
            <?= $message ?>
            <br><a href='view_products.php'>Back To View_Products🔙</a>
        </fieldset>
    </form>
</body>

</html>
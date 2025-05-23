<?php
require_once '../db_config.php';

$message = '';

$stmt = $pdo->prepare('SELECT product_id,name From products');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->prepare('SELECT location_id,name From locations');
$stmt->execute();
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $from_location = $_POST['from_location'];
    $to_location = $_POST['to_location'];
    $quantity = $_POST['quantity'];

    if ($from_location == $to_location) {
        $message = '❌ The product cannot be moved to the same location';
    } else {
        $stmt = $pdo->prepare("INSERT INTO product_movements (product_id,from_location,to_location,qty) VALUES (?,?,?,?)");
        $stmt->execute([$product_id, $from_location, $to_location, $quantity]);
        $message = "✅ Product movement has been successfully recorded.";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movement</title>
</head>

<body>
    <h1>🚚 Add Product Movement</h1>
    <form method="post">
        <fieldset>
            <legend>📝 Movement Details</legend>

            <label>Product:</label>
            <select name="product_id" required>
                <option value="">Select Product</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?= $product['product_id'] ?>"><?= $product['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>


            <label>From Location:</label>
            <select name="from_location" required>
                <option value="">Source</option>
                <?php foreach ($locations as $location): ?>
                    <option value="<?= $location['location_id'] ?>"><?= $location['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>To Location:</label>
            <select name="to_location" required >
                <option value="">Destination</option>
                <?php foreach ($locations as $location): ?>
                    <option value="<?= $location['location_id'] ?>"><?= $location['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>Quantity:</label>
            <input type="number" name="quantity" min="1" required>
            <br><br>

            <input type="submit" value="➕ Add Movement">
            <br><br>

            <strong><?= $message ?></strong>
            <br>
            <a href="./view_movements.php">🔙 Back to View_MovementsProduct</a>
            <br><br>
            <a href="../index.html">🔙Back To HomePage</a>
        </fieldset>






    </form>
</body>

</html>
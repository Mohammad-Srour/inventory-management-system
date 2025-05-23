<?php
require_once '../db_config.php';
$message = '';
if (!isset($_GET['id'])) {
    die('❌ Movement ID not provided.');
}
$movement_id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM product_movements Where movement_id = ? ');
$stmt->execute([$movement_id]);
$movement = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movement) {
    die('❌ Movement not found.');
}

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
    $qty = $_POST['quantity'];

    if ($from_location == $to_location) {
        $message = '❌ Cannot move product to the same location.';
    } else {
        $stmt = $pdo->prepare('UPDATE product_movements SET product_id=?,from_location=?,to_location=?,qty=? WHERE movement_id=?');
        $stmt->execute([$product_id, $from_location, $to_location, $qty, $movement_id]);
        $message = '✅ Movement updated successfully';
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movement</title>
</head>

<body>
    <h1>✏️ Edit Product Movement</h1>
    <form method="post">
        <fieldset>
            <legend>Update</legend>

            <label>Movement_ID:
                <input type="text" value="<?= $movement_id ?>" disabled>
            </label>
            <br><br>

            <label>Product:</label>
            <select name="product_id" required>
                <?php foreach ($products as $product): ?>
                    <option value="<?= $product['product_id'] ?>" <?= $movement['product_id'] == $product['product_id'] ? 'selected' : '' ?>>
                        <?= $product['name'] ?>
                    </option>
                <?php endforeach; ?>

            </select>

            <br><br>

            <label>From_Location:</label>
            <select name="from_location" required>
                <?php foreach ($locations as $location): ?>
                    <option value="<?= $location['location_id'] ?>" <?= $movement['from_location'] == $location['location_id'] ? 'selected' : '' ?>>
                        <?= $location['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>To_Location:</label>
            <select name="to_location" required>
                <?php foreach ($locations as $location): ?>
                    <option value="<?= $location['location_id'] ?>" <?= $movement['to_location'] == $location['location_id'] ? 'selected' : '' ?>>
                        <?= $location['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <label>Quantity:</label>
            <input type="number" name="quantity" min="1" value="<?= $movement['qty'] ?>">
            <br><br>

            <input type="submit" value="🔁 Update"><br><br>
            <strong><?= $message ?></strong>
            <br><br>
            <a href="view_movements.php">🔙 Back to Product_Movements</a>
        </fieldset>
    </form>

</body>

</html>
<?php
require_once '../db_config.php';

$stmt = $pdo->prepare('SELECT pm.movement_id,p.name as product_name ,l1.name as from_location,l2.name as to_location,pm.qty,pm.timestamp

FROM product_movements pm
JOIN products p ON pm.product_id = p.product_id
JOIN locations l1 ON pm.from_location = l1.location_id
JOIN locations l2 ON pm.to_location = l2.location_id

');
$stmt->execute();
$movements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Movements</title>
</head>


<h1>📋 Product Movements</h1>

<?php if (count($movements) > 0): ?>
    <table border="1">
        <tr>
            <th>Movement_ID</th>
            <th>Product_Name</th>
            <th>From_Location</th>
            <th>To_location</th>
            <th>Quantity</th>
            <th>Date/Time</th>
            <th>Action</th>
        </tr>
        <?php foreach ($movements as $movement): ?>
            <tr>
                <td><?= $movement['movement_id'] ?></td>
                <td><?= $movement['product_name'] ?></td>
                <td><?= $movement['from_location'] ?></td>
                <td><?= $movement['to_location'] ?></td>
                <td><?= $movement['qty'] ?></td>
                <td><?= $movement['timestamp'] ?></td>
                <td> <a href="edit_movements.php?id=<?=$movement['movement_id']?>">✏️ Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>🚫 No product movements found</p>
<?php endif; ?>
<br><br>
<a href="add_movement.php">🚚 Add Product Movement</a>
  <br><br>
    <a href="../index.html">🔙Back To HomePage</a>

    <br><br>
<footer>
        <h2>About Us</h2>
        <p><img src="../images/address.png" width="30"><Strong>Address: </Strong>Palestine-Rammallah-Nilien</p>
        <p><img src="../images/phone.png" width="30"><Strong>Phone:</Strong>+970 598350935</p>
        <p><img src="../images/Email.png" width="30"><Strong>Email:</Strong>msroor057@gmail.com</p>
        <p>&copy; 2025 M.Srour_InventoryManagment. All rights reserved.</p>

    </footer>
</body>

</html>
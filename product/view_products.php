<?php
require_once '../db_config.php';

$stmt = $pdo->prepare("SELECT product_id, name FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>List Products</title>
</head>

<body>
    <h1>📦 List_Item</h1>

    <?php if (count($products) > 0): ?>
        <table border="1">
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Action</th>
            </tr>

            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= ($product['product_id']) ?></td>
                    <td><?= ($product['name']) ?></td>
                    <td><a href="edit_product.php?id=<?= $product['product_id'] ?>">✏️ Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>🚫 There Is No Product Yet</p>
    <?php endif; ?>
    <br><br>
   <a href="add_product.php">➕ Add Product</a>
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
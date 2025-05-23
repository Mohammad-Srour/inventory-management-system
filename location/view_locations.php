<?php
require_once '../db_config.php';

$stmt = $pdo->prepare('SELECT location_id,name FROM locations');
$stmt->execute();
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Locations</title>
</head>

<body>
    <h1>📍 List of Locations</h1>
    <?php if (count($locations) > 0): ?>
        <table border="1">
            <tr>
                <td>Location ID</td>
                <td>Location Name</td>
                <td>Action</td>
            </tr>
            <?php foreach ($locations as $location): ?>
                <tr>
                    <td><?= $location['location_id'] ?></td>
                    <td><?= $location['name'] ?></td>
                    <td> <a href="edit_location.php?id=<?= $location['location_id'] ?>">✏️ Edit</a></td>
                </tr>
            <?php endforeach; ?>

        </table>
    <?php else: ?>
        <strong>🚫 No locations added yet</strong>
    <?php endif; ?>
    <br><br>
    <a href="add_location.php">➕ Add Location</a>

    <br><br>
    <a href="../index.html">🔙Back To HomePage</a>

    <footer>
        <h2>About Us</h2>
        <p><img src="../images/address.png" width="30"><Strong>Address: </Strong>Palestine-Rammallah-Nilien</p>
        <p><img src="../images/phone.png" width="30"><Strong>Phone:</Strong>+970 598350935</p>
        <p><img src="../images/Email.png" width="30"><Strong>Email:</Strong>msroor057@gmail.com</p>
        <p>&copy; 2025 M.Srour_InventoryManagment. All rights reserved.</p>

    </footer>

</body>

</html>
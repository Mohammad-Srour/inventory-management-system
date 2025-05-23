<?php
require_once '../db_config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location_id = $_POST['location_id'];
    $location_name = $_POST['location_name'];

    $check = $pdo->prepare('SELECT COUNT(*) from locations WHERE location_id=?');
    $check->execute([$location_id]);
    $exists = $check->fetchColumn();

    if ($exists) {
        $message = "The Id ($location_id) EXISIST ❌";
    } else {
        $stmt = $pdo->prepare("INSERT INTO locations (location_id,name) VALUES(?,?) ");
        $stmt->execute([$location_id, $location_name]);
        $message = "The Location Added Successfully ✅ ";
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddLocation</title>
</head>

<body>
    <h1>➕Add New Location</h1>

    <form method="post">
        <fieldset>
            <legend>🏬 New Location</legend>
            <label>
                LocationID:
                <input type="text" name="location_id" required>
            </label>
            <br><br>
            <label>LocationName:
                <input type="text" name="location_name" required>
            </label>
            <br><br>
            <input type="submit" value="Add Location">
             <br><br>
             <strong><?=$message?></strong>  
             <br><br>
               <a href="./view_locations.php">🔙 Back to View_Locations</a>
            <br><br>
            <a href="../index.html">🔙Back To HomePage</a> 
        </fieldset>
    </form>
</body>

</html>
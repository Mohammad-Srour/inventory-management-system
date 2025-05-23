<?php
require_once '../db_config.php';

$message = '';

if(!isset($_GET['id'])){
    die('Location ID Not Provided❌');
}
$location_id=$_GET['id'];

$stmt=$pdo->prepare('SELECT * FROM locations Where location_id=?');
$stmt->execute(([$location_id]));
$location=$stmt->fetch(PDO::FETCH_ASSOC);

if(!$location){
    die('The Location Not Found ❌');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $newName=$_POST['location_name'];

    $update=$pdo->prepare('UPDATE locations SET name=? WHERE location_id =?');
    $update->execute([$newName, $location_id]);
    $message = 'Update Successfully ✅';

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit_Location</title>
</head>

<body>
    <h1>✏️ Edit_Location</h1>
    <form method="post">
        <fieldset>
            <legend>Edit_Location </legend>
            <label>
                Location_ID:
                <strong><?= $location_id ?></strong>
            </label>
            <br><br>
            <label for="location_name">Location_Name:
                <input type="text" name="location_name" id="location_name">
            </label>
            <br><br>
            <input type="submit" value="Update">
            <br><br>
            <?= $message ?>
            <br><a href='view_locations.php'>Back To View_Location🔙</a>
        </fieldset>
    </form>
</body>

</html>
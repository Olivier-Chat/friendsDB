<?php
require'connexion.php';
$statement = $pdo -> query('SELECT * FROM friend');
$friends = $statement -> fetchAll(PDO::FETCH_ASSOC);
$firstnameValue = "";
$lastnameValue = "";
if (isset($_GET['firstname'],$_GET['lastname'])){
    $firstnameValue = $_GET['firstname'];
    $lastnameValue = $_GET['lastname'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Friends List</title>
</head>
<body>
    <h1>List of friends character</h1>
    <ul>
        <?php foreach ($friends as $friend):?>
        <li><?=$friend['firstname']?> <?= $friend['lastname']?></li>
        <?php endforeach;?>
    </ul>
    <h2>Add a new character</h2>
    <form action="dataTreatment.php" method="post">
        <p>
            <label for="firstname">First Name: </label>
            <input type="text" name="firstname" id="firstname" value="<?=$firstnameValue?>">
            <?php if(isset ($_GET['errorFirstname'])):?>
            <p><?=$_GET['errorFirstname']?></p>
            <?php endif;?>
        </p>
        <p>
            <label for="lastname">Last Name: </label>
            <input type="text" name="lastname" id="lastname"value="<?=$lastnameValue?>">
            <?php if(isset ($_GET['errorLastname'])):?>
            <p><?=$_GET['errorLastname']?></p>
            <?php endif;?>
        </p>
        <button>add</button>
    </form>
</body>
</html>

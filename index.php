<?php
require '_connec.php';
$firstname ="";
$lastname ="";
function cleanInput(string $inputValue):string
{
    $result = trim($inputValue);
    $result = stripslashes($result);
    $result = htmlspecialchars($result);
    return $result;
}
$pdo = new \PDO(DSN, USER, PASS);

$query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
$statement = $pdo -> prepare($query);
if (isset($_POST['firstname'],$_POST['lastname'])){
    $firstname = cleanInput($_POST['firstname']);
    $lastname = cleanInput($_POST['lastname']);
    $statement ->bindValue(':firstname',$firstname,PDO::PARAM_STR);
    $statement ->bindValue(':lastname',$lastname,PDO::PARAM_STR);
    $statement -> execute();
}
$statement = $pdo -> query('SELECT * FROM friend');
$friends = $statement -> fetchAll(PDO::FETCH_ASSOC);

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
    <form action="" method="post">
        <label for="firstname">First Name: </label>
        <input type="text" name="firstname" id="firstname">
        <label for="lastname">Last Name: </label>
        <input type="text" name="lastname" id="lastname">
        <button>add</button>
    </form>
</body>
</html>

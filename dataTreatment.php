<?php
require 'connexion.php';
$firstname ="";
$lastname ="";
function cleanInput(string $inputValue):string
{
    $result = trim($inputValue);
    $result = stripslashes($result);
    $result = htmlspecialchars($result);
    return $result;
}

$query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
$statement = $pdo -> prepare($query);
if (isset($_POST['firstname'],$_POST['lastname'])){
$firstname = cleanInput($_POST['firstname']);
$lastname = cleanInput($_POST['lastname']);
$statement ->bindValue(':firstname',$firstname,PDO::PARAM_STR);
$statement ->bindValue(':lastname',$lastname,PDO::PARAM_STR);
$statement -> execute();
}
$queryString = http_build_query([
    'firstname'=>$firstname,
    'lastname'=>$lastname,
    ]);
header('Location: index.php?'.$queryString);

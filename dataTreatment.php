<?php
require 'connexion.php';
function cleanInput(string $inputValue):string
{
    $result = trim($inputValue);
    $result = stripslashes($result);
    $result = htmlspecialchars($result);
    return $result;
}
$firstname = empty($_POST['firstname'])? "" : cleanInput($_POST['firstname']);
$lastname = empty($_POST['lastname'])? "" : cleanInput($_POST['lastname']);
$errors = [];

if($firstname === "") $errors['errorFirstname'] = "Please fill the first name input";
if($lastname === "") $errors['errorLastname'] = "Please fill the last name input";
if(strlen($firstname) > 45 ) $errors['errorFirstname'] = "First name's number of character shall not exceed 45 characters";
if(strlen($lastname) > 45 ) $errors['errorLastname'] = "Last name's number of character shall not exceed 45 characters";

if (count($errors) === 0){
$query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
$statement = $pdo -> prepare($query);
$statement ->bindValue(':firstname',$firstname,PDO::PARAM_STR);
$statement ->bindValue(':lastname',$lastname,PDO::PARAM_STR);
$statement -> execute();
}

$queryString = http_build_query([
    'firstname'=>$firstname,
    'lastname'=>$lastname,
    ]);
$queryString .= '&';
$queryString .= http_build_query($errors);
header('Location: index.php?'.$queryString);

<?php 
include '../controllers/dbconnect.php';

// Declaration d'un tableau d'erreur
$tabError = [];

// REGEX 
$filterText = '/(^[\wéèêëûüîïôàçæœ\(\)\&\s\-\.\,\_\+\=\/\%€@\'\"\*\\`\!\?\;\[\]]*$)/i';

/* Ajout d'un ariste */
if (isset($filterText, $_POST['submit']))
{
$artist_name = $_POST['addArtist'];
$request = 'INSERT INTO `artist` (`artist_name`) VALUE (?)';
$result = $conn->prepare($request);
$result->bindValue(1, $artist_name, PDO::PARAM_STR);
$result->execute(); 
header('Location: products.php'); 
}

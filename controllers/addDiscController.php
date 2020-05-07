<?php 
include '../controllers/dbconnect.php';

// Fonction permettant l'affichage des artistes dans le select
try {
    $query = $conn->prepare('SELECT * FROM artist ORDER BY artist_name');
    $query->execute();
    $artistList = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

/* Ajout d'un disque */
if (isset($_POST['submit'])) 
{
    $addTitle = $_POST['addTitle'];
    $artist = $_POST['artist'];
    $addLabel = $_POST['addLabel'];
    $addYear = $_POST['addYear'];
    $addGender = $_POST['addGender'];
    $addPrice = $_POST['addPrice'];

    $request = 'INSERT INTO disc (disc_title, artist_id, disc_label, disc_year, disc_genre, disc_price) '
            . 'VALUES (:addTitle, :artist, :addLabel, :addYear, :addGender, :addPrice)';
    $result = $conn->prepare($request);
    $result->bindValue(':addTitle', $addTitle, PDO::PARAM_STR);
    $result->bindValue(':artist', $artist, PDO::PARAM_STR);
    $result->bindValue(':addLabel', $addLabel, PDO::PARAM_STR);
    $result->bindValue(':addYear', $addYear, PDO::PARAM_INT);
    $result->bindValue(':addGender', $addGender, PDO::PARAM_STR);
    $result->bindValue(':addPrice', $addPrice, PDO::PARAM_INT);
    $result->execute();
    header('Location: products.php'); 
}

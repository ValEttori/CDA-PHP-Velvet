<?php
include '../controllers/dbconnect.php';

// récupération de l'id du disque
$id = $_GET['id'];
// déclaration de tableau d'erreur
$tabError = [];
// Fonction permettant l'affichage des artistes dans le select
try {
    $query = $conn->prepare('SELECT * FROM artist ORDER BY artist_name');
    $query->execute();
    $artistList = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

// Fonction permettant l'affichage des informations des tables 'artist' et 'disc'
try {
    $query = $conn->prepare('SELECT * FROM artist JOIN disc ON artist.artist_id = disc.artist_id WHERE disc_id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
$disc = $query->fetch(PDO::FETCH_OBJ);


// Declaration d'un tableau d'erreur
$tabError = [];

// REGEX 
$filterText = '/(^[\wéèêëûüîïôàçæœ\(\)\&\s\-\.\,\_\+\=\/\%€@\'\"\*\\`\!\?\;\[\]]*$)/i';
$filterPrix = '/(^[0-9]{1,4}\.[0-9]{2}$)/';
$filterYear = '/(^(19|20){1}[0-9]{2}$)/';




// Upload d'une image
// Constantes
define('TARGET', '../assets/img/photo/');    // Repertoire cible
define('MAX_SIZE', 100000);    // Taille max en octets du fichier
define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels
 
// Tableaux de donnees
$tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
$infosImg = array();
 
// Variables
$extension = '';
$message = '';
$nomImage = 'fichier';
 
/************************************************************
 * Creation du repertoire cible si inexistant
 *************************************************************/
if( !is_dir(TARGET) ) {
  if( !mkdir(TARGET, 0755) ) {
    exit('Erreur : le répertoire cible ne peut-être créé !');
  }
}
 
/************************************************************
 * Script d'upload
 *************************************************************/
if(!empty($_POST))
{
  // On verifie si le champ est rempli
  if( !empty($_FILES['fichier']['name']) )
  {
    // Recuperation de l'extension du fichier
    $extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
 
    // On verifie l'extension du fichier
    if(in_array(strtolower($extension),$tabExt))
    {
      // On recupere les dimensions du fichier
      $infosImg = getimagesize($_FILES['fichier']['tmp_name']);
 
      // On verifie le type de l'image
      if($infosImg[2] >= 1 && $infosImg[2] <= 14)
      {
        // On verifie les dimensions et taille de l'image
        if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE))
        {
          // Parcours du tableau d'erreurs
          if(isset($_FILES['fichier']['error']) 
            && UPLOAD_ERR_OK === $_FILES['fichier']['error'])
          {
            // On renomme le fichier
            $nomImage = md5(uniqid()) .'.'. $extension;
 
            // Si c'est OK, on teste l'upload
            if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage))
            {
              $message = 'Upload réussi !';
            }
            else
            {
              // Sinon on affiche une erreur systeme
              $message = 'Problème lors de l\'upload !';
            }
          }
          else
          {
            $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
          }
        }
        else
        {
          // Sinon erreur sur les dimensions et taille de l'image
          $message = 'Erreur dans les dimensions de l\'image !';
        }
      }
      else
      {
        // Sinon erreur sur le type de l'image
        $message = 'Le fichier à uploader n\'est pas une image !';
      }
    }
    else
    {
      // Sinon on affiche une erreur pour l'extension
      $message = 'L\'extension du fichier est incorrecte !';
    }
  }
  else
  {
    // Sinon on affiche une erreur pour le champ vide
    $message = 'Veuillez remplir le formulaire svp !';
  }
}




/* Modifications des données*/
if (isset($_POST['update'])) {
    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
        if (!preg_match($filterText, $_POST['title'])) {
            $tabError['title'] = 'Vous utilisez des caractères interdits';
        }
    } else {
        $tabError['title'] = 'Renseignez le champs titre';
    }

    if (!empty($_POST['artist'])) {
        $artist = $_POST['artist'];
    }
    if (!empty($_POST['label'])) {
        $label = $_POST['label'];
    } else {
        $tabError['label'] = 'Renseignez un label';
    }
    if (!empty($_POST['year'])) {
        $year = $_POST['year'];
    } else {
        $tabError['year'] = 'Renseignez une année';
    }
    if (!empty($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $tabError['gender'] = 'Renseignez un genre';
    }
    if (!empty($_POST['price'])) {
        $price = $_POST['price'];
    } else {
        $tabError['price'] = 'Renseignez un prix';
    }

    if (count($tabError) === 0) {
        $query = 'UPDATE disc SET disc_title = :title, disc_year = :year, disc_picture = :picture, disc_label = :label, disc_genre = :gender, disc_price = :price, artist_id = :artist WHERE disc_id = :id';
        $query = $conn->prepare($query);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':year', $year, PDO::PARAM_INT);
        $query->bindValue(':picture', $nomImage, PDO::PARAM_STR);
        $query->bindValue(':label', $label, PDO::PARAM_STR);
        $query->bindValue(':gender', $gender, PDO::PARAM_STR);
        $query->bindValue(':price', $price, PDO::PARAM_INT);
        $query->bindValue(':artist', $artist, PDO::PARAM_INT);
        header('Location: products.php');

        if (!$query->execute()) {
            $tabError['update'] = 'Erreur lors de la modification du disque.';
        }
    }
}

// Fonction de suppression des données
if (isset($_POST['delete'])) {
    $query = 'DELETE FROM `disc` '
        . 'WHERE `disc_id` = :id ';
    $result = $conn->prepare($query);
    $result->bindvalue(':id', $id, PDO::PARAM_INT);
    $result->execute();
    header('Location: products.php');
}

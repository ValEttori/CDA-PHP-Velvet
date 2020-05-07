<?php
include('../controllers/dbconnect.php');
include('../include/header.php');
include('../controllers/detailsController.php');
$id = $_GET['id'];
// On récupère les éléments de la base de données
try {

    $query = $conn->prepare('SELECT * FROM artist JOIN disc ON artist.artist_id = disc.artist_id WHERE disc_id = :id');
    $query->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    // Vérification de la présence de données
    if ($query->rowCount() == 0) {
        die('La table est vide');
    }

    // Boucle pour récupérer les données et les afficher dans le tableau
    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
?>

        <section id="formDetails">
            <legend class="details">
                <dt><?= $row->disc_title ?></dt>
            </legend>
            <div class="row">
                <div class="col-md">
                    <img class="photoDetails" src="../assets/img/photo/<?= $row->disc_picture ?>">
                </div>
                <div class="col-md">

                <div class=row>
              <div class=col-md-4>
                <p class="font-weight-bold">Artiste :</label></p>
              </div>
              <div class=col-md-7>
              <p><?= $row->artist_name ?></p>
              </div>
            </div>
            <div class=row>
              <div class=col-md-4>
                <p class="font-weight-bold">Label :</label></p>
              </div>
              <div class=col-md-7>
              <p><?= $row->disc_label ?></p>
              </div>
            </div>
            <div class=row>
              <div class=col-md-4>
                <p class="font-weight-bold">Année :</label></p>
              </div>
              <div class=col-md-7>
              <p><?= $row->disc_year ?></p>
              </div>
            </div>
            <div class=row>
              <div class=col-md-4>
                <p class="font-weight-bold">Genre :</label></p>
              </div>
              <div class=col-md-7>
              <p><?= $row->disc_genre ?></p>
              </div>
            </div>
            <div class=row>
              <div class=col-md-4>
                <p class="font-weight-bold">Prix :</label></p>
              </div>
              <div class=col-md-7>
              <p><?= $row->disc_price ?> €</p>
              </div>
            </div>
                </div>

            </div>
            <div class="text-center">
                <form action="update.php" method='GET'>
                    <input type="hidden" name='id' value='<?= $row->disc_id ?>'>
                    <input type="submit" class="logBtn btn btn-dark" value='Modifier'>
                    <a href="products.php" class="logBtn btn btn-dark">Retour</a>
                </form>
            </div>
            </div>
        </section>

<?php
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
$conn = null;

// Inclusion du Footer
include('../include/footer.php');
?>
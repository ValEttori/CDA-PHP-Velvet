<?php
include('../controllers/dbconnect.php');
include('../include/header.php');

// On récupère les éléments de la base de données
try {
    $stmt = $conn->prepare('SELECT *
     FROM artist
     JOIN disc
     ON artist.artist_id = disc.artist_id
     ORDER BY artist_name');
    $stmt->execute();

    // Vérification de la présence de données
    if ($stmt->rowCount() == 0) {
        die('La table est vide');
    }
?>

    <!-- On déclare la table -->
    <table>
        <thead>
            <tr>
                <th>
                    <a class="btn btn1 btn-secondary font-weight-bold" href="addArtist.php">Artiste +</a><br>
                    <a class="btn btn2 btn-secondary font-weight-bold" href="addDisc.php">Album +</a>
                </th>
                <th>Album</th>
                <th>Artiste</th>
                <th>Labelle</th>
                <th>Année</th>
                <th>Genre</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Boucle pour récupérer les données et les afficher dans le tableau
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
                <tr>
                    <td><img class="photo" src="../assets/img/photo/<?= $row->disc_picture ?>"></td>
                    <td><?= $row->disc_title ?></td>
                    <td><?= $row->artist_name ?></td>
                    <td><?= $row->disc_label ?></td>
                    <td><?= $row->disc_year ?></td>
                    <td><?= $row->disc_genre ?></td>
                    <td>
                        <form action="details.php" method='get'>
                            <input type="hidden" name='id' value=<?= $row->disc_id ?>>
                            <input type='submit' class="btn btn-dark b_middle" value='Détails'></form>
                    </td>
                </tr>
            <?php
            }
            ?>

            <!-- Fermeture du tableau -->
        </tbody>
    </table>
    <br>
<?php
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
$conn = null;

// Inclusion du Footer
include('../include/footer.php');
?>
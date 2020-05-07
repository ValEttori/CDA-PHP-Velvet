<?php
include('../controllers/addArtistController.php');
include('../include/header.php');
?>


<form id="form" action="" method="POST">
  <div class="text-center">
    <legend>
      <dt>Ajouter un artiste</dt>
    </legend>
  </div>

  <label class="col col-form-label">Artiste :</label>
  <div class="text-center">
    <input type="text" name=addArtist class="form-control" placeholder="Entrez le nom de l'artiste" required>
    <input type="submit" class="logBtn btn btn-dark" name=submit>
    <a href="products.php" class="logBtn btn btn-dark">Retour</a>
  </div>
</form>


<?php
// Inclusion du Footer
include('../include/footer.php');
?>
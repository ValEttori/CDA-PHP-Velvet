<?php
include('../controllers/addDiscController.php');
include('../include/header.php');
?>

<form id="formAdd" action="" method="POST">
  <div class="text-center">
    <legend>
      <dt>Ajouter un album</dt>
    </legend>
  </div>

  <label class="col col-form-label font-weight-bold" for="artist_name">Artiste :</label>

  <div id="AddArtSel">
    <select type="text" class="select form-control" id="artist_name" name="artist">
      <?php
      // Boucle pour récupérer les données et les afficher dans le tableau
      foreach ($artistList as $artist) {
      ?>
        <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
      <?php
      }
      ?>
    </select>
  </div>

  <label class="col col-form-label font-weight-bold">Titre :</label>
  <input type="text" name=addTitle class="form-control" placeholder="Entrez le titre" required>

  <label class="col col-form-label font-weight-bold">Label :</label>
  <input type="text" name=addLabel class="form-control" placeholder="Entrez le label" required>

  <label class="col col-form-label font-weight-bold">Année :</label>
  <input type="number" name=addYear class="form-control" placeholder="Entrez l'année" required>

  <label class="col col-form-label font-weight-bold">Genre :</label>
  <input type="text" name=addGender class="form-control" placeholder="Entrez le genre" required>

  <label class="col col-form-label font-weight-bold">Prix :</label>
  <input type="number" name=addPrice class="form-control" placeholder="Entrez le prix" required>

  <!-- Uploader une image -->
  <label class="col col-form-label font-weight-bold">Jaquette :</label>
  <fieldset>
    <input class="uploadUp2" name="fichier" type="file" id="disc_picture" />
  </fieldset>

  <div class="text-center">
    <input type="submit" class="logBtn btn btn-dark" name=submit>
    <a href="products.php" class="logBtn btn btn-dark">Retour</a>
  </div>
</form>

<?php
// Inclusion du Footer
include('../include/footer.php');
?>
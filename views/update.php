<?php
include('../controllers/updateController.php');
include('../include/header.php');
?>

<section id="formDetails">
  <form enctype="multipart/form-data" action="" method="POST">
    <input type="text" class="forUpdate2 form-control col-lg-11" name="title" id="disc_title" value="<?= $disc->disc_title ?>">
    <div class="row">
      <div class="col-md">
        <img class="photoDetails" src="../assets/img/photo/<?= $disc->disc_picture ?>">
      </div>
      <div>
        <div class="form-group">
          <div class=row>
            <div class=col-md-4>
              <label class="font-weight-bold" for="artist_name">Artiste :</label>
            </div>
            <div class=col-md-7>
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
          </div>

          <div class=row>
            <div class=col-md-4>
              <label class="font-weight-bold" for="disc_label">Label :</label>
            </div>
            <div class=col-md-7>
              <input type="text" class="forUpdate form-control" name="label" id="disc_label" value="<?= $disc->disc_label ?>">
            </div>
          </div>

          <div class=row>
            <div class=col-md-4>
              <label class="font-weight-bold" for="disc_year">Année :</label>
            </div>
            <div class=col-md-7>
              <input type="number" class="forUpdate form-control" name="year" id="disc_year" value="<?= $disc->disc_year ?>">
            </div>
          </div>

          <div class=row>
            <div class=col-md-4>
              <label class="font-weight-bold" for="disc_genre">Genre :</label>
            </div>
            <div class=col-md-7>
              <input type="text" class="forUpdate form-control" name="gender" id="disc_genre" value="<?= $disc->disc_genre ?>">

            </div>
          </div>

          <div class=row>
            <div class=col-md-4>
              <label class="font-weight-bold" for="disc_price">Prix :</label>
            </div>
            <div class=col-md-7>
              <input type="number" class="forUpdate form-control" name="price" id="disc_price" value="<?= $disc->disc_price ?>">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Uploader une image -->
    <fieldset>
      <input class="uploadUp" name="fichier" type="file" id="disc_picture" />
    </fieldset>

    <div class="text-center">
      <input type="submit" id="update" name="update" class="logBtn btn btn-dark" value="Valider">
      <a data-toggle="modal" href="#confirmation" class="logBtn btn btn-dark">Supprimer</a>
      <a href="details.php?id=<?= $id ?>" class="logBtn btn btn-dark">Retour</a>
    </div>
  </form>
</section>
<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="confirmation" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Attention</h4>
      </div>
      <div class="modal-body">
        <p>Voulez-vous supprimer ce produit de la base de données?</p>
        <p>Attention : cette action sera irréversible et vous ne pourrez pas récupérer ces données.</p>
      </div>
      <div class="modal-footer">
        <form action="" method="POST">
          <input type="hidden" id="id_delete" name="id_delete" value="<?= $id ?>">
          <input type="submit" id="delete" name="delete" class="logBtn btn btn-dark" value="Confirmer">
          <input type="button" id="cancel" name="cancel" class="logBtn btn btn-dark" data-dismiss="modal" value="Annuler">
        </form>
      </div>
    </div>
  </div>
  <?php
  // Inclusion du Footer
  include('../include/footer.php');
  ?>
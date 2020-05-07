<?php 
include('../include/header.php');
include('../controllers/dbconnect.php');
?>

	<form role="form" id="form">
	  <fieldset>
        <legend><dt>Inscription</dt></legend>
        <div class="form-group row">
          <label class="col col-form-label">Entrez un nom d'utilisateur :</label>
          <input type="text" placeholder="Nom d'utilisateur" name="email" class="form-control" required>
        </div>
        <div class="form-group row">
          <label class="col col-form-label">Choisissez un mot de passe :</label>
          <input type="password" placeholder="Mot de passe" name="password" class="form-control" required>
        </div>
        <div class="form-group row">
          <label class="col col-form-label">Confirmez votre mot de passe :</label>
          <input type="password" placeholder="Mot de passe" name="confirm_password" class="form-control" required>
        </div>
        <!-- Boutons de validation -->
        <div class="text-center"> 
        <button type="submit" class="logBtn btn btn-dark">Valider</button>
        <button type="reset" class="logBtn btn btn-dark">Annuler</button>
        <!--Bouton de retour accueil-->
		<a href="https://dev.amorce.org/valentin/AFPA/VELVET/views/login.php" class="logBtn btn btn-dark">Retour</a>
        </div>
      </fieldset>   		
	</form>

<?php  
// Inclusion du Footer
include('../include/footer.php');
?>




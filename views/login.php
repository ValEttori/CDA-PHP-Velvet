<?php 
include('../include/header.php');
include('../controllers/dbconnect.php');
?>

<form id="form">
      <fieldset>
        <legend><dt>Connexion</dt></legend>
        <div class="form-group row">
          <label class="col col-form-label" for="contact">Utilisateur :</label>
          <input type="text" placeholder="Nom d'utilisateur" name="email" class="form-control" required>
        </div>
        <div class="form-group row">
          <label class="col col-form-label" for="postal">Mot de passe :</label>
          <input type="password" placeholder="Mot de passe" name="password" class="form-control" required>
        </div>
        <div class="text-left"> 
        <button type="submit" class="logBtn btn btn-dark">Valider</button>
        <a href="https://dev.amorce.org/valentin/AFPA/VELVET/index.php" class="logBtn btn btn-dark">Retour</a>
        <a href="https://dev.amorce.org/valentin/AFPA/VELVET/views/register.php" class="logBtn2 btn btn-dark">Inscription</a>
        </div>
      </fieldset>
</form>

 <?php  
// Inclusion du Footer
include('../include/footer.php');
?>




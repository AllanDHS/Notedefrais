<?php include "components/header.php"; ?>
<?php include "components/navbar.php"; ?>



    <div class="conter">
    <?php if ($showForm) { ?>
        <h1>Inscription</h1>
        <form action="#" method="post">
            <div class="txt_field">
                <input type="text" name="firstname" id="firstname">
                <span></span>
                <label>Prénom *</label>
                <span class="error"><?= $errors['firstname'] ?? '' ?></span>
            </div>

            <div class="txt_field">
                <input type="text" name="lastname" id="lastname">
                <span class="error"><?= $errors['lastname'] ?? '' ?></span>
                <span></span>
                <label>Nom *</label>
            </div>
            <div class="txt_field">
                <input type="email" name="email" id="email">
                <span class="error"><?= $errors['email'] ?? '' ?></span>
                <span></span>
                <label>Email *</label>
            </div>
            <div class="txt_field">
                <input type="text" name="phone" id="phone">
                <span class="error"><?= $errors['phone'] ?? '' ?></span>
                <span></span>
                <label>Téléphone *</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" id="password">
                <span class="error"><?= $errors['password'] ?? '' ?></span>
                <span></span>
                <label>Mot de passe *</label>
            </div>
            <div class="txt_field">
                <input type="password" name="confirm_password" id="confirm_password">
                <span class="error"><?= $errors['confirm_password'] ?? '' ?></span>
                <span></span>
                <label>Confirmation Mot de passe *</label>
            </div>
            <input type="submit" value="Inscription">
            <div class="button">
            <a href="../controllers/controller-home.php" class="cancel">Annuler</a>
            </div>
            <div class="signup_link">
                <p>Déjà un compte ?<a href="../controllers/controller-userconnection.php">Connexion</a></p>
            </div>
        </form>
        <?php } else { ?>
        <h1>Vous êtes inscrit</h1>
        <p>Vous pouvez vous connecter</p>
        <a href="../controllers/controller-userconnection.php">Connexion</a>
        <?php } ?>
    </div>
    

<?php include "components/footer.php"; ?>
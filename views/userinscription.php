<?php include "components/header.php"; ?>
<?php include "components/navbar.php"; ?>


<div class="bodyForm">
    <div class="conter">
        <h1>Inscription</h1>
        <form action="" method="post">
            <div class="txt_field">
                <input type="text" name="lastname" id="lastname" required>
                <span></span>
                <label>Prénom</label>
            </div>

            <div class="txt_field">
                <input type="text" name="firstname" id="firstname" required>
                <span></span>
                <label>Nom</label>
            </div>
            <div class="txt_field">
                <input type="email" name="email" id="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="text" name="phone" id="phone" required>
                <span></span>
                <label>Téléphone</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" id="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <input type="submit" value="Inscription">
            <div class="signup_link">
                <p>Déjà un compte ?<a href="../controllers/controller-userconnection.php"> Connexion</a></p>
            </div>
        </form>
    </div>
</div>

<?php include "components/footer.php"; ?>
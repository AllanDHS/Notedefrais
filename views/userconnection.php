<?php include "components/header.php"; ?>
<?php include "components/navbar.php"; ?>



<div class="bodyForm">
    <div class="conter">
        <h1>Connexion</h1>
        <form action="" method="post">
            <div class="txt_field">
                <input type="email" name="email" id="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" id="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <input type="submit" value="Connexion">
            <div class="signup_link">
                <p>Pas encore de compte ?<a href="../controllers/controller-userinscription.php">S'inscrire</a></p>
            </div>
        </form>
    </div>

</div>

























<?php include "components/footer.php"; ?>
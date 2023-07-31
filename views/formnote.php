<?php include "components/header.php"; ?>
<?php include "components/navbar.php"; ?>


<div class="conter">
<?php if ($showForm) { ?>
    <h2>Formulaire de note de frais</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="txt_field">
            <input type="date" name="payment_date" id="payment_date" value="<?= $_POST['date'] ?? date('Y-m-d') ?>">
            <span></span>
            <label>Date de paiement</label>
            <span class="error"><?= $errors['payment_date'] ?? '' ?></span>
        </div>
        <div class="txt_field">
            <select name="type" id="type">
                <option value="" selected disabled>Type de frais</option>
                <option value="1" name="repas">Repas</option>
                <option value="2"name="deplacement">déplacement</option>
                <option value="3"name="logement">logement</option>
                <option value="4"name="kilometriques">Kilométriques</option>
                <option value="5"name="habillage">habillage</option>
            </select>
        </div>
        <div class="txt_field">
            <input type="text" name="payment_amount" id="payment_amount">
            <span></span>
            <label>Montant TTC en €</label>
            <span class="error"><?= $errors['payment_amount'] ?? '' ?></span>
        </div>
        <div class="txt_field">
            <input type="number" name="tva" id="tva">
            <span></span>
            <label>TVA</label>
            
        </div>
        <div class="txt_field">
            <input type="text" name="montantHt" id="montantHt">
            <span></span>
            <label>Montant HT en €</label>
            
        </div>
            <textarea name="reason_payment" id="desc" cols="43" rows="5" placeholder="Description" id="reason_payment"></textarea>
            <label>justificatifs</label>
            <input type="file" name="proof" id="proof" require>
            <span class="errors"><?= isset($_FILES['proof']) && $_FILES['proof']['error'] != 4 ? 'Fichier sélectionné : ' . $_FILES['proof']['name'] : '' ?></span>

        <input type="submit" value="Envoyer">

    </form>
    <?php } else { ?>
        <h1>La note de frais a bien été enregistré</h1>
        <a href="../controllers/controller-userdashboard.php">Dashboard</a>
        <a href="../controllers/controller-deconnexion.php">Déconnexion</a>

        <?php } ?>
</div>
<?php include "components/header.php"; ?>
<?php include "components/navbar.php"; ?>






<div class="container">
    <div class="title">
        <p>Bonjour <?= $_SESSION['Employes']['firstname'] ?></p>
        <p>Bienvenue sur votre Dashboard</p>
    </div>

    <div class="maincontent">
        <div class="liste">
            <?php var_dump(Frais::getFrais($_SESSION['Employes']['id']))?>
            <?php foreach (Frais::getFrais($_SESSION['Employes']['id']) as $expense) { ?>
            

                <div>
                    <div><span ><?= ucfirst($expense['name']) ?></span> - <span class="expense-date text-secondary"><?= Form::formatDateUsToFr($expense['payment_date']) ?></span></div>
                    <?= $expense['exp_description'] ?>
                </div>
                <span><?= $expense['name'] ?></span>

            <?php } ?>


        </div>

        <div class="note">

        </div>

    </div>
</div>
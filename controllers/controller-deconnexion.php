<?php
    // Démarrer la session si ce n'est pas déjà fait
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Supprimer toutes les variables de session
    session_unset();

    // Détruire la session
    session_destroy();

    // Rediriger l'utilisateur vers la page de connexion ou toute autre page appropriée
    header("Location: controller-userconnection.php");
    exit;
?>

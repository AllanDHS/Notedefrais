<?php

// J'ouvre ma session

session_start();
var_dump($_SESSION);

// Si l'utilisateur est déjà connecté, je le redirige vers le dashboard user
if (isset($_SESSION['Employes'])) {
    header('Location: ../controllers/controller-userdashboard.php');
    exit;
}




// j'appelle mon fichier de configuration
require_once '../config.php';


// j'appelle mes helpers
require_once '../helpers/database.php';
require_once '../helpers/form.php';


// j'appelle mes models
require_once '../models/Employes.php';

$errors = []; // je créé un tableau d'erreurs vide

// Je vérifie si la méthode de requête est bien POST pour lancer mes traitements
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // on recupère les valeurs dans la super global $_POST
    $email = $_POST['email'];
    $password = $_POST['password'];

    // je verifie que le login existe dans la base de données à l'aide de la méthode checkLogin()
    if (Employes::checkIfMailExist($email)) {
        // je verifie que le mot de passe correspond au mdp associé au login à l'aide de la méthode checkPassword()
        if (Employes::checkPassword($email, $password)) {  
            // Si tout est ok, je créé une session et je redirige vers le menu admin
        
            $_SESSION['Employes'] = Employes::getInfoEmployes($email);
            unset($_SESSION['Employes']['password']);  

            header('Location: ../controllers/controller-home.php');
            exit;
        } else {
            $errors['password'] = 'Mauvais mot de passe';
        }
    } else {
        $errors['email'] = 'Mauvais login';
    }
}


// Ferme la session
session_destroy();



// Inclus la vue respective
include "../views/userconnection.php";
?>
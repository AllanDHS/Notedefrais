<?php

session_start();

include '../config.php';
require_once '../helpers/Database.php';
require_once '../models/user.php'; 

include '../helpers/Form.php';


// Nous définissons le tableau d'erreurs
$errors = [];

// Nous définissons une variable permettant cacher / afficher le formulaire
$showForm = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Vérif des champs firstname si vide et pattern

    if (isset($_POST['firstname'])) {

        if (empty($_POST['firstname'])) {
            $errors['firstname'] = 'Le prénom est obligatoire';
        } else if (!preg_match(REGEX_NAME, $_POST['firstname'])) {
            $errors['firstname'] = 'Le prénom n\'est pas valide';
        }
    }

    // Vérif des champs lastname si vide et pattern

    if (isset($_POST['lastname'])) {

        if (empty($_POST['lastname'])) {
            $errors['lastname'] = 'Le nom est obligatoire';
        } else if (!preg_match(REGEX_NAME, $_POST['lastname'])) {
            $errors['lastname'] = 'Le nom n\'est pas valide';
        }
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // verification si c vide
        if (empty($email)) {
            $errors['email'] = 'Champs obligatoire';
            // verification du format
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Mauvais format';
            // verification si l'email existe deja dans la bdd
        } else if (Employes::checkLogin($email)) {
            $errors['email'] = 'Cet email existe déjà';
        }
            

       
    }

    // Vérification de l'input password
    if (isset($_POST['password'])) {
        $password = $_POST['password'];

        // verification si c vide
        if (empty($password)) {
            $errors['password'] = 'Champs obligatoire';
            // verification du format
        } else if (strlen($password) < 8) {
            $errors['password'] = 'Mauvais format';
        }
    }

    // Vérification de l'input confirm_password
    if (isset($_POST['confirm_password'])) {
        $confirm_password = $_POST['confirm_password'];

        // verification si c vide
        if (empty($confirm_password)) {
            $errors['confirm_password'] = 'Champs obligatoire';
            // verification du format
        } else if ($confirm_password != $password) {
            $errors['confirm_password'] = 'les mots de passe ne sont pas identiques';
        }
    }

    // Vérification de l'input phone
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];

        // verification si c vide
        if (empty($phone)) {
            $errors['phone'] = 'Champs obligatoire';
            // verification du format
        } else if (!preg_match(REGEX_PHONE, $phone)) {
            $errors['phone'] = 'Mauvais format';
        }
    }


    if (count($errors) == 0) {
        $showForm = false;
    }


    if (empty($errors)) {
        // instanciation de la classe Employes
        $user = new Employes();
        // utilisation de la méthode adduser pour ajouter un Employes dans la base de données
        // si la méthode retourne true, on cache le formulaire à l'aide de la variable $showForm
        if ($user->addUser($_POST)) {
            $showForm = false;
        } else {
            // nous mettons en place un message d'erreur dans le cas où la requête échouée
            $errors['bdd'] = 'Une erreur est survenue lors de l\'ajout de l\'animal';
        }
    }
}

include "../views/userinscription.php";

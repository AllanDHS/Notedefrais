<?php

// J'ouvre ma session

session_start();
var_dump($_POST);
var_dump($_FILES);

// Si l'utilisateur est déjà connecté, je le redirige vers le dashboard user
// if (isset($_SESSION['Employes'])) {
//     header('Location: ../controllers/controller-userdashboard.php');
//     exit;
// }




// j'appelle mon fichier de configuration
require_once '../config.php';


// j'appelle mes helpers
require_once '../helpers/database.php';
require_once '../helpers/form.php';


// j'appelle mes models
require_once '../models/Employes.php';
require_once '../models/Renseignement_frais.php';



// Nous définissons le tableau d'erreurs
$errors = [];

// Nous définissons une variable permettant cacher / afficher le formulaire
$showForm = true;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['payment_date'])) {

        if (empty($_POST['payment_date'])) {
            $errors['payment_date'] = 'Champs obligatoire';
        } else if (!preg_match(REGEX_DATE, $_POST['payment_date'])) {
            $errors['payment_date'] = 'La date n\'est pas valide';
        }
    }

    if (isset($_POST['payment_amount'])) {

        if (empty($_POST['payment_amount'])) {
            $errors['payment_amount'] = 'Champs obligatoire';
        } else if (!preg_match(REGEX_NUMBER, $_POST['payment_amount'])) {
            $errors['payment_amount'] = 'Le montant n\'est pas valide';
        }
    }

    if (!isset($_POST['type'])) {
        $errors['type'] = 'Champs obligatoire';
    }

    if (isset($_POST['reason_payment'])) {
        if (empty($_POST['reason_payment'])) {
            $errors['reason_payment'] = 'Champs obligatoire';
        }
    }

    if (isset($_POST['proof'])) {
        // Si le ode d'erreur est égal à 4, cela signifie que l'utilisateur n'a pas téléchargé de fichier
        if ($_FILES['proof']['error'] == 4) {
            $errors['proof'] = 'Le justificatif est obligatoire';
        } else {
            // nous récupérons le type du fichier avec son type mime et son extension : ex. image/png
            $mimeUserFile = mime_content_type($_FILES['proof']['tmp_name']);

            // nous utilison la fonction explode() pour séparer le type mine et l'extension
            $type = explode('/', $mimeUserFile)[0];
            $extension = explode('/', $mimeUserFile)[1];

            // nous vérifions que le type du fichier est bien 'image'
            if ($type != 'image') {
                $errors['proof'] = 'Le justificatif doit être une image';

                // nous vérifions que l'extension du fichier est bien une extension autorisée
            } else if (!in_array($extension, UPLOAD_EXTENSIONS)) {
                $errors['proof'] = 'Le justificatif doit être une image de type jpg, jpeg, png, webp ou pdf';
            }

            // nous vérifions que la taille du fichier ne dépasse pas la taille maximale autorisée
            if ($_FILES['proof']['size'] > UPLOAD_MAX_SIZE) {
                $errors['proof'] = 'Le justificatif ne doit pas dépasser 8Mo';
            }
        }
    }

    // Si le tableau d'erreurs est vide, on ajoute la note de frais dans la BDD
    if (empty($erros)) {

        // Nous allons convertir le fichier en base64 pour le stocker dans la BDD
        // Nous récuperoons le contenu du fichier
        $userFile = file_get_contents($_FILES['proof']['tmp_name']);

        // Nous convertissons le contenu du fichier en base64
        $userFileIn64 = base64_encode($userFile);

        if (Frais::addFrais($_POST, $userFileIn64, $_SESSION['Employes']['id'])) {
            $showForm = false;
        } else {
            $errors['bdd'] = 'Une erreur est survenue lors de l\'enregistrement de la note de frais';
        }
    }
}
?>



<?php include "../views/formnote.php";?>
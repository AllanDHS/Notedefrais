<?php

class Employes{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;
    private string $phone;


    /**
     * Ajouter un utilisateur a la base de données
     * @param array $inputs Tableau contenant les données du formulaire
     * @return bool Retourne true si l'utilisateur a bien été ajouté, false si KO
     */

    public static function addUser(array $inputs): bool{

        try{
            // Création d'une instance PDO a la connexion de la bdd
            $pdo = Database::createInstancePDO();
            // Requête SQL pour ajouter un utilisateur
            $sql = "INSERT INTO `employes` (`lastname`, `firstname`, `email_address`, `password`, `phone_number`) VALUES (:nom, :prenom, :email, :password, :phone)";
            // Préparation de la requête
            $stmt = $pdo->prepare($sql);
            // Bind des paramètres pour eviter les injections SQL
            $stmt->bindParam(':nom', $inputs['lastname']);
            $stmt->bindParam(':prenom', $inputs['firstname']);
            $stmt->bindParam(':email', $inputs['email']);
            $stmt->bindParam(':password', password_hash($inputs['password'],PASSWORD_DEFAULT));
            $stmt->bindParam(':phone', $inputs['phone']);


            // Execution de la requête
            return $stmt->execute();
            
        }  catch (PDOException $e) {
            // on affiche le message d'erreur
            echo "Erreur : " . $e->getMessage();
            return false;
        }

    }

    /**
     * Permet de vérifier que le login existe dans la base de données
     * @param string $login le login à vérifier
     * @return bool true si le login existe, false sinon
     */
    public static function checkLogin(string $login): bool
    {

        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM `employes` WHERE `address_mail` = :login"; // marqueur nominatif
            $stmt = $pdo->prepare($sql); // on prepare la requete
            $stmt->bindValue(':login', Form::safeData($login), PDO::PARAM_STR); // on associe le marqueur nominatif à la variable $login
            $stmt->execute(); // on execute la requete

            // A l'aide d'une ternaire, nous vérifions si nous avons un résultat à l'aide de la méthode rowCount()
            // Si le résultat est différent de 0, nous récupérons les données avec la méthode fetch(), sinon nous retournons false
            $stmt->rowCount() != 0 ? $result = true : $result = false;
            return $result;
        } catch (PDOException $e) {
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Permet de verifier le mdp selon un login donné
     * @param string $login le login à vérifier
     * @param string $password le mot de passe à vérifier
     * @return bool true si le mot de passe correspond au login, false sinon
     */
    public static function checkPassword(string $login, string $password): bool
    {

        try {
            $pdo = Database::createInstancePDO(); // Création d'une instance PDO
            $sql = "SELECT * FROM `employes` WHERE `address_mail` = :login"; // marqueur nominatif :login
            $stmt = $pdo->prepare($sql); // on prepare la requete
            $stmt->bindValue(':login', Form::safeData($login), PDO::PARAM_STR); // on associe le marqueur nominatif à la variable $login
            $stmt->execute(); // on execute la requete

            $result = $stmt->fetch(PDO::FETCH_ASSOC); // on recupère le resultat à l'aide d'un fetch

            if (password_verify($password, $result['use_password'])) {
                return true; // si password OK
            } else {
                return false; // si paswword différent
            }
        } catch (PDOException $e) {
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
}



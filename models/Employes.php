<?php

class Employes
{
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
    public static function addUser(array $inputs): bool
    {

        try {
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
            $password = password_hash($inputs['password'], PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':phone', $inputs['phone']);


            // Execution de la requête
            return $stmt->execute();
        } catch (PDOException $e) {
            // on affiche le message d'erreur
            echo "Erreur : " . $e->getMessage();
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
            $sql = "SELECT * FROM `employes` WHERE `email_address` = :login"; // marqueur nominatif :login
            $stmt = $pdo->prepare($sql); // on prepare la requete
            $stmt->bindValue(':login', Form::safeData($login), PDO::PARAM_STR); // on associe le marqueur nominatif à la variable $login
            $stmt->execute(); // on execute la requete

            $result = $stmt->fetch(PDO::FETCH_ASSOC); // on recupère le resultat à l'aide d'un fetch
            $passwordVerify = password_verify($password, $result['password']); // on compare le mot de passe saisi avec le mot de passe hashé de la base de données
            if ($passwordVerify) {
                return true; // si password OK
            } else {
                return false; // si paswword différent
            }
        } catch (PDOException $e) {
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**  
     * permet de verifier si le mail existe dans la base de données
     * @param string $email le mail à vérifier
     * @return bool true si le mail existe, false sinon
     */
    public static function checkIfMailExist(string $email): bool
    {

        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM `employes` WHERE `email_address` = :email"; // marqueur nominatif
            $stmt = $pdo->prepare($sql); // on prepare la requete
            $stmt->bindValue(':email', Form::safeData($email), PDO::PARAM_STR); // on associe le marqueur nominatif à la variable $login
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
     * Permet de récupérer les informations d'un utilisateur à l'aide de son email
     * @param string $email l'email de l'utilisateur
     * @return array|bool Retourne un tableau contenant les informations de l'utilisateur, false si KO
     */
    public static function getInfoEmployes(string $email): array
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM `employes` WHERE `email_address` = :email"; // marqueur nominatif
            $stmt = $pdo->prepare($sql); // on prepare la requete
            $stmt->bindValue(':email', Form::safeData($email), PDO::PARAM_STR); // on associe le marqueur nominatif à la variable $login
            $stmt->execute(); // on execute la requete
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
}

<?php

class Frais
{
    private $id;
    private $payment_date;
    private $payment_amount;
    private $reason_payment;
    private $proof;
    private $validate_date;
    private $cancelation_reason;
    private $id_type_de_frais;
    private $id_employes;
    private $id_status_note;


    /**
     * Ajouts d'une note de frais dans la base de données
     * @param array $inputs les données du formulaire
     * @return bool true si la note de frais a bien été ajouté, false sinon
     */
    public static function addFrais(array $inputs,$proof,$id_employes): bool
    {
        try {
            // Création d'une instance PDO a la connexion de la bdd
            $pdo = Database::createInstancePDO();
            // Requête SQL pour ajouter une note de frais
            $sql = "INSERT INTO `renseignement_frais` (`payment_date`, `payment_amount`, `reason_payment`, `proof`, `id_type_de_frais`, `id_employes`, `id_status_note`) VALUES (:payment_date, :payment_amount, :reason_payment, :proof, :id_type_de_frais, :id_employes, :id_status_note)";
            // Préparation de la requête
            $stmt = $pdo->prepare($sql);
            // Bind des paramètres pour eviter les injections SQL
            $stmt->bindParam(':payment_date', $inputs['payment_date']);
            $stmt->bindParam(':payment_amount', $inputs['payment_amount']);
            $stmt->bindParam(':reason_payment', $inputs['reason_payment']);
            $stmt->bindParam(':proof', $proof);
            $stmt->bindParam(':id_type_de_frais', $inputs['type']);
            $stmt->bindParam(':id_employes', $id_employes);
            $stmt->bindValue(':id_status_note', 1);
            // Execution de la requête
            return $stmt->execute();
        } catch (PDOException $e) {
            // on affiche le message d'erreur
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    /**
     * Récupération des notes de frais d'un utilisateur
     * @param int $id_employes l'id de l'utilisateur
     * @return array|bool les notes de frais de l'utilisateur, false sinon
     */
    public static function getFrais(int $id_employes){

        try{
            // Création d'une instance PDO a la connexion de la bdd
            $pdo = Database::createInstancePDO();
            // Requête SQL pour récupérer les notes de frais d'un utilisateur
            $sql = 'SELECT `employes`.`id` AS id_employes, `employes`.`firstname` AS firstname_employes,`employes`.`lastname` AS lastname_employes,`email_adress` AS employe_email, `type_de_frais`.`name` AS type_de_frais,`type_de_frais`.`id` AS id_type_de_frais,`status_note`.`name` AS status_note,`status_note`.`id` AS status_id,`renseignement_frais`.`id` AS id_note,`renseignement_frais`.`payment_date` AS Date_de_la_note,`renseignement_frais`.`payment_amount` AS amount_payment,`renseignement_frais`.`validate_date` AS validation_date,`renseignement_frais`.`reason_payment` AS reason_payment 
            FROM renseignement_frais
            INNER JOIN type_de_frais ON `renseignement_frais`.`id_type_de_frais` = `type_de_frais`.`id`
            INNER JOIN status_note ON `renseignement_frais`.`id_status_note` = `status_note`.`id`
            INNER JOIN employes ON `renseignement_frais`.`id_employes` = `employes`.`id` WHERE `renseignement_frais`.`id_employes` = :id_employes';
            // Préparation de la requête
            $stmt = $pdo->prepare($sql);
            // Bind des paramètres pour eviter les injections SQL
            $stmt->bindParam(':id_employes', $id_employes);
            // Execution de la requête
            $stmt->execute();
            // Récupération des données
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // on affiche le message d'erreur
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
}

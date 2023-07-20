<?php

class Database
{

    /**
     * permet de créer une instance PDO
     *@return object Instance de PDO ou Message d'erreur
     */
    public static function createInstancePDO(): object{
        try {
            $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
            // A activer en phase de développement
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // on retourne l'instance de PDO
            return $pdo;

        } catch (PDOException $e) {
            // on affiche le message d'erreur
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
}

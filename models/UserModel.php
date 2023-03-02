<?php

require_once "models/Connect.php";

class UserModel extends Connect {



    // Retourne requete email
    protected function getEmail($email)
    {
        // Verification si l'adresse mail est bien enregistrée
        $requete = $this->getBDD()->prepare(
            "SELECT COUNT(*) AS nbEmail FROM users WHERE email=?"
        );
        $requete->execute([$email]);
        return $requete;
    }

    protected function getPassword($password){

        // Vérification de la concordance des mots de passe
        $requete = $this->getBDD()->prepare(
            "SELECT * FROM users WHERE password=?"
        );
        $requete->execute([$password]);
        return $requete;
    }

    protected function addUserBDD($user, $password, $role){
        try {
            $requete = $this->getBDD()->prepare("INSERT INTO users(email, password, role) VALUES (?, ?, ?) ");
            $requete->execute([$user, $password, $role]);
        }
        catch (Exception $exception){
            die($exception->getMessage());
        }

    }
}
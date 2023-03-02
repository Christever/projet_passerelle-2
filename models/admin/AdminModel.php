<?php
require_once "models/Connect.php";

class AdminModel extends Connect{
    private $bdd;

    public function __construct(){
        $this->bdd = $this->getBDD();
    }

    // Fonction comptant les derniers utilisateurs inscrits
    protected function getLastUsers($limit=9999999){
        $req = $this->bdd->query("SELECT * FROM users ORDER BY id DESC LIMIT $limit");
        return $req;
    }

    // Retourne le nb d'utilisateurs enregistrés
    protected function getNbUsers(){
        $req = $this->bdd->query("SELECT COUNT(*) FROM users");
        $result = $req->fetch();
        return $result[0];
    }

    // Retourne les dernières recettes
    protected function getLastRecipt($limit=9999999)
    {
        $req = $this->bdd->query("SELECT * FROM recipt ORDER BY id DESC LIMIT $limit");
        return $req;
    }

    // Retourne le nombre total de recettes
    protected function getNbRecipts(){
        $req = $this->bdd->query("SELECT COUNT(*) FROM recipt");
        $result = $req->fetch();
        return $result[0];
    }

    // Verification si l'adresse mail est bien enregistrée ou non
    protected function getEmail($email)
    {

        $requete = $this->getBDD()->prepare(
            "SELECT COUNT(*) AS nbMail FROM users WHERE email=?"
        );
        $requete->execute([$email]);
        return $requete;
    }

    // Enregistrement d'un nouvel utilisateur
    protected function addUserBDD($user, $password, $role){
        try {
            $requete = $this->getBDD()->prepare("INSERT INTO users(email, password, role) VALUES (?, ?, ?) ");
            $requete->execute([$user, $password, $role]);
        }
        catch (Exception $exception){
            die($exception->getMessage());
        }

    }

    // Enregistrement d'une nouvelle recette
    protected function addReciptBDD($title, $categorie, $niveau, $budget, $temps, $ingredients, $preparation, $photo){
        $requete = $this->getBDD()->prepare(
            "INSERT INTO recipt(title, categorie, niveau, budget, temps, ingredients, preparation, photo) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $ok = $requete->execute([
            $title, $categorie, $niveau, $budget, $temps, $ingredients, $preparation, $photo
        ]);

    }

    // Récupère les données utilisateur suivant son ID
    protected function getUserFromID($id){
        $requete = $this->getBDD()->prepare("SELECT * FROM users WHERE id=?");
        $requete->execute( [$id]);
        return $requete;
    }

    // Modifie un utilisateur ( role )
    protected function modifUserBDD($id, $role){
        $requete = $this->getBDD()->prepare("UPDATE users SET role=? WHERE id=$id");
        $requete->execute([$role]);
    }

    // Suppression d'un utilisateur
    protected function deleteUserBDD($id){
        $requete = $this->getBDD()->prepare("DELETE FROM users WHERE id=?");
        $requete->execute([$id]);
    }

    // Récupère les données d'une recette uivant son ID
    protected function getReciptFromID($id){
        $requete = $this->getBDD()->prepare("SELECT * FROM recipt WHERE id=?");
        $requete->execute([$id]);
        return $requete;
    }

    protected function modifReciptBDD($id, $title, $categorie, $niveau, $budget, $temps, $ingredients, $preparation, $photo=null){
        // Si photo est null alors on garde la photo d'origine
        if ($photo===null) {
            $requete = $this->getBDD()->prepare(
                "UPDATE recipt SET title=?, categorie=?, niveau=?, budget=?, temps=?, ingredients=?, preparation=? WHERE id=$id"
            );
            $requete->execute([
                $title, $categorie, $niveau, $budget, $temps, $ingredients, $preparation
            ]);
        }
        else {
            $requete = $this->getBDD()->prepare(
                "UPDATE recipt SET title=?, categorie=?, niveau=?, budget=?, temps=?, ingredients=?, preparation=?, photo=? WHERE id=$id"
            );
            $requete->execute([
                $title, $categorie, $niveau, $budget, $temps, $ingredients, $preparation, $photo
            ]);
        }

    }

    protected function deleteReciptBDD($id){
        $requete = $this->getBDD()->prepare("DELETE FROM recipt WHERE id=?");
        $requete->execute([$id]);
    }
}
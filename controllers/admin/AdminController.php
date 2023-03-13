<?php
require_once "models/admin/AdminModel.php";
require_once "models/utils/Utils.php";

class AdminController extends AdminModel {

    // Controleur pour la page d'accueil de l'administrateur
    public function admin(){
        // On vérifie que l'utilisateur est bien un administraur
        if (Utils::verifAdmin()){
            $lastUsers      = $this->getLastUsers(3);    // On récupère les derniers utilisateurs enregistrés
            $nbUsers        = $this->getNbUsers();      // On récupère le nombre d'utilisateurs total
            $lastRecipts    = $this->getLastRecipt(3);   // On récupère les dernieres recettes enregistrées
            $nbRecipts      = $this->getNbRecipts();    // On récupère le nombre de recettes total
            require "views/admin/adminView.php";
        }
        else {
            header("location: accueil");
            exit();
        }
    }

    // -------------------------
    // Gestion des utilisateurs
    // -------------------------

    // Affiche la vue pour ajouter un utilisateur
    public function addUserController(){
        // On vérifie que l'utilisateur est bien un administraur
        if (Utils::verifAdmin()) {
            require "views/admin/addUserView.php";
        }
        else {
            header("location: index");
            exit();
        }
    }

    // Vérifications pour ajouter un utilisateur
    public function verifyAddUser(){
        // On vérifie que l'utilisateur est bien un administraur
        if (Utils::verifAdmin()) {

            $user = htmlspecialchars($_POST["email"]);
            $password1 = htmlspecialchars($_POST["password1"]);
            $password2 = htmlspecialchars($_POST["password2"]);
            $role = htmlspecialchars($_POST["role"]);

            if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
                header("location: addUser&&error=1&&message=Adresse mail invalide");
                exit();
            }

            // L'adresse email existe t-elle?
            $req = $this->getEmail($user);
            while ($verif = $req->fetch()) {

                if ($verif["nbMail"] != 0) {
                    header("location: addUser&&error=1&&message=l'adresse mail existe déjà.");
                    exit();
                }
            }

            // Les deux mots de passe sont-ils identiques
            if ($password1 != $password2) {
                header("location: addUser&&error=1&&message=Les deux mots de passe sont différents.");
                exit();
            }

            // On code le mot de passe
            $password = Utils::code($password1);

            // On ajoute l'utilisateur
            $this->addUserBDD($user, $password, $role);

            // On retourne sur la page accueil administration
            header("location: admin&&message=L'utilisateur a bien été ajouté");
            exit();
        }
        else {
            header("location: accueil");
            exit();
        }

    }

    // -----------------------------------------------------------------------------
    // Afficher la vue pour la modification d'un utilisateur
    public function modifUserController(){
        // On vérifie que l'utilisateur est bien un administrateur
        if (Utils::verifAdmin()) {
            $requete = $this->getUserFromID($_GET["id"]);
            $user = $requete->fetch();
            // On vérifie si un tableau ext bien retourné ( si faux, alors on a un ID non valable)
            if (is_array($user)) {
                require "views/admin/modifUserView.php";
            } else {
                header("location: admin");
                exit();
            }
        }
        else {
            header("location: index");
            exit();
        }
    }

    // Vérifications pour modifier un utilisateur
    public function verifModifUser() {
        // On vérifie que l'utilisateur est bien un administraur
        if (Utils::verifAdmin()) {
            $role = htmlspecialchars($_POST["role"]);
            $this->modifUserBDD($_GET["id"], $role);
            header("location: admin");
            exit();
        }
        else {
            header("location: accueil");
            exit();
        }
    }
    //------------------------------------------------------------------------------
    // Affiche la vue pour supprimer un utilisateur
    public function deleteUserController(){
        // On vérifie que l'utilisateur est bien un administraur

        if (Utils::verifAdmin()) {
            $requete = $this->getUserFromID($_GET["id"]);
            $user = $requete->fetch();
     ;
            // On vérifie si un tableau ext bien retourné ( si faux, alors on a un ID non valable)
            if (is_array($user)) {

                require "views/admin/deleteUserView.php";
            } else {
                header("location: admin");
                exit();
            }
        }
        else {
            header("location: accueil");
            exit();
        }
    }

    //  Verifications pour supprimer utilisateur
    public function verifDeleteUser() {
        if (Utils::verifAdmin()) {
            $this->deleteUserBDD($_GET["id"]);
            header("location: admin&&message=L'utilisateur a bien été supprimé");
            exit();
        }
        else {
            header("location: accueil");
            exit();
        }

    }


    //--------------------------------------------------
    // Gestion des recettes
    //--------------------------------------------------

    // Controleur pour ajouter une recette
    public function addReciptController(){
        // On vérifie que l'utilisateur est bien un administraur
        if (Utils::verifAdmin()) {
            require "views/admin/addReciptView.php";
        }
        else {
            header("location: index");
            exit();
        }
    }

    // Vérifications pour ajouter une recette
    public function verifyRecipt(){
        // On vérifie que l'utilisateur est bien un administraur
        if (Utils::verifAdmin()) {

            // Verification si l'image est valide
            Utils::verifImage();
            $message = Utils::$message;

            // Si oui
            if (Utils::$send){
                $title          = htmlspecialchars($_POST["title"]);
                $categorie      = htmlspecialchars($_POST["categorie"]);
                $niveau         = htmlspecialchars($_POST["niveau"]);
                $budget         = htmlspecialchars($_POST["budget"]);
                $temps          = htmlspecialchars($_POST["temps"]);
                $ingredients    = htmlspecialchars($_POST["ingredients"]);
                $preparation    = htmlspecialchars($_POST["preparation"]);

                // On ajoute la recette
                $this->addReciptBDD(
                    $title, $categorie, $niveau, $budget, $temps, $ingredients, $preparation, Utils::$newImage
                );

                header("location: admin&&message=La recette a bien été ajoutée");
                exit();
            }
            // Si non
            else {
                header("location: addRecipt&&error=1&&message=$message");
                exit();
            }

        }
        else {
            header("location: accueil");
            exit();
        }
    }


    // -------------------------------------------------
    // Controleur pour modifier une recette
    public function modifReciptController(){
        if (Utils::verifAdmin()) {
            $requete = $this->getReciptFromID($_GET["id"]);
            $recipt = $requete->fetch();

            // On vérifie si un tableau est bien retourné ( si faux, alors on a un ID non valable)
            if (is_array($recipt)){
                require "views/admin/modifRecipView.php";
            }
            else {
                header("location: admin");
                exit();
            }

        }
        else {
            header("location: index");
            exit();
        }
    }

    // Vérification de la modification d'une recette
    public function verifyModifRecipt(){
        // On vérifie que l'utilisateur est bien un administraur
        if (Utils::verifAdmin()) {
            // Verification si l'image est valide
            if ($_FILES["image"]["size"]!=0){
                Utils::verifImage();
                $message = Utils::$message;
                if (!Utils::$send){
                    header("location: modifRecipt&&error=1&&message=$message");
                    exit();
                }
            }
            else {
                Utils::$send = true;
            }


            // Si oui
            if (Utils::$send){
                $title          = htmlspecialchars($_POST["title"]);
                $categorie      = htmlspecialchars($_POST["categorie"]);
                $niveau         = htmlspecialchars($_POST["niveau"]);
                $budget         = htmlspecialchars($_POST["budget"]);
                $temps          = htmlspecialchars($_POST["temps"]);
                $ingredients    = htmlspecialchars($_POST["ingredients"]);
                $preparation    = htmlspecialchars($_POST["preparation"]);

                // On ajoute la recette

                // Si taille photo = 0, alors on garde la photo d'origine
                if ($_FILES["image"]["size"]===0){
                    $this->ModifReciptBDD(
                        $_GET["id"], $title, $categorie, $niveau, $budget, $temps, $ingredients, $preparation
                    );
                }
                else {
                    $this->ModifReciptBDD(
                        $_GET["id"], $title, $categorie, $niveau, $budget, $temps, $ingredients, $preparation, Utils::$newImage
                    );
                }

                header("location: admin&&message=La recette a bien été modifiée");
                exit();
            }
            // Si non
            else {
                header("location: modifRecipt&&error=1&&message=$message");
                exit();
            }

        }
        else {
            header("location: accueil");
            exit();
        }
    }


    // Controleur suppression recette
    public function deleteReciptController(){
        if (Utils::verifAdmin()) {
            $requete = $this->getReciptFromID($_GET["id"]);
            $recipt = $requete->fetch();
            // On vérifie si un tableau ext bien retourné ( si faux, alors on a un ID non valable)

            if (is_array($recipt)) {
                require "views/admin/deleteReciptView.php";
            } else {
                header("location: admin");
                exit();
            }
        }
        else {
            header("location: accueil");
            exit();
        }
    }

    // Vérification suppression recette
    public function verifyDeleteRecipt(){
        if (Utils::verifAdmin()) {
            $this->deleteReciptBDD($_GET["id"]);
            header("location: admin&&message=La recette a bien été supprimée");
            exit();
        }
        else {
            header("location: accueil");
            exit();
        }
    }

    // Affiche toutes les recettes
    public function adminRecettesController(){
        $lastRecipts    = $this->getLastRecipt();   // On récupère les recettes enregistrées
        require "views/admin/allReciptView.php";
    }

    // Affiche tous les utilisateurs
    public function adminUsersController(){
        $lastUsers = $this->getLastUsers();
        require "views/admin/allUsersView.php";
    }
}
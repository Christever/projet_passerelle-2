<?php
require_once "models/UserModel.php";
require_once "models/utils/Utils.php";

class UserController extends UserModel {


    // Destruction de la session
    public function logout(){
        session_unset();
        session_destroy();
        header("location: accueil");
        exit();
    }


    // Login
    public function login(){
        require "views/login.php";
    }

    // Verifications pour se logger
    public function verifLogin(){
        $userMail       = htmlspecialchars($_POST["email"]);
        $userPassword   = htmlspecialchars($_POST["password"]);

        $password       = Utils::code($userPassword);

        $requete = $this->getEmail($userMail);
        while ($info = $requete->fetch()){
            if ($info["nbEmail"]!=1){
                header("location: login&error=true&&message=Adresse mail inexistante");
                exit();
            }
        }

        $requete = $this->getPassword($password);
        while ($info = $requete->fetch()){
            if ($password===$info["password"]){
                $_SESSION["connected"]=true;
                $_SESSION["role"]=$info["role"];
                if ($_SESSION["role"]==="administrateur"){
                    header("location: admin");
                    exit();
                }
                else {
                    header("location: index");
                    exit();
                }
            }
        }
    }

    // Inscription
    public function register(){
        require "views/registerView.php";
    }

    // Vérification inscription
    public function verifyRegister(){
        $user = htmlspecialchars($_POST["email"]);
        $password1 = htmlspecialchars($_POST["password1"]);
        $password2 = htmlspecialchars($_POST["password2"]);
        $role = "utilisateur"; // Role par défaut

        if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
            header("location: addUser&&error=1&&message=Adresse mail invalide");
            exit();
        }

        // L'adresse email existe t-elle?
        $req = $this->getEmail($user);

        while ($verif = $req->fetch()) {

            if ($verif["nbEmail"] != 0) {
                header("location: register&&error=1&&message=l'adresse mail existe déjà.");
                exit();
            }
        }

        // Les deux mots de passe sont ils identiques
        if ($password1 != $password2) {
            header("location: register&&error=1&&message=Les deux mots de passe sont différents.");
            exit();
        }

        // On code le mot de passe
        $password = Utils::code($password1);

        // On ajoute l'utilisateur
        $this->addUserBDD($user, $password, $role);
        header("location: register&&error=0&&message=Vous avez bien été inscrit. Connectez-vous");
        exit();
    }
}
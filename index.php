<?php

session_start();

define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

// Chargement des controlleurs
require_once "controllers/UserController.php";
require_once "controllers/admin/AdminController.php";
require_once "controllers/ReciptController.php";

// Création des controlleurs
$login  = new UserController();
$admin  = new AdminController();
$recipt = new ReciptController();

try {
    if (empty($_GET["p"])){
        // si vide, on affiche les dernières recettes
        $recipt->index();
    }
    else {
        $url = explode("/", filter_var($_GET["p"]), FILTER_SANITIZE_URL);
        switch ($url[0]){
            case "accueil":
                $recipt->index();
                break;
            case "entrees":
                $recipt->renderCategory("entrees");
                break;
            case "plats":
                $recipt->renderCategory("plats");
                break;
            case "desserts":
                $recipt->renderCategory("desserts");
                break;
            case "logout":
                $login->logout();
                break;
            case "login":
                $login->login();
                break;
            case "verifLogin":
                $login->verifLogin();
                break;
            case "register":
                $login->register();
                break;
            case "verifyRegister":
                $login->verifyRegister();
                break;
            case "admin":
                $admin->admin();
                break;
            case "addUser":
                $admin->addUserController();
                break;
            case "verifAddUser":
                $admin->verifyAddUser();
                break;
            case "modifUser":
                $admin->modifUserController();
                break;
            case "deleteUser":
                $admin->deleteUserController();
                break;
            case "verifDeleteUser":
                $admin->verifDeleteUser();
                break;
            case "verifModifUser":
                $admin->verifModifUser();
                break;
            case "addRecipt":
                $admin->addReciptController();
                break;
            case "verifAddRecipt":
                $admin->verifyRecipt();
                break;
            case "modifRecipt":
                $admin->modifReciptController();
                break;
            case "deleteRecipt":
                $admin->deleteReciptController();
                break;
            case "verifDeleteRecipt":
                $admin->verifyDeleteRecipt();
                break;
            case "verifyModifRecipt":
                $admin->verifyModifRecipt();
                break;
            case "adminRecettes":
                $admin->adminRecettesController();
                break;
            case "adminUsers":
                $admin->adminUsersController();
                break;
            default:
                require "views/404.php";
                break;
        }
    }
}
catch (Exception $exception){
    $error = $exception->getMessage();
    require "views/error.php";
}
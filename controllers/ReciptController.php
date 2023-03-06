<?php
require_once "models/ReciptModel.php";

class ReciptController extends ReciptModel {


    // Page d'accueil, on affiche les dernières recettes
    public function index(){
        $nb     = 3;  // Nombre permettant de choisir le nombre de recettes à afficher
        $req    = $this->getLastRecipts($nb);
        $title  = "Les ${nb} dernières recettes";
        require "views/reciptView.php";
    }

    // Pour afficher les catégories
    public function renderCategory($cat){
        $req = $this->getCategoryRecipts($cat);
        $title = "Les ".$cat;
        require "views/reciptView.php";
    }

}
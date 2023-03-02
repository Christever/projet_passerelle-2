<?php
require_once "models/Connect.php";

class ReciptModel extends Connect {

    private $bdd;

    // TODO: A voir si je garde!!!
    public function __construct(){
        $this->bdd = $this->getBDD();
    }

    // Retourne les dernières recettes
    protected function getLastRecipts($nb){
        $req = $this->bdd->query('SELECT * FROM recipt ORDER BY id DESC LIMIT 3');
        return $req;
    }

    // Retourne les recettes d'une catégorie passée en argument
    protected  function getCategoryRecipts($cat){
        $req = $this->bdd->query("SELECT * FROM recipt WHERE categorie='$cat'");
        return $req;
    }
}
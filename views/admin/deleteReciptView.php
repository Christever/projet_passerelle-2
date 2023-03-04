<?php

if (Utils::verifAdmin()){
    ob_start();
    ?>

    <section class="container d-flex flex-column flex-grow-1">
        <h1 class="text-center text-white mt-5">Suppression d'une recette</h1>

        <div class="form-body bg-primary">
            <h4 class="text-center">Êtes-vous sur de vouloir supprimer cette recette ?</h4>
            <h5 class="lead text-center text-danger">Cette action est irréversible</h5>

            <input value="<?=$recipt['title'];?>" type="text" class="form-control" disabled>
            <div class="text-center my-3">
                <img src="<?="public/images/".$recipt['photo'];?>" alt="Photo recette" style="width: 200px;">
            </div>


            <div class="d-flex mt-3">
                <a  href="admin" class="btn btn-success w-100 me-2">Abandonner</a>
                <a href="verifDeleteRecipt<?='&&id='.$recipt['id']?>" class="btn btn-danger w-100">Valider</a>
            </div>
        </div>
    </section>

    <?php
    $title = "suppression recette";
    $content = ob_get_clean();
    require "views/base.php";
}
else {
    header("location: index");
    exit();
}

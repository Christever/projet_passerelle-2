<?php

if (Utils::verifAdmin()){
    ob_start();
    ?>

    <section class="container d-flex flex-column flex-grow-1">
        <h1 class="text-center text-white mt-5">Suppression d'un utilisateur</h1>

        <div class="form-body bg-primary">
            <h4 class="text-center">Êtes-vous sur de vouloir supprimer cet utilisateur ?</h4>
            <h5 class="lead text-center text-danger">Cette action est irréversible</h5>
            <input value="<?=$user['email'];?>" type="email" class="form-control" disabled>
            <input value="<?=$user['role'];?>" name="role" id="role" class="form-control  mb-3" disabled>

            <div class="d-flex">
                <a  href="admin" class="btn btn-success w-100 me-2">Abandonner</a>
                <a href="verifDeleteUser<?='&&id='.$user['id']?>" class="btn btn-danger w-100">Valider</a>
            </div>
        </div>
    </section>

    <?php
    $title = "suppression utilisateur";
    $content = ob_get_clean();
    require "views/base.php";
}
else {
    header("location: index");
    exit();
}
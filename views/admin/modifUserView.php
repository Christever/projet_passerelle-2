<?php

if (isset($_SESSION["role"]) && $_SESSION["role"] === "administrateur"){
    ob_start();
    ?>

    <section class="container d-flex flex-column flex-grow-1">
        <h1 class="text-center text-white mt-5">Modification d'un utilisateur</h1>

        <div class="form-body bg-primary">
            <?php
            if (isset($_GET["message"])){
                if (isset($_GET["error"])) {
                    if ($_GET["error"]==1)
                        $color ="text-danger";
                    else
                        $color = "text-success";
                }
                ?>
                <span class="d-block text-center <?=$color?>"><?=$_GET['message'];?></span>
                <?php
            }
            ?>
            <form action="verifModifUser<?='&&id='.$user['id']?>" class="" method="post">
                <input value="<?=$user['email'];?>" type="email" class="form-control" id="email" name="email" placeholder="Adresse mail" disabled>
                <select name="role" id="role" class="form-select  mb-3">
                    <option value="utilisateur" class="">Utilisateur</option>
                    <option value="administrateur" class="">Administrateur</option>
                </select>
                <div class="d-flex mt-3">
                    <a href="admin" class="btn btn-danger w-100 me-2">Abandonner</a>
                    <button type="submit" class="btn btn-success w-100">Valider</button>
                </div>

            </form>
        </div>
    </section>

    <?php
    $title = "Mofif. Utilisateur";
    $content = ob_get_clean();
    require "views/base.php";
}
else {
    header("location: index");
    exit();
}
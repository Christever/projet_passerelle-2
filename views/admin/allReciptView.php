<?php

if (Utils::verifAdmin()){
ob_start();
?>

<section class="container d-flex flex-column flex-grow-1">
    <div class="card m-3">
        <div class="card-body">
            <h5 class="card-title text-center fw-bold">Toutes les recettes</h5>
            <h6 class="card-subtitle text-center"></h6>
            <p class="card-text">

            <table class="table table-striped">
                <thead>
                <th class="text-center">Recettes</th>
                <th class="text-center">Photo</th>
                <th class="text-center">Catégorie</th>
                <th class="text-center" colspan="2">Actions rapides</th>
                </thead>
                <tbody>
                <?php

                while ($recipt = $lastRecipts->fetch()){
                    $photo = "public/images/".$recipt["photo"];
                    ?>

                    <tr>
                        <th> <?=$recipt["title"]?></th>
                        <th> <img style="width: 100px;" class="" src="<?=$photo;?>" ></th>
                        <th><?=$recipt["categorie"];?></th>
                        <th><a href="modifRecipt<?='&&id='.$recipt['id'];?>" class="btn btn-warning">Modifier</a></th>
                        <th><a href="deleteRecipt<?='&&id='.$recipt['id'];?>" class="btn btn-danger">Supprimer</a></th>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
            </p>
        </div>
    </div>
</section>
    <?php
    $title = "Les recettes";
    $content = ob_get_clean();
    require "views/base.php";

}
else {
    header("location: index");
    exit();
}
<?php

if (Utils::verifAdmin()){
    ob_start();
?>

<section class="container d-flex flex-column flex-grow-1">
    <h1 class="text-center text-white m-3">Bienvenue sur votre page d' administration</h1>
    <?php
        if (isset($_GET["message"])){
        ?>
    <span class="text-center text-white bg-success rounded-5"><?= $_GET['message']?></span>
    <?php
        }
        ?>
    <div class="row">
        <div class="col-6">
            <div class="card m-3">
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold">Il y a actuellement <?=$nbUsers?> utilisateurs
                        enregistrés</h5>
                    <h6 class="card-subtitle text-center">Les 3 derniers utilisateurs enregistrés</h6>
                    <p class="card-text">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th class="text-center">Utilisateur</th>
                                <th class="text-center">Role</th>

                                <th class="text-center" colspan="2">Actions rapides</th>

                            </thead>
                            <tbody>
                                <?php

                                    while ($user = $lastUsers->fetch()){
                                        // Juste une protecction pour ne pas afficher et suuprimer le compte principal
                                        if ($user["email"]!= "admin@admin.fr"){
                                        ?>
                                <tr>
                                    <th> <?=$user["email"]?></th>
                                    <th><?=$user["role"]?></th>
                                    <th><a href="modifUser<?='&&id='.$user['id'];?>"
                                            class="btn btn-warning ">Modifier</a></th>
                                    <th><a href="deleteUser<?='&&id='.$user['id'];?>"
                                            class="btn btn-danger ">Supprimer</a></th>
                                </tr>
                                <?php
                                      }  
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card m-3">
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold">Il y a actuellement <?=$nbRecipts ?> recettes</h5>
                    <h6 class="card-subtitle text-center">Les 3 dernieres recettes</h6>
                    <p class="card-text">
                    <div class="table-responsive">
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
                                    <th> <img style="width: 100px;" class="" src="<?=$photo;?>"></th>
                                    <th><?=$recipt["categorie"];?></th>
                                    <th><a href="modifRecipt<?='&&id='.$recipt['id'];?>"
                                            class="btn btn-warning">Modifier</a></th>
                                    <th><a href="deleteRecipt<?='&&id='.$recipt['id'];?>"
                                            class="btn btn-danger">Supprimer</a></th>
                                </tr>

                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <a href="addUser" class="btn btn-success w-100 fs-5">Ajouter manuellement un utilistateur</a>
        </div>
        <div class="col-6">
            <span class="">
                <a href="addRecipt" class="btn btn-success w-100 fs-5">Ajouter une recette</a>

            </span>
        </div>
    </div>
</section>

<?php
    $title = "Admin";
    $content = ob_get_clean();
    require "views/base.php";

}
else {
    header("location: index");
    exit();
}
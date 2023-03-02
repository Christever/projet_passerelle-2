<?php
if (Utils::verifAdmin()){
    ob_start();

?>
<section class="container d-flex flex-column flex-grow-1">
<div class="table-responsive">
    <div class="card m-3">
        <div class="card-body">
            <h5 class="card-title text-center fw-bold">Tous les utilisateurs</h5>
            <h6 class="card-subtitle text-center"></h6>
            <p class="card-text">
            <table class="table table-striped">
                <thead>
                <th class="text-center">Utilisateur</th>
                <th class="text-center">Role</th>

                <th class="text-center" colspan="2">Actions rapides</th>

                </thead>
                <tbody>
                <?php

                while ($user = $lastUsers->fetch()){
                ?>
                    <tr>
                        <th> <?=$user["email"]?></th>
                        <th><?=$user["role"]?></th>
                        <th><a href="modifUser<?='&&id='.$user['id'];?>" class="btn btn-warning ">Modifier</a></th>
                        <th><a href="deleteUser<?='&&id='.$user['id'];?>" class="btn btn-danger " >Supprimer</a></th>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
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
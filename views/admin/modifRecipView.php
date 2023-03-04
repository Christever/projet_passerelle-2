<?php

if (Utils::verifAdmin()){
    $title = "Ajout d'une recette";
    ob_start();
    ?>
    <section class="container d-flex flex-column flex-grow-1">
        <h1 class="text-center text-white mt-5">Modification d'une recette</h1>
        <div class="form-body bg-primary w-75">
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
            <form action="verifyModifRecipt<?='&&id='.$recipt['id']?>" class="" method="post" enctype="multipart/form-data">

                <div class="mb-3 input-group">
                    <span class="input-group-text">Nom de la recette</span>
                    <input value="<?=$recipt['title'];?>" type="text" class="form-control" id="title" name="title" placeholder="Nom de la recette" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Temps de préparation</span>
                    <input value="<?=$recipt['temps'];?>" type="time" class="form-control" name="temps" placeholder="Temps necessaire">
                </div>


                <div class="input-group mb-3">
                    <select name="categorie" id="categorie" class="form-select input-group-text me-3">
                        <option value="entrees" class="">Entrée</option>
                        <option value="plats" class="">Plat</option>
                        <option value="desserts" class="">Dessert</option>
                    </select>

                    <select name="niveau" id="niveau" class="form-select input-group-text me-3">
                        <optgroup label="Niveau"></optgroup>
                        <option value="facile" class="">Facile</option>
                        <option value="plats" class="">Moyen</option>
                        <option value="desserts" class="">Difficile</option>
                    </select>

                    <select name="budget" id="budget" class="form-select input-group-text ">
                        <optgroup label="Budget"></optgroup>
                        <option value="abordable" class="">Abordable</option>
                        <option value="cher" class="">Cher</option>
                        <option value="tresCher" class="">Très cher</option>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="form-floating me-2">
                            <textarea name="ingredients" id="" cols="30" rows="10" class="form-control" style="height: 300px;"><?=$recipt['ingredients'];?></textarea>
                            <label for="ingredient">Ingrédients</label>
                        </div>
                        <div class="form-floating">
                            <textarea name="preparation" id="" cols="30" rows="10" class="form-control" style="height: 300px;"><?=$recipt['preparation'];?></textarea>
                            <label for="preparation">Préparation</label>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="input-group custom-file-button ">
                        <?php
                        $photo = "public/images/".$recipt["photo"];

                        ?>
                        <input class="form-control input-group-text" type="file" value="<?php $recipt["photo"];?>" name="image" src="<?=$photo;?>" >
                        <span class="input-group-text">Choisissez une photo</span>
                        <img src="<?=$photo?>" alt="" class="input-group-text" style="width: 60px;">
                    </div>
                    <span class="lead">Laissez vide pour utiliser la photo actuelle</span>
                </div>
                <div class="d-flex mt-3">
                    <a href="admin" class="btn btn-danger w-100 me-2">Abandonner</a>
                    <button type="submit" class="btn btn-success w-100">Valider</button>
                </div>



            </form>
        </div>
    </section>
    <?php
    $content = ob_get_clean();
    require "views/base.php";
}
else {
    header("location: index");
    exit();
}
?>

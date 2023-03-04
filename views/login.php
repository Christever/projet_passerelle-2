<?php
ob_start();
?>
    <section class="container d-flex flex-column h-100 flex-grow-1">

        <div class="bg-primary form-body">
            <?php
            if (isset($_GET["error"])){
                ?>
                <span class="d-block text-danger text-center"><?=$_GET["message"];?></span>
                <?php
            }
            ?>

            <?php
            if (isset($_GET["success"])){
                ?>
                <span class="d-block text-success text-center">Vous êtes mintenant connecté</span>
                <?php
            }
            ?>

            <h3 class="text-center text-white">Connexion</h3>
            <form action="verifLogin" method="post" >
                <input type="email" class="form-control" required placeholder="Votre email" name="email">
                <input type="password" class="form-control" required placeholder="Votre mot de passe" name="password">
                <?php
                if (isset($_SESSION["connected"])){
                    ?>
                    <span class="bg-info text-center d-block">Vous êtes deja connecté</span>
                    <?php
                }
                else {
                    ?>
                    <button type="submit" class="btn btn-success w-100 mb-3">Valider</button>
                    <?php
                }
                ?>
            </form>

            <span>
            Pas encore membre ?
                <a href="register" class="text-black">Inscrivez-vous</a>
            </span>
        </div>
    </section>
<?php
$title = "Connexion";
$content    = ob_get_clean();
require "views/base.php";

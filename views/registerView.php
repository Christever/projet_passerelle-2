<?php
    $title = "inscription";
?>
    <section class="container d-flex flex-column flex-grow-1">
        <h1 class="text-center text-white mt-5">Ajout d'un utilisateur</h1>
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
            <form action="verifyRegister" class="" method="post">

                <input type="email" class="form-control" id="email" name="email" placeholder="Adresse mail" required>

                <input type="password" class="form-control" id="password1" name="password1" placeholder="Mot de passe" required>

                <input type="password" class="form-control" id="password2" name="password2" placeholder="Confimez le mot de passe" required>

                <div class="d-flex mt-3">
                    <a href="login" class="btn btn-danger w-100 me-2">Abandonner</a>
                    <button type="submit" class="btn btn-success w-100">Valider</button>
                </div>

            </form>


            <p class="text-center pt-3">
                Déja membre ?
                <a href="login" class="text-black">Connectez-vous</a>
            </p>

        </div>
    </section>
<?php
    $content = ob_get_clean();
    require "views/base.php";

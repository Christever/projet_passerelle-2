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
        <form action="verifAddUser" class="" method="post">

            <input type="email" class="form-control" id="email" name="email" placeholder="Adresse mail" required>

            <input type="password" class="form-control" id="password1" name="password1" placeholder="Mot de passe" required>

            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confimez le mot de passe" required>

            <?php
            # Si utilisateur est un admin, alors il peut choisir le role du nouvel utilistateur
            if (Utils::verifAdmin()){
            ?>
                <select name="role" id="role" class="form-select  mb-3">
                    <option value="utilisateur" class="">Utilisateur</option>
                    <option value="administrateur" class="">Administrateur</option>
                </select>
            <?php
            }
            ?>

            <div class="d-flex mt-3">
                <a href="admin" class="btn btn-danger w-100 me-2">Abandonner</a>
                <button type="submit" class="btn btn-success w-100">Valider</button>
            </div>

        </form>

        <?php
        if (!isset($_SESSION["connected"]) ){
        ?>
            <p class="text-center pt-3">
                Déja membre ?
                <a href="login" class="text-black">Connectez-vous</a>
            </p>
        <?php
        }
        ?>
    </div>
</section>
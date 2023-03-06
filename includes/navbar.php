<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary text-white">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Navbar brand -->

        <!-- Toggle button -->
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-label="Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarMenu">
            <!-- Left links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold fs-4" href="<?= URL?>accueil">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold fs-4" href="entrees">Les entrées</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold fs-4 " href="plats">Les plats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold fs-4" href="desserts">Les desserts</a>
                </li>

                <?php

                // On vérifie si l'utilisateur est connecté
                if (isset($_SESSION["connected"]) && $_SESSION["connected"] ){
                    // On vérifie si il a un role d' administrateur
                    if (isset($_SESSION["role"]) && $_SESSION["role"] === "administrateur")
                    {
                    ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-bold fs-4" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Administration
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-black" href="admin">Page d'administration</a></li>
                        <li><a class="dropdown-item text-black" href="adminRecettes">Gestion des recettes</a></li>
                        <li><a class="dropdown-item text-black" href="adminUsers">Gestion des utilisateurs</a></li>
                    </ul>
                </li>
                <?php
                    }
                ?>
                <a id="connect" class="nav-link text-white fw-bold fs-4" href="logout">Se deconnecter</a>
                <?php
                    }
                    else {
                    ?>
                <a id="disconnect" class="nav-link text-white fw-bold fs-4" href="login">Se connecter</a>
                <?php
                    };
                    ?>
                </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
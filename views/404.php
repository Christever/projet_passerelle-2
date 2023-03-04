<?php

$title = "Erreur";
ob_start();

?>

<section class="container d-flex flex-column flex-grow-1" id="view-404">
    <h1 class="fw-bold">OUPS</h1>
    <p class="fw-bold">Quelqu'un a mangé la page...</p>
</section>

<?php
$content = ob_get_clean();
require "base.php";
?>
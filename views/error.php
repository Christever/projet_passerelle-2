<?php
    $title = "erreur";
    ob_start();
?>

<section class="container">

    <h1>OUPS !</h1>
    <p><?=$error?></p>

</section>

<?php
    $content = ob_get_clean();
    require ("views/base.php");
?>
<?php
ob_start();
?>
    <section class="container d-flex flex-column flex-grow-1">
        <h1 class="text-center my-3 text-white"><?=$title?></h1>
        <div class="row">
            <?php

            while ($recip = $req->fetch()){

                $photo = "public/images/".$recip["photo"];
                ?>

                <div class="col-lg-4 col-md-6">
                    <div class="card m-3">
                        <img class="card-img-top img_card" src="<?=$photo;?>" >

                        <div class="card-body">
                            <h5 class="card-title"><?=$recip["title"]?></h5>
                            <p class="card-text">
                            <ul>
                                <li><span class="fw-bold">Niveau : </span><?=$recip["niveau"]?></li>
                                <li><span class="fw-bold">Budget : </span><?=$recip["budget"]?></li>
                                <li><span class="fw-bold">Temps  : </span><?=$recip["temps"]?></li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            };?>
        </div>

    </section>

<?php

$content = ob_get_clean();
require "views/base.php";
?>
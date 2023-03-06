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

        <div class="col-lg-4 col-md-6 recette">
            <div class="card m-3">
                <img class="card-img-top img_card" src="<?=$photo;?>" alt="Image d'une recette">

                <div class="card-body">
                    <h5 class="card-title"><?=$recip["title"]?></h5>
                    <p class="card-text">
                    <ul>
                        <li><span class="fw-bold">Niveau : </span><?=$recip["niveau"]?></li>
                        <li><span class="fw-bold">Budget : </span><?=$recip["budget"]?></li>
                        <li><span class="fw-bold">Temps : </span><?=$recip["temps"]?></li>
                    </ul>
                    </p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-light w-100 bm" id="buttonModal" data-bs-toggle="modal"
                        data-bs-target="#recipt-modal" data-blog-id="<?=$recip['id']?>"
                        data-blog-title="<?=$recip['title']?>" data-blog-preparation="<?=$recip['preparation']?>"
                        data-blog-ingredients="<?=$recip['ingredients']?>">En savoir plus
                    </button>
                </div>
            </div>
        </div>
        <?php
            };?>
    </div>

</section>

<div id="recipt-modal" class="modal fade " data-bs-backdrop="static">
    <div class="modal-dialog bg-success">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"></h5>
                <button class="btn-close" id="btnModal" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="card-subtitle fw-bold ">Ingédients</div>
                        <div class="card-text mb-3" id="ingredients"></div>
                        <div class="card-subtitle fw-bold ">Préparation</div>
                        <div class="card-text mb-3" id="preparation"></div>


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


<script src="public/js/modal.js"></script>
<?php

$content = ob_get_clean();
require "views/base.php";
?>
<?php include_once('header.php') ?>

<?php include_once('./functions/obtener-trabajos.php') ?>

<div class="uk-container uk-container-large">

    <div class="uk-margin-medium-top">
        <a class="uk-button uk-button-primary" href="./"><span uk-icon="arrow-left"></span> Categorías</a>
    </div>

    <div class="logo-simposio-container">
        <img src="./img/logo-simposio.png" alt="" class="logo-simposio">
    </div>


    <div class="uk-grid-match uk-child-width-1-4@s uk-text-center" uk-grid>
        <?php while($row = $result->fetch_assoc()) { ?>
        <div class="poster">
            <div class="uk-card uk-card-default uk-card-body">
                <img class="uk-margin-bottom icon-poster" src="./img/poster.png" alt="poster">
                <div class="categoria-container">
                    <p><?php echo $row['descripcion_categoria']; ?></p>
                </div>
                <p><strong><?php echo $row['descripcion']; ?></strong></p>
                <button id="1" class="uk-button uk-button-primary btn-categoria" data-id_categoria="1"> Votar</button>
            </div>
        </div>
        <?php } ?>
    </div>





</div>















<?php include_once('footer.php') ?>
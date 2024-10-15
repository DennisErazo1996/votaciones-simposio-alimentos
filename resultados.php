<?php include_once('header.php') ?>

<?php include_once('./functions/obtener-resultados-categorias.php') ?>

<div class="uk-container uk-container-large">

    <div class="uk-margin-medium-top">
        <a class="uk-button uk-button-primary" href="./"><span uk-icon="arrow-left"></span> Categorías</a>
    </div>

    <div class="logo-simposio-container">
        <img src="./img/logo-general-simposio.png" alt="" class="logo-simposio">
        <h3 class="uk-margin-remove"><strong>Ganadores</strong> de cada categoría, muchas felicidades</h3>
        <br><br>
    </div>


    <div class="uk-grid-match uk-child-width-1-4@s uk-text-center" uk-grid>
        <?php while($row = $result->fetch_assoc()) { ?>
        <div class="poster">
            <div class="uk-card uk-card-default uk-card-body">
                <?php
    	            if($row['id_categoria'] == 1 || $row['id_categoria'] == 3){
                        echo '<img class="uk-margin-bottom icon-poster" src="./img/poster.png" alt="poster">';
                        echo '<h2>Póster</h2>';
                    }else{
                        echo ' <img class="uk-margin-bottom icon-poster" src="./img/presentacion-oral.png" alt="poster">';
                        echo '<h3>Presentación</h3>';
                    }
                ?>
                <div class="categoria-container-votacion uk-padding-small">
                    <p><?php echo $row['descripcion_trabajo']; ?></p>
                </div>
                <p>Categoría: <strong><?php echo $row['categoria']; ?></strong></p>
                <p>VOTOS:</p>
                <div class="">
                    <h1 class="votos"><?php echo $row['votos']; ?></h1>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>





</div>

<?php include_once('footer.php') ?>
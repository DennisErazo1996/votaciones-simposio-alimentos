<?php  include_once('header.php')  ?>

<div id="loading">
    <div class="la-ball-scale-pulse la-dark la-3x">
        <div></div>
        <div></div>
    </div>
</div>


<header>
    <img class="logo-unag-blanco" src="./img/logo-unag-blanco.png" alt="logo-unag-blanco">
</header>


<div class="uk-container uk-container-large">

    <div class="uk-margin-medium-top">
        <a class="uk-button uk-button-primary" href="https://portal.unag.edu.hn/v-simposio-de-alimentos/"><span uk-icon="arrow-left"></span> Regresar</a>
    </div>

    <div class="logo-simposio-container">
        <img src="./img/logo-simposio.png" alt="" class="logo-simposio">
        <a class="uk-button uk-button-primary"  uk-toggle="target: #modal-identificador"><span uk-icon="user"></span> Ingrese su identificador</a>
    </div>

    <h2 class="uk-heading-line"><span>Votaciones | Categorías</span></h2><br>

    <div class="uk-grid-match uk-child-width-expand@s uk-text-center" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <img class="uk-margin-bottom icon-poster" src="./img/poster.png" alt="poster">
                <div class="categoria-container">
                    <p>Categoría:</p>
                </div>
                <p>Mejor <strong>Póster</strong> presentado por <strong>Estudiantes</strong></p>
                <a class="uk-button uk-button-primary"><span uk-icon="chevron-right"></span> Seleccionar</a>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
            <img class="uk-margin-bottom icon-poster" src="./img/presentacion-oral.png" alt="poster">
                <div class="categoria-container">
                    <p>Categoría:</p>
                </div>
                <p>Mejor <strong>Presentación Oral</strong> por <strong>Estudiantes</strong></p>
                <a class="uk-button uk-button-primary"><span uk-icon="chevron-right"></span> Seleccionar</a>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
            <img class="uk-margin-bottom icon-poster" src="./img/poster.png" alt="poster">
                <div class="categoria-container">
                    <p>Categoría:</p>
                </div>
                <p>Mejor <strong>Póster</strong> presentado por <strong>profesores</strong> y <strong>otros interesados</strong></p>
                <a class="uk-button uk-button-primary"><span uk-icon="chevron-right"></span> Seleccionar</a>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
            <img class="uk-margin-bottom icon-poster" src="./img/presentacion-oral.png" alt="poster">
                <div class="categoria-container">
                    <p>Categoría:</p>
                </div>
                <p>Mejor <strong>Presentación Oral</strong> por <strong>profesores</strong> y <strong>otros interesados</strong></p>
                <a class="uk-button uk-button-primary"><span uk-icon="chevron-right"></span> Seleccionar</a>
            </div>
        </div>
    </div>
</div>


<div id="modal-identificador" class="uk-flex-top" uk-modal>
  <div class="uk-modal-dialog uk-modal-body">
    <h2 class="uk-modal-title">Votaciones</h2>
    <form id="form-identificador" onsubmit="">
      <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-text">Ingrese su identificador para votar</label>
        <div class="uk-form-controls">
          <input
            class="uk-input"
            id="inp-identificador"
            type="number"
            placeholder="Escriba su identificador"
            required
          />
        </div>
        <p class="uk-text-center" id="mensaje"></p>
      </div>

      <p class="uk-text-right">
        <button class="uk-button uk-button-default uk-modal-close" type="button">
          Cancelar
        </button>
        <button id="btn-descargar" class="uk-button uk-button-primary" style="background-color: #1ba333; color: white" type="submit">Aceptar</button>
      </p>
    </form>
  </div>
</div>










<?php  include_once('footer.php')  ?>
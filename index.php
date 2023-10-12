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
        <a class="uk-button uk-button-primary" href="https://portal.unag.edu.hn/v-simposio-de-alimentos/"><span uk-icon="user"></span> Ingrese su identificador</a>
    </div>

    <h2 class="uk-heading-line"><span>Votaciones | Categorías</span></h2><br>

    <div class="uk-grid-match uk-child-width-expand@s uk-text-center" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <img class="uk-margin-bottom icon-poster" src="./img/poster.png" alt="poster">
                <div class="categoria-container">
                    <p>Categoría:</p>
                </div>
                <p>Presentacion de Poster por <strong>Docentes</strong></p>
                <a class="uk-button uk-button-primary"><span uk-icon="chevron-right"></span> Seleccionar</a>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
            <img class="uk-margin-bottom icon-poster" src="./img/poster.png" alt="poster">
                <div class="categoria-container">
                    <p>Categoría:</p>
                </div>
                <p>Presentacion de Poster por <strong>Docentes</strong></p>
                <a class="uk-button uk-button-primary"><span uk-icon="chevron-right"></span> Seleccionar</a>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
            <img class="uk-margin-bottom icon-poster" src="./img/presentacion-oral.png" alt="poster">
                <div class="categoria-container">
                    <p>Categoría:</p>
                </div>
                <p>Presentacion de Poster por <strong>Docentes</strong></p>
                <a class="uk-button uk-button-primary"><span uk-icon="chevron-right"></span> Seleccionar</a>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
            <img class="uk-margin-bottom icon-poster" src="./img/presentacion-oral.png" alt="poster">
                <div class="categoria-container">
                    <p>Categoría:</p>
                </div>
                <p>Presentacion de Poster por <strong>Docentes</strong></p>
                <a class="uk-button uk-button-primary"><span uk-icon="chevron-right"></span> Seleccionar</a>
            </div>
        </div>
    </div>
</div>

<h2 class="uk-heading-line uk-text-center"><span>CERTIFICADOS</span></h2>

<div
  class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin-large-top"
  uk-grid
>
  <div class="uk-card-media-left uk-cover-container">
    <img
      src="https://portal.unag.edu.hn/wp-content/uploads/2023/09/SLIDE_DESCARGAR_CERTIFICADO.png"
      alt=""
      uk-cover
    />
    <canvas width="600" height="400"></canvas>
  </div>
  <div>
    <div class="uk-card-body">
      <h3 class="uk-card-title">
        CERTIFICADOS DE <strong>PARTICIPANTES</strong>
      </h3>
      <p>
        Una vez abierto el modal ingrese su identificador para poder descargar
        su certificado.
      </p>
      <button
        id="btn-modal"
        class="uk-button uk-button-primary"
        style="background-color: #1ba333; color: white"
        uk-toggle="target: #modal-identificador"
      >
        Descargar Certificado
      </button>
    </div>
  </div>
</div>

<div id="modal-identificador" class="uk-flex-top" uk-modal>
  <div class="uk-modal-dialog uk-modal-body">
    <h2 class="uk-modal-title">Descargar Certificado</h2>
    <form id="form-descarga" onsubmit="descargarCertificadoConValidacion(event)">
      <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-text">Ingrese su identificador</label>
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
        <button id="btn-descargar" class="uk-button uk-button-primary" style="background-color: #1ba333; color: white" type="submit">Descargar</button>
      </p>
    </form>
  </div>
</div>

<script>
  function validarCertificado(identificador) {
    // Realizar una solicitud HTTP GET para verificar si el certificado existe
    const url = "https://portal.unag.edu.hn/certificados-v-simposio-de-alimentos/CERTIFICADO_PARTICIPACION-" + identificador + ".pdf";

    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function() {
      if (xhr.status === 200) {
        descargarCertificado(identificador);
      } else {
        const mensaje = document.getElementById("mensaje");
        mensaje.textContent = "El certificado no existe para el identificador proporcionado.";
      }
    };

    xhr.send();
  }

  function descargarCertificado(identificador) {
    const modalIdentificador = document.getElementById("modal-identificador");
    const mensaje = document.getElementById("mensaje");
    const enlaceDescarga = document.createElement("a");

    enlaceDescarga.href = "https://portal.unag.edu.hn/certificados-v-simposio-de-alimentos/CERTIFICADO_PARTICIPACION-" + identificador + ".pdf";

    enlaceDescarga.download = "certificado_v_simposio_de_alimentos_" + identificador + ".pdf";

    mensaje.append('');
    enlaceDescarga.click();
    modalIdentificador.close();
  }

  function descargarCertificadoConValidacion(event) {
    event.preventDefault();
    const identificador = document.querySelector("#inp-identificador").value;
    const mensaje = document.getElementById("mensaje");

    if (identificador !== "") {
      validarCertificado(identificador);
    } else {
      mensaje.textContent = 'Por favor, ingrese su identificador.';
    }
  }
</script>









<?php  include_once('footer.php')  ?>
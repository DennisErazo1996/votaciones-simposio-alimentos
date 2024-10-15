window.onload = function(){
    $("#loading").fadeOut();
};


$(document).ready(function () {

    //borrarCookie('nombre'); borrarCookie('identificador'); borrarCookie('id');
    
    const identificadorCookie = getCookie('identificador');
    const nombreCookie = getCookie('nombre');
    


    if (identificadorCookie == "") {
        $('.btn-categoria').prop('disabled', true);
        $('#btn-ingrese-identificador').show();
    }else{
        $('#btn-ingrese-identificador').hide();
        $('#mostrar-participante').html("Participante: <strong>"+nombreCookie+"</strong>");
    }
    console.log(identificadorCookie)

    


    $('.uk-grid-match').on('click', 'button.btn-votar-trabajo', function(e) {
        const idCategoria = e.currentTarget.dataset.id_categoria;
        const idTrabajo = e.currentTarget.dataset.id_trabajo;
        const numero = e.currentTarget.dataset.numero;
        const idParticipanteCookie = getCookie('id');
        
        $.confirm({
            title: 'Confirmar Voto',
            content: '¿Seguro que quiere votar por el #'+numero,
            boxWidth: '400px',
            useBootstrap: false,
            buttons: {  
                confirmar: function () {
                    $.ajax({
                        type: 'GET',
                        url: './functions/registrar-voto.php?categoria='+idCategoria+'&participante='+idParticipanteCookie+'&idTrabajo='+idTrabajo,
                        success: function(response) {
                            $.alert({
                                title: 'Muchas gracias',
                                content: 'Su voto ha sido registrado',
                                boxWidth: '350px',
                                useBootstrap: false,
                                buttons: {
                                    ok: function (){
                                        window.location.href = './'
                                    }
                                }
                            });;
                        },
                        error: function(xhr, status, error) {
                            console.error('Error en la solicitud AJAX:', error);
                        }
                    });
                    
                },
                cancelar: function () {
                   
                }
            }
        });
              
    
    
    });
    
    
});



$('.btn-categoria').on('click', function(e) {
    const idCategoria = e.currentTarget.dataset.id_categoria;
    const idParticipanteCookie = getCookie('id');

    $.ajax({
        type: 'GET',
        url: './functions/validar-voto.php',
        data: {idCategoria: idCategoria, idParticipante: idParticipanteCookie},
        dataType: 'json',
        success: function(response) {

            if (response.idCategoria == null && response.idParticipante == null) {
                window.location.href = './votacion-categoria.php?categoria='+idCategoria+'&participante='+idParticipanteCookie;
            } else {
                $.alert({
                    title: 'Aviso',
                    content: 'Ya se ha registrado su voto en esta categoría, por favor, seleccione otra categoría',
                    boxWidth: '350px',
                    type: 'red',
                    useBootstrap: false,
                });;
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });

    //window.location.href = './votacion-categoria.php?categoria='+idCategoria+'&participante='+idParticipanteCookie;
});



$('#btn-identificador-aceptar').on('click', function () {
        
    const identificador = $('#ipt-identificador').val();
    const nombreParticipante = getCookie('nombre');
    
    
    if(identificador != ''){
        $.ajax({
            type: 'GET',
            url: './functions/validar-identificador.php',
            data: {identificador: identificador},
            dataType: 'json',
            success: function(response) {
                if (response.existe == 1) {
                    //alert('El identificador existe en la base de datos');
                    document.cookie = "identificador=" + identificador + "; expires=Tue, 17 Oct 2024 00:00:00 UTC; path=/;";
                    document.cookie = "nombre=" + response.nombre + "; expires=Tue, 17 Oct 2024 00:00:00 UTC; path=/;";
                    document.cookie = "id=" + response.id + "; expires=Tue, 17 Oct 2024 00:00:00 UTC; path=/;";
                    $('#modal-identificador').hide();
                    location.reload();
                    
                } else {
                    alert('El identificador de participante no existe.');
                    $('#ipt-identificador').val('');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
            }
        });
    }
    
});

function borrarCookie(nombre) {
    document.cookie = nombre + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}


function getCookie(name) {
    const value = "; " + document.cookie;
    const parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
    return "";
}


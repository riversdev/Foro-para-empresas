$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    // BIENVENIDA A LA SESION
    alertify.success("Todo está listo!");
    // CERRAR SESION
    $('#salir').on('click', function () {
        $.ajax({
            type: "POST",
            url: "ajax/welcomeAjax.php",
            data: {
                tipo: "salir"
            },
            error: function (data) {
                console.error(data);
            },
            success: function (data) {
                location.href = "welcome";
            }
        });
    });
});

function tabularTripticos() {
    $('#tablaTripticos').DataTable({
        scrollX: true,
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior"
            },
            aria: {
                SortAscending: ": Activar para ordenar la columna de manera ascendente",
                SortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
}

function dameElActive(item, items) {
    for (let i = 0; i < items.length; i++) {
        $('#item' + items[i]).removeClass("bg-warning");
        $('#item' + items[i]).removeClass("text-white");
    }
    $('#' + item).addClass("bg-warning");
    $('#' + item).addClass("text-white");
}

function prepararValidacionFormularios() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                event.preventDefault();
                if (form.id == "formEditarInformacion") {
                    guardarLogo(form.id, form[0].value);
                } else if (form.id == "formEditarTriptico") {
                    guardarTriptico(form.id);
                } else if (form.id == "formAgregarTriptico") {
                    guardarTriptico(form.id);
                } else if (form.id == "formAgregarVideo") {
                    guardarVideo(form.id);
                } else if (form.id == "formEditarVideo") {
                    guardarVideo(form.id);
                } else {
                    console.log("Formulario no encontrado");
                }
            }
            form.classList.add('was-validated');
        }, false);
    });
}

function confirmacionEliminarTriptico(idTriptico, nombreTriptico) {
    alertify
        .confirm('Eliminando triptico...', 'Está seguro de querer eliminar el triptico ' + nombreTriptico,
            function () {
                $.ajax({
                    type: "POST",
                    url: "ajax/empresasAjax.php",
                    data: {
                        tipoPeticion: "eliminarTriptico",
                        idTriptico
                    },
                    error: function (data) {
                        console.error(data);
                    },
                    success: function (data) {
                        let mensaje = data.split("|");
                        if (mensaje[0] == "success") {
                            appEmpresa.obtenerTripticos();
                            alertify.success(mensaje[1]);
                        } else if (mensaje[0] == "error") {
                            alertify.error(mensaje[1]);
                        } else {
                            console.log("Tipo de mensaje no definido");
                        }
                    }
                });
            },
            function () {
                alertify.error('Cancelado')
            }
        );
}

function guardarTriptico(form) {
    var formData = new FormData(document.getElementById(form));
    $.ajax({
        type: "POST",
        url: "ajax/empresasAjax.php",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (echo) {
        let mensaje = echo.split('|');
        if (mensaje[0] == "success") {
            document.getElementById(form).reset();
            $('#modalEditarTriptico').modal('hide');
            $('#modalAgregarTriptico').modal('hide');
            alertify.success(mensaje[1]);
            appEmpresa.obtenerTripticos();
        } else if (mensaje[0] == "error") {
            alertify.error(mensaje[1]);
        } else {
            console.log("No se definió el tipo de respuesta");
        }
    });
}

function guardarLogo(form, idEmpresa) {
    var formData = new FormData(document.getElementById(form));
    $.ajax({
        type: "POST",
        url: "ajax/empresasAjax.php",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (echo) {
        let mensaje = echo.split('|');
        if (mensaje[0] == "success") {
            if (mensaje[1] == "Logo actualizado!") {
                $('#contenedorLogoMenu').empty();
                $('#contenedorLogoMenu').append(mensaje[2]);
                $('#contenedorLogoPrincipal').empty();
                $('#contenedorLogoPrincipal').append(mensaje[2]);
            }
            appEmpresa.editarInformacion(idEmpresa);
        } else if (mensaje[0] == "error") {
            alertify.error(mensaje[1]);
        } else {
            console.log("No se definió el tipo de respuesta");
        }
    });
}

function guardarVideo(form) {
    var formData = new FormData(document.getElementById(form));
    $.ajax({
        type: "POST",
        url: "ajax/empresasAjax.php",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (echo) {
        let mensaje = echo.split('|');
        if (mensaje[0] == "success") {
            document.getElementById(form).reset();
            $('#modalEditarVideo').modal('hide');
            $('#modalAgregarVideo').modal('hide');
            alertify.success(mensaje[1]);
            appEmpresa.obtenerVideos();
        } else if (mensaje[0] == "error") {
            alertify.error(mensaje[1]);
        } else {
            console.log("No se definió el tipo de respuesta");
            console.log(echo);
        }
    });
}

function confirmacionEliminarVideo(idVideo, nombreVideo) {
    alertify
        .confirm('Eliminando video...', 'Está seguro de querer eliminar el video ' + nombreVideo,
            function () {
                $.ajax({
                    type: "POST",
                    url: "ajax/empresasAjax.php",
                    data: {
                        tipoPeticion: "eliminarVideo",
                        idVideo
                    },
                    error: function (data) {
                        console.error(data);
                    },
                    success: function (data) {
                        let mensaje = data.split("|");
                        if (mensaje[0] == "success") {
                            appEmpresa.obtenerVideos();
                            alertify.success(mensaje[1]);
                        } else if (mensaje[0] == "error") {
                            alertify.error(mensaje[1]);
                        } else {
                            console.log("Tipo de mensaje no definido");
                        }
                    }
                });
            },
            function () {
                alertify.error('Cancelado')
            }
        );
}

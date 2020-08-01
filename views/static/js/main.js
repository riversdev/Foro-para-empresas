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

    // EVENTOS BOTONES
    $("#btnEventEdit").on('click', function () {
        $('#fechaAcceso').removeAttr("disabled");
        $('#horaInicioAcceso').removeAttr("disabled");
        $('#horaFinAcceso').removeAttr("disabled");
        $('#descripcionAcceso').removeAttr("disabled");
        $("#btnEventCancel").removeClass("d-none");
        $("#btnEventEdit").addClass("d-none");
        $("#btnEventDelete").addClass("d-none");
        $("#btnEventAgendar").removeClass("d-none");
        $("#eventsModalTitle").html("EDITANDO ACCESO").removeClass("text-dark").addClass("text-info");
        $("#rowIssue").removeClass("d-none");
        $('#fechaAcceso').attr("min", fechaActual);
    });
    $("#btnEventCancel").on('click', function () {
        $('#fechaAcceso').attr("disabled", "true");
        $('#horaInicioAcceso').attr("disabled", "true");
        $('#horaFinAcceso').attr("disabled", "true");
        $('#descripcionAcceso').attr("disabled", "true");
        $("#btnEventCancel").addClass("d-none");
        $("#btnEventEdit").removeClass("d-none");
        $("#btnEventDelete").removeClass("d-none");
        $("#btnEventAgendar").addClass("d-none");
        $("#eventsModalTitle").html($('#eventForIssue').val()).removeClass("text-info").addClass("text-dark");
        $("#rowIssue").addClass("d-none");
    });
    $("#btnEventDelete").on('click', function () {
        $("#modalEvents").modal('hide');
        let id = this.parentElement.parentElement[0].value;
        let descripcion = this.parentElement.parentElement[4].value;
        alertify.confirm('Eliminando...', 'Seguro de que desea eliminar el acceso para ' + descripcion,
            function () {
                eliminarAcceso(id);
            },
            function () {
                alertify.error('Cancelado !')
            });
    });

    // CAMBIO DE HORA MINIMO EN INPUT TIME DE HORA DE INICIO
    $('#horaInicioAcceso').on('click', function () {
        insertarHoraInicial("horaInicioAcceso", "fechaAcceso");
    });

    // CAMBIO DE HORA MINIMO EN INPUT TIME DE HORA DE TERMINO
    $('#horaFinAcceso').on('click', function () {
        insertarHoraFinal("horaInicioAcceso", "horaFinAcceso");
    });

    $('#btnSlideCalendar').on('click', function () {
        document
            .getElementById("calendar")
            .scrollIntoView({ block: "start", behavior: "smooth" });
    });
});

function prepararValidacionFormularios() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
            if (form.id == "formAccesos") {
                insertarHoraInicial("horaInicioAcceso", "fechaAcceso");
                insertarHoraFinal("horaInicioAcceso", "horaFinAcceso");
            }
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
                } else if (form.id == "formAccesos") {
                    if ($('#idAcceso').val() == "") {
                        agendarAcceso();
                    } else {
                        actualizarAcceso();
                    }
                } else if (form.id == "formChatEmpresa") {
                    guardarMensaje($('#idEmpresaChatEmpresa').val(), "empresa");
                    $('#mensajeChatEmpresa').val('');
                }
                else {
                    console.log("Formulario no encontrado");
                }
            }
            form.classList.add('was-validated');
        }, false);
    });
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

function dameElActive(item, items) {
    for (let i = 0; i < items.length; i++) {
        $('#item' + items[i]).removeClass("bg-warning");
        $('#item' + items[i]).removeClass("text-white");
    }
    $('#' + item).addClass("bg-warning");
    $('#' + item).addClass("text-white");
}

function dameElActiveVideo(item, items) {
    for (let i = 0; i < items.length; i++) {
        $('#listaVideos' + items[i]).removeClass("bg-warning");
        $('#listaVideos' + items[i]).removeClass("text-white");
    }
    $('#' + item).addClass("bg-warning");
    $('#' + item).addClass("text-white");
}

function dameElActiveTriptico(item, items) {
    for (let i = 0; i < items.length; i++) {
        $('#listaTripticos' + items[i]).removeClass("bg-warning");
        $('#listaTripticos' + items[i]).removeClass("text-white");
    }
    $('#' + item).addClass("bg-warning");
    $('#' + item).addClass("text-white");
}

// ADMIN
function agendarAcceso() {
    $.ajax({
        type: "POST",
        url: "ajax/adminAjax.php",
        data: {
            tipoPeticion: "agendarAcceso",
            fechaAcceso: $('#fechaAcceso').val(),
            horaInicioAcceso: $('#horaInicioAcceso').val(),
            horaFinAcceso: $('#horaFinAcceso').val(),
            descripcionAcceso: $('#descripcionAcceso').val(),
        },
        error: function (data) {
            console.error(data);
        },
        success: function (data) {
            let respuesta = data.split('|');
            if (respuesta[0] == "success") {
                alertify.success(respuesta[1]);
                $("#calendar").fullCalendar('refetchEvents');
                $('#modalEvents').modal('hide');
            } else if (respuesta[0] == "error") {
                alertify.error(respuesta[1]);
            } else {
                console.error("Tipo de respuesta no definido:" + data);
            }
        }
    });
}

function actualizarAcceso() {
    $.ajax({
        type: "POST",
        url: "ajax/adminAjax.php",
        data: {
            tipoPeticion: "actualizarAcceso",
            idAcceso: $('#idAcceso').val(),
            tituloAcceso: $('#descripcionAcceso').val(),
            fechaAcceso: $('#fechaAcceso').val(),
            horaInicioAcceso: $('#horaInicioAcceso').val(),
            horaFinAcceso: $('#horaFinAcceso').val(),
        },
        error: function (data) {
            console.error(data);
        },
        success: function (data) {
            let respuesta = data.split('|');
            if (respuesta[0] == "success") {
                alertify.success(respuesta[1]);
                $("#calendar").fullCalendar('refetchEvents');
                $('#modalEvents').modal('hide');
            } else if (respuesta[0] == "error") {
                alertify.error(respuesta[1]);
            } else {
                console.error("Tipo de respuesta no definido:" + data);
            }
        }
    });
}

function eliminarAcceso(idAcceso) {
    $.ajax({
        type: "POST",
        url: "ajax/adminAjax.php",
        data: {
            tipoPeticion: "eliminarAcceso",
            idAcceso
        },
        error: function (data) {
            console.error(data);
        },
        success: function (data) {
            let respuesta = data.split('|');
            if (respuesta[0] == "success") {
                $("#calendar").fullCalendar('refetchEvents');
                alertify.success(respuesta[1]);
            } else if (respuesta[0] == "error") {
                alertify.error(respuesta[1]);
            } else {
                console.error("Tipo de respuesta no definido:" + data);
            }
        }
    });
}

function insertarHoraInicial(start, fecha) {
    // FECHA ACTUAL RECUPERADA CON JS
    let fechaActual = new Date();
    let anio = fechaActual.getFullYear();
    let mes = fechaActual.getMonth() + 1;
    let dia = fechaActual.getDate();
    mes < 10 ? mes = '0' + mes : mes = mes;
    dia < 10 ? dia = '0' + dia : dia = dia;
    let cadFechaActual = anio + '-' + mes + '-' + dia;

    // RECUPERACION DE FECHA SELECCIONADA
    let fechaSeleccionada = new Date($('#' + fecha).val());
    fechaSeleccionada.setDate(fechaSeleccionada.getDate() + 1);
    let anioFS = fechaSeleccionada.getFullYear();
    let mesFS = fechaSeleccionada.getMonth() + 1;
    let diaFS = fechaSeleccionada.getDate();
    mesFS < 10 ? mesFS = '0' + mesFS : mesFS = mesFS;
    diaFS < 10 ? diaFS = '0' + diaFS : diaFS = diaFS;
    let cadFechaSeleccionada = anioFS + '-' + mesFS + '-' + diaFS;

    // SI LA FECHA ACTUAL ES LA MISMA QUE LA SELECCIONADA SE ESTABLECE LA HORA ACTUAL COMO LA MINIMA
    if (cadFechaSeleccionada == cadFechaActual) {
        let horas = fechaActual.getHours();
        let minutos = fechaActual.getMinutes();
        horas < 10 ? horas = '0' + horas : horas = horas;
        minutos < 10 ? minutos = '0' + minutos : minutos = minutos;
        $('#' + start).attr("min", horas + ':' + minutos);
    } else {
        $('#' + start).attr("min", '08:00');
    }
}

function insertarHoraFinal(start, end) {
    let newTime = new Date('2000-01-01T' + $('#' + start).val());
    newTime.setMinutes(newTime.getMinutes() + 1);
    let horas = newTime.getHours();
    let minutos = newTime.getMinutes();
    horas < 10 ? horas = '0' + horas : horas = horas;
    minutos < 10 ? minutos = '0' + minutos : minutos = minutos;
    $('#' + end).attr("min", horas + ':' + minutos);
}


// CHAT
function guardarMensaje(idEmpresa, tipoAcceso) {
    let sujetoChat = '';
    let mensajeChat = '';

    if (tipoAcceso == "usuario") {
        sujetoChat = $('#sujetoChatUsuario').val();
        mensajeChat = $('#mensajeChatUsuario').val();
    } else if (tipoAcceso == "empresa") {
        sujetoChat = $('#sujetoChatEmpresa').val();
        mensajeChat = $('#mensajeChatEmpresa').val();
    }

    $.ajax({
        type: "POST",
        url: "ajax/chatAjax.php",
        data: {
            tipoPeticion: "guardarMensaje",
            tipoAcceso,
            idEmpresa,
            sujetoChat,
            mensajeChat
        },
        error: function (data) {
            console.error(data);
        },
        success: function (data) {
            //console.log("Guardado");
            document
                .getElementById("slideChat")
                .scrollIntoView({ block: "start", behavior: "smooth" });
        }
    });
}
<!-- Custom JS -->
<script src="views/static/js/main.js"></script>
<!-- VUE -->
<script src="views\static\js\vue\vue.js"></script>
<script src="views\static\js\vue\vuex.js"></script>
<script src="views\static\js\vue\vue-router.js"></script>
<!-- Components -->
<script src="views\components\navAdmin.js"></script>

<?php
session_start();

if (isset($_SESSION['admin_id'])) {
} else {
    header("Location: /Foro-para-empresas/welcome");
}

if (isset($_SESSION['admin_id'])) {
?>
    <div id="appAdmin">
        <navegacionadmin></navegacionadmin>
        <div class="container pt-3">
            <div class="row d-flex align-items-center justify-content-center" style="height: 85vh;">
                <div class="card bg-warning mb-3" style="max-width: 30rem;">
                    <div class="card-body text-white">
                        <h5 class="card-title text-center">Bienvenido administrador</h5>
                        <p class="card-text text-justify">
                            En esta vista podrás agendar los accesos permitidos a empresas y usuarios, deberás presionar algún dia para agendar un nuevo acceso y presionar sobre los mismos para vizualizar su información.
                            <br><br>
                            Notas:
                            <small class="card-text text-justify">
                                <p>
                                    <ul>
                                        <li>Utiliza la navegación superior izquierda para moverte entre semanas, meses y años</li>
                                        <li>Utiliza la navegación superior derecha para vizualizar los accesos en mes, semana y día.</li>
                                        <li>Utiliza la vista de agenda en la parte superior derecha para una vista de lista de los accesos de todo el mes</li>
                                    </ul>
                                </p>
                            </small>
                        </p>
                        <div class="row justify-content-center">
                            <button id="btnSlideCalendar" class="btn btn-warning d-flex align-items-center" type="button">
                                <span class="pr-2">Comenzar</span>
                                <i class="far fa-2x fa-arrow-alt-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex align-items-center justify-content-center">
                <div id="calendar" class="pt-3"></div>
            </div>
        </div>
    </div>

    <!-- MODAL DE EVENTOS -->
    <div class="modal fade" id="modalEvents" tabindex="-1" role="dialog" aria-labelledby="eventsModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bordeNormal" id="headerModal">
                    <h5 class="modal-title text-justify" id="eventsModalTitle">Agendar acceso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAccesos" class="needs-validation" novalidate>
                        <input type="hidden" id="idAcceso">
                        <div class="form-row">
                            <div class="col-md-8 offset-2 mb-3">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Fecha</div>
                                    </div>
                                    <input type="date" class="form-control" id="fechaAcceso" value="" required>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingresa la fecha de agenda.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-row">
                                    <div class="col-md-5 offset-1">
                                        <div class="input-group input-group-sm clockpicker" data-autoclose="true">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Inicio</div>
                                            </div>
                                            <input type="time" class="form-control" id="horaInicioAcceso" min="08:00" max="20:00" value="" required>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Ingresa una hora de inicio válida.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group input-group-sm clockpicker" data-autoclose="true">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Fin</div>
                                            </div>
                                            <input type="time" class="form-control" id="horaFinAcceso" min="08:00" max="20:00" value="" required>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Ingresa una hora de término válida.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3" id="rowIssue">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Descripción</div>
                                    </div>
                                    <textarea class="form-control" id="descripcionAcceso" placeholder="Ingresa una descripción para esta fecha de acceso..." cols="30" rows="3" required></textarea>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingresa una descripción para este acceso.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="eventForStatus">
                        <div id="btnsEvents" class="text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-sm btn-outline-warning" id="btnEventCancel">Cancelar</button>
                            <button type="button" class="btn btn-sm btn-outline-info" id="btnEventEdit">Editar</button>
                            <button type="button" class="btn btn-sm btn-outline-danger" id="btnEventDelete">Eliminar</button>
                            <button type="submit" class="btn btn-sm btn-outline-primary" id="btnEventAgendar">Agendar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // FECHA ACTUAL
        var f = new Date();
        let meses = f.getMonth() + 1;
        let dias = f.getDate();
        if (meses < 10) {
            meses = '0' + meses;
        }
        if (dias < 10) {
            dias = '0' + dias;
        }
        let fechaActual = f.getFullYear() + '-' + meses + "-" + dias;

        $(document).ready(function() {
            $('#calendar').fullCalendar({
                slotMinTime: '08:00',
                slotMaxTime: '20:00',
                editable: true,
                selectable: true,
                businessHours: true,
                dayMaxEvents: true,
                navLinks: true,
                nowIndicator: true,
                weekNumbers: true,
                eventLimit: true,
                header: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay,listMonth'
                },
                events: 'ajax/adminAjax.php',
                dayClick: function(date, jsEvent, view) {
                    $('#idAcceso').val("");
                    if (date.format() > fechaActual) {
                        $('#fechaAcceso').attr("min", fechaActual);
                        $('#horaInicioAcceso').attr("min", "08:00");
                        $('#horaFinAcceso').attr("min", "08:00");
                        $('#horaInicioAcceso').attr("max", "20:00");
                        $('#horaFinAcceso').attr("max", "20:00");
                        $("#eventsModalTitle").html("Agendar acceso").removeClass("text-info").addClass("text-dark");
                        $('#fechaAcceso').removeAttr("disabled");
                        $('#horaInicioAcceso').removeAttr("disabled");
                        $('#horaFinAcceso').removeAttr("disabled");
                        $('#descripcionAcceso').removeAttr("disabled");
                        $("#btnEventCancel").addClass("d-none");
                        $("#btnEventEdit").addClass("d-none");
                        $("#btnEventDelete").addClass("d-none");
                        $("#btnEventAgendar").removeClass("d-none");
                        document.getElementById("formAccesos").reset();
                        $('#fechaAcceso').val(date.format());
                        $('#horaInicioAcceso').val("00:00");
                        $('#horaFinAcceso').val("00:00");
                        $("#rowIssue").removeClass("d-none");
                        $('#modalEvents').modal();
                    } else if (date.format() == fechaActual) {
                        if (f.getHours() < 20 && f.getHours() >= 8) {
                            $('#fechaAcceso').attr("min", fechaActual);
                            insertarHoraInicial("horaInicioAcceso", "fechaAcceso");
                            $('#horaFinAcceso').attr("min", "08:00");
                            $("#eventsModalTitle").html("Agendar acceso").removeClass("text-info").addClass("text-dark");
                            $('#fechaAcceso').removeAttr("disabled");
                            $('#horaInicioAcceso').removeAttr("disabled");
                            $('#horaFinAcceso').removeAttr("disabled");
                            $('#descripcionAcceso').removeAttr("disabled");
                            $("#btnEventCancel").addClass("d-none");
                            $("#btnEventEdit").addClass("d-none");
                            $("#btnEventDelete").addClass("d-none");
                            $("#btnEventAgendar").removeClass("d-none");
                            document.getElementById("formAccesos").reset();
                            $('#fechaAcceso').val(date.format());
                            $('#horaInicioAcceso').val("00:00");
                            $('#horaFinAcceso').val("00:00");
                            $("#rowIssue").removeClass("d-none");
                            $('#modalEvents').modal();
                        } else {
                            alertify.error("Imposible agendar acceso");
                        }
                    } else {
                        alertify.error("Imposible agendar acceso");
                    }
                },
                eventClick: function(calEvent, jsEvent, view) {
                    $('#fechaAcceso').attr("min", fechaActual);
                    $("#eventsModalTitle").html(calEvent.title).removeClass("text-info").addClass("text-dark");
                    $('#idAcceso').val(calEvent.idAcceso);
                    $('#fechaAcceso').val(calEvent.fecha).attr("disabled", "true");
                    $('#horaInicioAcceso').val(calEvent.horaInicio).attr("disabled", "true");
                    $('#horaFinAcceso').val(calEvent.horaFin).attr("disabled", "true");
                    $('#descripcionAcceso').val(calEvent.title).attr("disabled", "true");
                    $("#btnEventCancel").addClass("d-none");
                    if (calEvent.fecha < fechaActual) {
                        $("#btnEventEdit").addClass("d-none");
                        $("#btnEventDelete").addClass("d-none");
                    } else {
                        $("#btnEventEdit").removeClass("d-none");
                        $("#btnEventDelete").removeClass("d-none");
                    }
                    $("#btnEventAgendar").addClass("d-none");
                    $("#rowIssue").addClass("d-none");
                    insertarHoraFinal("horaInicioAcceso", "horaFinAcceso");
                    $('#modalEvents').modal();
                },
                eventDrop: function(calEvent) {
                    if (calEvent.fecha < fechaActual) {
                        alertify.error("Imposible reagendar cita");
                        $("#calendar").fullCalendar('refetchEvents');
                    } else {
                        if (calEvent.start.format().split("T")[0] < fechaActual) {
                            alertify.error("Imposible reagendar cita");
                            $("#calendar").fullCalendar('refetchEvents');
                        } else {
                            $('#idAcceso').val(calEvent.idAcceso);
                            $('#fechaAcceso').val(calEvent.start.format().split("T")[0]);
                            $('#horaInicioAcceso').val(calEvent.start.format().split("T")[1]);
                            $('#horaFinAcceso').val(calEvent.end.format().split("T")[1]);
                            $('#descripcionAcceso').val(calEvent.title);
                            actualizarAcceso();
                        }
                    }
                },
            });
        });
    </script>

    <!-- VUEX CUSTOM INSTANCE -->
    <script src="views\static\js\vue\mainVuex.js"></script>
    <!-- VUE CUSTOM INSTANCE - USUARIOS -->
    <script src="views\static\js\vue\mainAdmin.js"></script>
<?php
}
?>
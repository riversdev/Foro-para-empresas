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
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="card border-warning border-top-0 border-bottom-0 border-right-0 rounded">
                    <div id="calendar" style="width: 100vh;"></div>
                </div>
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
                        <input type="hidden" id="eventForId">
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
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // themeSystem: 'bootstrap', // duplica los botones !!!
                locale: 'es',
                slotMinTime: '08:00',
                slotMaxTime: '20:00',
                editable: true,
                selectable: true,
                businessHours: true,
                dayMaxEvents: true,
                navLinks: true,
                nowIndicator: true,
                weekNumbers: true,
                headerToolbar: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                events: 'ajax/adminAjax.php'
            });
            calendar.on('dateClick', function(info) {
                console.log('clicked on ' + info.dateStr);
                console.log('todo el dia ?:' + info.allDay);
                $('#fechaAcceso').val(info.dateStr);
                $('#modalEvents').modal();
            });
            calendar.render();
        });
    </script>

    <!-- VUEX CUSTOM INSTANCE -->
    <script src="views\static\js\vue\mainVuex.js"></script>
    <!-- VUE CUSTOM INSTANCE - USUARIOS -->
    <script src="views\static\js\vue\mainAdmin.js"></script>
<?php
}
?>
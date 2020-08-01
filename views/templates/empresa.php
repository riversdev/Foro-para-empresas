<!-- Custom JS -->
<script src="views/static/js/main.js"></script>
<!-- VUE -->
<script src="views\static\js\vue\vue.js"></script>
<script src="views\static\js\vue\vuex.js"></script>
<script src="views\static\js\vue\vue-router.js"></script>
<!-- Components -->
<script src="views/components/navEmpresas.js"></script>
<script src="views/components/botonEditarContenido.js"></script>
<script src="views/components/vacio.js"></script>

<?php
session_start();

if (isset($_SESSION['empresa_id'])) {
} else {
    header("Location: /Foro-para-empresas/welcome");
}

require_once './models/conexion.php';

if (isset($_SESSION['empresa_id'])) {
    $stmt = Conexion::conectar()->prepare('SELECT id, nombre, correo, contrasenia, logo, productosServicios, mision, vision, fundador, CEO  FROM empresas WHERE id = :id');
    $stmt->bindParam(':id', $_SESSION['empresa_id']);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    $empresa = null;

    if (count($resultado) > 0) {
        $empresa = $resultado;
        $stmt = null;
    }

?>
    <script>
        function validarAcceso() {
            // FECHA ACTUAL RECUPERADA CON JS
            let fechaActual = new Date();
            let anio = fechaActual.getFullYear();
            let mes = fechaActual.getMonth() + 1;
            let dia = fechaActual.getDate();
            mes < 10 ? mes = '0' + mes : mes = mes;
            dia < 10 ? dia = '0' + dia : dia = dia;
            let cadFechaActual = anio + '-' + mes + '-' + dia;
            // HORA ACTUAL RECUPERADA CON JS
            let horas = fechaActual.getHours();
            let minutos = fechaActual.getMinutes();
            horas < 10 ? horas = '0' + horas : horas = horas;
            minutos < 10 ? minutos = '0' + minutos : minutos = minutos;
            let cadHoraActual = horas + ":" + minutos;
            $.ajax({
                type: "POST",
                url: "ajax/welcomeAjax.php",
                data: {
                    tipo: "validarAcceso",
                    cadFechaActual,
                    cadHoraActual
                },
                error: function(data) {
                    console.error(data);
                },
                success: function(data) {
                    let mensaje = data.split("|");
                    if (mensaje[0] == "error") {
                        $.ajax({
                            type: "POST",
                            url: "ajax/welcomeAjax.php",
                            data: {
                                tipo: "salir"
                            },
                            error: function(data) {
                                console.error(data);
                            },
                            success: function(data) {
                                location.href = "welcome";
                            }
                        });
                    } else if (mensaje[0] == "success") {
                        //console.log(mensaje[1]);
                    } else {
                        console.log("Tipo de mensaje no definido!");
                    }
                }
            });
        }
        setInterval(function() {
            validarAcceso();
        }, 60000);
    </script>
    <div id="appEmpresa">
        <navegacionempresas id="<?= $empresa['id']; ?>" user="<?= $empresa['nombre']; ?>" email="<?= $empresa['correo']; ?>" password="<?= $empresa['contrasenia']; ?>" logoinicial="data:image/jpeg;base64,<?= base64_encode($empresa['logo'])  ?>" tipo="2"></navegacionempresas>
        <p class="d-none">{{id=<?= $empresa['id']; ?>}}</p>
        <div class="align-items-center justify-content-center" style="overflow-x: hidden;">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                    <div v-if="productos === '', mision === '', vision === '', fundador === '', CEO === ''">
                        <div class="row mt-4 align-items-center justify-content-center" style="height: 65vh;overflow: hidden;">
                            <vacio cat="datos"></vacio>
                        </div>
                    </div>
                    <div v-else>
                        <div class="row px-5 pt-3">
                            <div class="col col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <div class="card bg-transparent mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                            <div class="card-body text-primary">
                                                <h6 class="card-title">Fundador</h6>
                                                <small>
                                                    <p class="card-text">{{fundador}}</p>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <div class="card bg-transparent mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                            <div class="card-body text-primary">
                                                <h6 class="card-title">CEO</h6>
                                                <small>
                                                    <p class="card-text">{{CEO}}</p>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <div class="card bg-transparent mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                            <div class="card-body text-primary">
                                                <h6 class="card-title">Contacto</h6>
                                                <small>
                                                    <p class="card-text">{{correo}}</p>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-4 col-sm-12 col-12">
                                <div class="card mb-3 bg-transparent border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                    <div class="card-body text-primary">
                                        <div>
                                            <h6 class="card-title">Productos o servicios</h6>
                                            <small class="card-text">
                                                <p class="text-justify">{{productos}}</p>
                                            </small>
                                        </div>
                                        <div class="bg-transparent text-center">
                                            <img src="./views/static/img/productos-servicios-naranja.png" style="height: 20vh;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-4 col-sm-12 col-12">
                                <div class="card bg-transparent mb-3 border-top-0 border-bottom-0 border-right-0 border-warning shadow-sm bg-white rounded">
                                    <div class="card-body text-primary">
                                        <div>
                                            <h6 class="card-title">Misión</h6>
                                            <small class="card-text">
                                                <p class="text-justify">{{mision}}</p>
                                            </small>
                                        </div>
                                        <div class="bg-transparent text-center">
                                            <img src="./views/static/img/mision.png" style="height: 20vh;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-4 col-sm-12 col-12">
                                <div class="card bg-transparent mb-3 border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                    <div class="card-body text-primary">
                                        <div>
                                            <h6 class="card-title">Visión</h6>
                                            <small class="card-text">
                                                <p class="text-justify">{{vision}}</p>
                                            </small>
                                        </div>
                                        <div class="bg-transparent text-center">
                                            <img src="./views/static/img/vision-naranja.png" style="height: 20vh;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-tripticos" role="tabpanel" aria-labelledby="nav-tripticos-tab">
                    <div v-if="tripticos === null">
                        <div class="row mt-4 align-items-center justify-content-center" style="height: 65vh;overflow: hidden;">
                            <vacio cat="tripticos"></vacio>
                        </div>
                    </div>
                    <div v-else>
                        <div class="row">
                            <div class="col col-12 col-lg-4">
                                <table id="tablaTripticos" class="table table-hover" style="width: 100%;">
                                    <thead class="bg-warning text-light">
                                        <tr>
                                            <th scope="col" class="text-left">Nombre</th>
                                            <th scope="col" class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="(triptico, index) in tripticos" class="shadow-sm rounded">
                                        <tr>
                                            <td><small>{{triptico.nombre}}</small></td>
                                            <td class="text-center d-flex justify-content-between">
                                                <button class="btn btn-sm btn-transparent" type="button" v-on:click="eliminarTriptico(triptico.id,triptico.nombre)">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                                <button class="btn btn-sm btn-transparent" type="button" data-toggle="modal" data-target="#modalEditarTriptico" v-on:click="idTriptico=triptico.id, nombreTriptico=triptico.nombre, descripcionTriptico=triptico.descripcion, imagenTriptico='data:image/jpeg;base64,'+triptico.imagen">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-transparent" type="button" v-on:click="imagenTriptico='data:image/jpeg;base64,'+triptico.imagen, tripticoDeInicio = false">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col col-12 col-lg-8">
                                <div class="row align-items-center justify-content-center" style="min-height: 80vh;">
                                    <div v-if="tripticoDeInicio === true">
                                        <div v-for="(triptico, index) in tripticos">
                                            <div v-if="index === 0" class="">
                                                <img v-bind:src="'data:image/jpeg;base64,'+triptico.imagen" class="d-block" style="height: 70vh;">
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <img v-bind:src="imagenTriptico" class="d-block" style="height: 70vh;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-videos" role="tabpanel" aria-labelledby="nav-videos-tab">
                    <div v-if="videos === null">
                        <div class="row mt-4 align-items-center justify-content-center" style="height: 65vh;overflow: hidden;">
                            <vacio cat="videos"></vacio>
                        </div>
                    </div>
                    <div v-else>
                        <div class="row">
                            <div class="col col-12 col-lg-4">
                                <table id="tablaVideos" class="table table-hover" style="width: 100%;">
                                    <thead class="bg-warning text-white">
                                        <tr>
                                            <th scope="col" class="text-left">Nombre</th>
                                            <th scope="col" class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="(video, index) in videos" class="shadow-sm rounded">
                                        <tr>
                                            <td scope="row"><small>{{video.nombre}}</small></td>
                                            <td class="text-center d-flex justify-content-between">
                                                <button class="btn btn-sm btn-transparent" type="button" v-on:click="eliminarVideo(video.id,video.nombre)">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                                <button class="btn btn-sm btn-transparent" type="button" data-toggle="modal" data-target="#modalEditarVideo" v-on:click="idVideo=video.id, nombreVideo=video.nombre, linkVideo=video.link">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-transparent" type="button" v-on:click="linkVideo=video.link, videoDeInicio = false">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col col-12 col-lg-8">
                                <div class="row align-items-center justify-content-center" style="min-height: 80vh;">
                                    <div v-if="videoDeInicio === true">
                                        <div v-for="(video, index) in videos">
                                            <div v-if="index === 0" class="">
                                                <iframe width="720" height="395" v-bind:src="video.link" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <iframe width="720" height="395" v-bind:src="linkVideo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-chat" role="tabpanel" aria-labelledby="nav-chat-tab">
                    <div class="row d-flex align-items-center justify-content-center pt-3">
                        <div class="card mb-3 bg-transparent border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded" style="width: 50rem;">
                            <div class="card-body">
                                <div style="height: 50vh; overflow-y: scroll;">
                                    <div id="chatContainer" class="pb-5" style="width: 100%;"></div>
                                </div>
                                <form id="formChatEmpresa" method="POST" class="needs-validation" novalidate>
                                    <input type="text" class="d-none" id="idEmpresaChatEmpresa" value="<?= $empresa['id']; ?>" required>
                                    <input type="text" class="d-none" id="sujetoChatEmpresa" value="<?= $empresa['nombre']; ?>" required>
                                    <div class="form-row">
                                        <div class="col-12 col-sm-8 col-md-9 col-lg-10">
                                            <textarea class="form-control form-control-sm" rows="2" id="mensajeChatEmpresa" placeholder="Escribe un mensaje" v-model="mensaje" required></textarea>
                                            <div class="invalid-feedback">
                                                Ingresa un mensaje.
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                                            <button type="submit" class="btn btn-outline-warning btn-block">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-muted">
                                Los mensajes se eliminarán al terminar el tiempo de acceso.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Triptico -->
        <div class="modal fade" id="modalEditarTriptico" tabindex="-1" role="dialog" aria-labelledby="labelEditarTriptico" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title text-white" id="labelEditarTriptico">{{nombreTriptico}}</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarTriptico" accept-charset="utf-8" method="POST" enctype="multipart/form-data" class="needs-validation p-2" novalidate>
                            <input type="text" class="d-none" name="txtIdTriptico" v-bind:value="idTriptico">
                            <input type="text" class="d-none" name="tipoPeticion" value="actualizarTriptico">
                            <div class="form-row">
                                <div class="col-md-8 mb-3">
                                    <label for="txtNombreTriptico">Nombre</label>
                                    <input type="text" class="form-control form-control-sm" name="txtNombreTriptico" id="txtNombreTriptico" v-model="nombreTriptico" required>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingresa un nombre.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 d-flex justify-content-end">
                                    <img id="imgT" v-bind:src="imagenTriptico" class="d-block" alt="Sin imagen" style="height: 15vh;">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="txtDescripcionTriptico">Descripción</label>
                                    <textarea class="form-control form-control-sm" name="txtDescripcionTriptico" id="txtDescripcionTriptico" rows="3" required>{{descripcionTriptico}}</textarea>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingresa una descripción.
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="txtImagenTriptico">Cambiar imagen</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" name="txtImagenTriptico" id="txtImagenTriptico">
                                        <label class="custom-file-label" for="txtImagenTriptico">Choose file...</label>
                                        <div class="valid-feedback">
                                            Correcto!
                                        </div>
                                        <div class="invalid-feedback">
                                            Elige una imagen.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row d-flex justify-content-end">
                                <button class="btn btn-warning" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Agregar Triptico -->
        <div class="modal fade" id="modalAgregarTriptico" tabindex="-1" role="dialog" aria-labelledby="labelAgregarTriptico" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-white" id="labelAgregarTriptico">Agregar triptico</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAgregarTriptico" accept-charset="utf-8" method="POST" enctype="multipart/form-data" class="needs-validation p-2" novalidate>
                            <input type="text" class="d-none" name="idEmpresa" v-bind:value="id">
                            <input type="text" class="d-none" name="tipoPeticion" value="agregarTriptico">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <input type="text" class="form-control form-control-sm" name="txtNombreTriptico" placeholder="Nombre" required>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingresa un nombre.
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <textarea class="form-control form-control-sm" name="txtDescripcionTriptico" rows="3" placeholder="Descripción" required></textarea>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingresa una descripción.
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" name="txtImagenTriptico" required accept="image/png, .jpeg, .jpg, image/gif">
                                        <label class="custom-file-label text-dark" for="txtImagenTriptico">Elegir imagen...</label>
                                        <div class="valid-feedback">
                                            Correcto!
                                        </div>
                                        <div class="invalid-feedback">
                                            Elige una imagen.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row d-flex justify-content-end">
                                <button class="btn btn-warning" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Agregar Video -->
        <div class="modal fade" id="modalAgregarVideo" tabindex="-1" role="dialog" aria-labelledby="labelAgregarVideo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-white" id="labelAgregarVideo">Agregar Video</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAgregarVideo" accept-charset="utf-8" method="POST" enctype="multipart/form-data" class="needs-validation p-2" novalidate>
                            <input type="text" class="d-none" name="idEmpresa" v-bind:value="id">
                            <input type="text" class="d-none" name="tipoPeticion" value="agregarVideo">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <input type="text" class="form-control form-control-sm" name="txtNombreVideo" placeholder="Nombre" required>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingresa un nombre.
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <input type="text" class="form-control form-control-sm" name="txtLinkVideo" placeholder="Link del video" required>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingresa el link de YouTube.
                                    </div>
                                </div>
                            </div>
                            <div class="form-row d-flex justify-content-end">
                                <button class="btn btn-warning" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Video -->
        <div class="modal fade" id="modalEditarVideo" tabindex="-1" role="dialog" aria-labelledby="labelEditarVideo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-white" id="labelEditarVideo">{{nombreVideo}}</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarVideo" accept-charset="utf-8" method="POST" enctype="multipart/form-data" class="needs-validation p-2" novalidate>
                            <input type="text" class="d-none" name="tipoPeticion" value="editarVideo">
                            <input type="text" class="d-none" name="txtIdVideo" v-bind:value="idVideo">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label class="text-dark">Nombre</label>
                                    <input type="text" class="form-control form-control-sm" name="txtNombreVideo" v-model="nombreVideo" required>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingresa un nombre.
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label class="text-dark">Link del video</label>
                                    <input type="text" class="form-control form-control-sm" name="txtLinkVideo" v-bind:value="linkVideo" required>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingresa una descripción.
                                    </div>
                                </div>
                            </div>
                            <div class="form-row d-flex justify-content-end">
                                <button class="btn btn-warning" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- VUEX CUSTOM INSTANCE -->
    <script src="views\static\js\vue\mainVuex.js"></script>
    <!-- VUE CUSTOM INSTANCE - EMPRESAS -->
    <script src="views\static\js\vue\mainEmpresa.js"></script>
<?php
}
?>
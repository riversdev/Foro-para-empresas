<!-- Custom JS -->
<script src="views/static/js/main.js"></script>
<!-- VUE -->
<script src="views\static\js\vue\vue.js"></script>
<script src="views\static\js\vue\vuex.js"></script>
<script src="views\static\js\vue\vue-router.js"></script>
<!-- Components -->
<script src="views/components/navUsuarios.js"></script>
<script src="views/components/vaciousuario.js"></script>
<script src="views/components/antesDeElegir.js"></script>

<?php
session_start();

if (isset($_SESSION['user_id'])) {
} else {
    header("Location: /Foro-para-empresas/welcome");
}

require_once './models/conexion.php';

if (isset($_SESSION['user_id'])) {
    $stmt = Conexion::conectar()->prepare('SELECT id, nombre, correo, contrasenia FROM usuarios WHERE id = :id');
    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    $usuario = null;

    if (count($resultado) > 0) {
        $usuario = $resultado;
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
    <div id="appUsuario" style="overflow-x: hidden;min-height:100vh;">
        <p class="d-none">{{nombreUsuario="<?= $usuario['nombre'] ?>"}}</p>
        <navegacionusuarios nombre="<?= $usuario['nombre'] ?>" correo="<?= $usuario['correo'] ?>"></navegacionusuarios>
        <div v-if="empresas === null">
            <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="card bg-danger text-white" style="max-width: 25rem;">
                    <div class="card-body text-white">
                        <h5 class="card-title text-center">Bienvenido</h5>
                        <p class="card-text text-justify">
                            No existen empresas registradas con las que puedas interactuar. Ponte en contacto con el administrador del sistema.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="row">
                <div class="col-12 col-sm-4 col-lg-3 bg-primary" style="min-height: 100vh;">
                    <div class="list-group py-3 pl-3">
                        <h4 class="text-center text-light py-2">Empresas</h4>
                        <div class="dropdown-divider"></div>
                        <div v-for="(empresa, index) in empresas">
                            <p class="d-none">{{items[index]=empresa.id}}</p>
                            <a v-on:click="dameElActive(empresa.id), idEmpresaU=empresa.id, empresaU=empresa.nombre, correoU=empresa.correo, logoU=empresa.logo, productosU=empresa.productosServicios, misionU=empresa.mision,visionU=empresa.vision, fundadorU=empresa.fundador, CEOU=empresa.CEO, tripticoSeleccionado='', videoSeleccionado='', getTripticos(empresa.id), getVideos(empresa.id), mensaje='', getChat(empresa.id)" class="list-group-item d-flex align-items-center bg-primary border border-primary text-white slide-Right">
                                <img v-bind:src="empresa.logo" style="height: 30px;" class="pr-3">
                                <h6 v-bind:id="'item' + empresa.id">{{empresa.nombre}}</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-8 col-lg-9">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                            <div v-if="idEmpresaU === ''">
                                <antesdeelegir></antesdeelegir>
                            </div>
                            <div v-else>
                                <div class="row d-flex justify-content-center align-items-center p-5" style="min-height: 90vh;">
                                    <div class="col col-12">
                                        <div class="row">
                                            <div class="col col-12">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="card bg-white mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                            <div class="card-body text-primary">
                                                                <h6 class="card-title">Fundador</h6>
                                                                <div class="dropdown-divider"></div>
                                                                <small>
                                                                    <p class="card-text">{{fundadorU}}</p>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="card bg-white mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                            <div class="card-body text-primary">
                                                                <h6 class="card-title">CEO</h6>
                                                                <div class="dropdown-divider"></div>
                                                                <small>
                                                                    <p class="card-text">{{CEOU}}</p>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="card bg-white mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                            <div class="card-body text-primary">
                                                                <h6 class="card-title">Contacto</h6>
                                                                <div class="dropdown-divider"></div>
                                                                <small>
                                                                    <p class="card-text">{{correoU}}</p>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-lg-4 col-sm-12 col-12">
                                                <div class="card mb-3 bg-white border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                    <div class="card-body text-primary">
                                                        <div>
                                                            <h6 class="card-title">Productos o servicios</h6>
                                                            <div class="dropdown-divider"></div>
                                                            <small class="card-text">
                                                                <p class="text-justify">{{productosU}}</p>
                                                            </small>
                                                        </div>
                                                        <div class="bg-transparent text-center">
                                                            <img src="./views/static/img/productos-servicios-naranja.png" style="height: 20vh;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-lg-4 col-sm-12 col-12">
                                                <div class="card bg-white mb-3 border-top-0 border-bottom-0 border-right-0 border-warning shadow-sm bg-white rounded">
                                                    <div class="card-body text-primary">
                                                        <div>
                                                            <h6 class="card-title">Misión</h6>
                                                            <div class="dropdown-divider"></div>
                                                            <small class="card-text">
                                                                <p class="text-justify">{{misionU}}</p>
                                                            </small>
                                                        </div>
                                                        <div class="bg-transparent text-center">
                                                            <img src="./views/static/img/mision.png" style="height: 20vh;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-lg-4 col-sm-12 col-12">
                                                <div class="card bg-white mb-3 border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                    <div class="card-body text-primary">
                                                        <div>
                                                            <h6 class="card-title">Visión</h6>
                                                            <div class="dropdown-divider"></div>
                                                            <small class="card-text">
                                                                <p class="text-justify">{{visionU}}</p>
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
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-tripticos" role="tabpanel" aria-labelledby="nav-tripticos-tab">
                            <div v-if="idEmpresaU === ''">
                                <antesdeelegir></antesdeelegir>
                            </div>
                            <div v-else>
                                <div v-if="tripticos === null">
                                    <vaciousuarios cat="tripticos"></vaciousuarios>
                                </div>
                                <div v-else>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-lg-9">
                                            <div v-if="tripticoSeleccionado === ''">
                                                <div v-for="(triptico, index) in tripticos">
                                                    <div v-if="index === 0">
                                                        <div class="row d-flex justify-content-center align-items-center px-5" style="min-height: 90vh;">
                                                            <div class="card bg-white mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                                <div class="card-body">
                                                                    <div class="row d-flex justify-content-center">
                                                                        <img v-bind:src="'data:image/jpeg;base64,' + triptico.imagen" style="height: 50vh; max-width: 100%;">
                                                                    </div>
                                                                    <h5 class="card-title text-justify pt-3">{{triptico.nombre}}</h5>
                                                                    <p class="card-text text-justify">{{triptico.descripcion}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div class="row d-flex justify-content-center align-items-center px-5" style="min-height: 90vh;">
                                                    <div class="card bg-white mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                        <div class="card-body">
                                                            <div class="row d-flex justify-content-center">
                                                                <img v-bind:src="'data:image/jpeg;base64,' + tripticoSeleccionado" style="height: 50vh; max-width: 100%;">
                                                            </div>
                                                            <h5 class="card-title text-justify pt-3">{{nombreTriptico}}</h5>
                                                            <p class="card-text text-justify">{{descripcionTriptico}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-lg-3 bg-primary" style="min-height: 100vh;opacity: .9;">
                                            <div class="list-group py-3 pr-1">
                                                <h5 class="text-center text-light py-2">Trípticos</h5>
                                                <div class="dropdown-divider"></div>
                                                <div v-for="(triptico, index) in tripticos">
                                                    <p class="d-none">{{listaTripticos[index]=triptico.id}}</p>
                                                    <a class="list-group-item d-flex align-items-center bg-primary border border-primary text-white slide-Right" v-on:click="tripticoSeleccionado=triptico.imagen, dameElActiveTriptico(triptico.id), nombreTriptico=triptico.nombre, descripcionTriptico=triptico.descripcion">
                                                        <p v-bind:id="'listaTripticos'+triptico.id" class="text-truncate">{{triptico.nombre}}</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-videos" role="tabpanel" aria-labelledby="nav-videos-tab">
                            <div v-if="idEmpresaU === ''">
                                <antesdeelegir></antesdeelegir>
                            </div>
                            <div v-else>
                                <div v-if="videos === null">
                                    <vaciousuarios cat="videos"></vaciousuarios>
                                </div>
                                <div v-else>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-lg-9">
                                            <div v-if="videoSeleccionado === ''">
                                                <div v-for="(video, index) in videos">
                                                    <div v-if="index === 0">
                                                        <div class="row d-flex justify-content-center align-items-center px-5" style="min-height: 90vh;">
                                                            <div class="card bg-white mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                                <div class="card-body">
                                                                    <div class="row d-flex justify-content-center">
                                                                        <iframe width="640" height="355" v-bind:src="video.link" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                    </div>
                                                                    <h5 class="card-title text-justify pt-3">{{video.nombre}}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div class="row d-flex justify-content-center align-items-center px-5" style="min-height: 90vh;">
                                                    <div class="card bg-white mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                        <div class="card-body">
                                                            <div class="row d-flex justify-content-center">
                                                                <iframe width="640" height="355" v-bind:src="videoSeleccionado" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                            </div>
                                                            <h5 class="card-title text-justify pt-3">{{nombreVideo}}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-lg-3 bg-primary" style="min-height: 100vh;opacity: .9;">
                                            <div class="list-group py-3 pr-1">
                                                <h5 class="text-center text-light py-2">Videos</h5>
                                                <div class="dropdown-divider"></div>
                                                <div v-for="(video, index) in videos">
                                                    <p class="d-none">{{listaVideos[index]=video.id}}</p>
                                                    <a class="list-group-item d-flex align-items-center bg-primary border border-primary text-white slide-Right" v-on:click="videoSeleccionado=video.link, dameElActiveVideo(video.id), nombreVideo=video.nombre">
                                                        <p v-bind:id="'listaVideos'+video.id" class="text-truncate">{{video.nombre}}</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-chat" role="tabpanel" aria-labelledby="nav-chat-tab">
                            <div v-if="idEmpresaU === ''">
                                <antesdeelegir></antesdeelegir>
                            </div>
                            <div v-else>
                                <div class="row d-flex justify-content-center align-items-center px-5" style="min-height: 90vh;">
                                    <div class="card mb-3 bg-white border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded" style="width: 50rem;">
                                        <div class="card-body">
                                            <div style="height: 50vh; overflow-y: scroll;">
                                                <div id="chatContainer" class="pb-5" style="width: 100%;"></div>
                                            </div>
                                            <p class="d-none">{{prepararValidacionForms()}}</p>
                                            <form id="formChatUsuario" method="POST" class="needs-validation" novalidate>
                                                <input type="text" class="d-none" id="idEmpresaChatUsuario" v-bind:value="idEmpresaU" required>
                                                <input type="text" class="d-none" id="sujetoChatUsuario" v-bind:value="nombreUsuario" required>
                                                <div class="form-row">
                                                    <div class="col-12 col-sm-8 col-md-9 col-lg-10">
                                                        <input type="text" class="form-control" id="mensajeChatUsuario" placeholder="Escribe un mensaje" v-model="mensaje" required>
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
                </div>
            </div>
        </div>
    </div>

    <!-- VUEX CUSTOM INSTANCE -->
    <script src="views\static\js\vue\mainVuex.js"></script>
    <!-- VUE CUSTOM INSTANCE - USUARIOS -->
    <script src="views\static\js\vue\mainUsuario.js"></script>
<?php
}
?>
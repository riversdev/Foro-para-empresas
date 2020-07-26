<!-- Custom JS -->
<script src="views/static/js/main.js"></script>
<!-- VUE -->
<script src="views\static\js\vue\vue.js"></script>
<script src="views\static\js\vue\vuex.js"></script>
<script src="views\static\js\vue\vue-router.js"></script>
<!-- Components -->
<script src="views/components/navUsuarios.js"></script>
<script src="views/components/vacio.js"></script>

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
    <div id="appUsuario" style="overflow-x: hidden;min-height:100vh;">
        <navegacionusuarios nombre="<?= $usuario['nombre'] ?>" correo="<?= $usuario['correo'] ?>"></navegacionusuarios>
        <div v-if="empresas === null">
            NO EXISTEN EMRESAS
        </div>
        <div v-else>
            <div class="row">
                <div class="col-12 col-sm-8 col-lg-9">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <div v-if="idEmpresaU === ''">
                                <div class="row px-5 pt-3 d-flex justify-content-center pt-5 mt-5">
                                    <div class="card mb-3 bg-warning text-white mt-5" style="max-width: 25rem;">
                                        <div class="card-body text-white">
                                            <h5 class="card-title text-center">Bienvenido</h5>
                                            <p class="card-text text-justify">
                                                Selecciona la empresa de tu interés en la lista a la derecha. Podrás vizualizar su información, tripticos y videos navegando entre las opciones de la parte superior. Tienes acceso a un chat con la empresa eligiendo la opción en la parte superior.
                                            </p>
                                        </div>
                                    </div>
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
                                                            <p class="card-text">{{fundadorU}}</p>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="card bg-transparent mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                    <div class="card-body text-primary">
                                                        <h6 class="card-title">CEO</h6>
                                                        <small>
                                                            <p class="card-text">{{CEOU}}</p>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="card bg-transparent mb-3 border border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                                    <div class="card-body text-primary">
                                                        <h6 class="card-title">Contacto</h6>
                                                        <small>
                                                            <p class="card-text">{{correoU}}</p>
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
                                        <div class="card bg-transparent mb-3 border-top-0 border-bottom-0 border-right-0 border-warning shadow-sm bg-white rounded">
                                            <div class="card-body text-primary">
                                                <div>
                                                    <h6 class="card-title">Misión</h6>
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
                                        <div class="card bg-transparent mb-3 border-warning border-top-0 border-bottom-0 border-right-0 shadow-sm bg-white rounded">
                                            <div class="card-body text-primary">
                                                <div>
                                                    <h6 class="card-title">Visión</h6>
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
                        <div class="tab-pane fade" id="tripticos" role="tabpanel" aria-labelledby="tripticos-tab">
                            <div v-if="idEmpresaU === ''">
                                <div class="row px-5 pt-3 d-flex justify-content-center pt-5 mt-5">
                                    <div class="card mb-3 bg-warning text-white mt-5" style="max-width: 25rem;">
                                        <div class="card-body text-white">
                                            <h5 class="card-title text-center">Bienvenido</h5>
                                            <p class="card-text text-justify">
                                                Selecciona la empresa de tu interés en la lista a la derecha. Podrás vizualizar su información, tripticos y videos navegando entre las opciones de la parte superior. Tienes acceso a un chat con la empresa eligiendo la opción en la parte superior.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="row pt-3">
                                    <div class="col-12 col-sm-12 col-lg-3">
                                        <div class="list-group list-group-flush">
                                            <div v-for="(triptico, index) in tripticos">
                                                <p class="d-none">{{listaTripticos[index]=triptico.id}}</p>
                                                <a v-bind:id="'listaTripticos'+triptico.id" class="list-group-item list-group-item-action d-flex justify-content-center align-items-center border-warning border-top-0 border-left-0 border-right-0 rounded" v-on:click="tripticoSeleccionado=triptico.imagen, dameElActiveTriptico(triptico.id)">{{triptico.nombre}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-lg-9">
                                        <div v-if="tripticoSeleccionado === ''">
                                            <div v-for="(triptico, index) in tripticos">
                                                <div v-if="index === 0">
                                                    <img v-bind:src="'data:image/jpeg;base64,' + triptico.imagen" class="d-block w-100" style="height: 70vh;">
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <img v-bind:src="'data:image/jpeg;base64,' + tripticoSeleccionado" class="d-block w-100" style="height: 70vh;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                            <div v-if="idEmpresaU === ''">
                                <div class="row px-5 pt-3 d-flex justify-content-center pt-5 mt-5">
                                    <div class="card mb-3 bg-warning text-white mt-5" style="max-width: 25rem;">
                                        <div class="card-body text-white">
                                            <h5 class="card-title text-center">Bienvenido</h5>
                                            <p class="card-text text-justify">
                                                Selecciona la empresa de tu interés en la lista a la derecha. Podrás vizualizar su información, tripticos y videos navegando entre las opciones de la parte superior. Tienes acceso a un chat con la empresa eligiendo la opción en la parte superior.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="row pt-3">
                                    <div class="col-12 col-sm-12 col-lg-3">
                                        <div class="list-group list-group-flush">
                                            <div v-for="(video, index) in videos">
                                                <p class="d-none">{{listaVideos[index]=video.id}}</p>
                                                <a v-bind:id="'listaVideos'+video.id" class="list-group-item list-group-item-action d-flex justify-content-center align-items-center border-warning border-top-0 border-left-0 border-right-0 rounded" v-on:click="videoSeleccionado=video.link, dameElActiveVideo(video.id)">{{video.nombre}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-lg-9 text-center pt-5">
                                        <div v-if="videoSeleccionado === ''">
                                            <div v-for="(video, index) in videos">
                                                <div v-if="index === 0">
                                                    <iframe width="720" height="395" v-bind:src="video.link" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <iframe width="720" height="395" v-bind:src="videoSeleccionado" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="chat-tab">.Chat..</div>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3 pt-5">
                    <div class="list-group list-group-flush">
                        <h5 class="text-center text-light py-2 shadow bg-primary rounded">Empresas</h5>
                        <div v-for="(empresa, index) in empresas">
                            <p class="d-none">{{items[index]=empresa.id}}</p>
                            <a v-bind:id="'item' + empresa.id" v-on:click="dameElActive(empresa.id), idEmpresaU=empresa.id, empresaU=empresa.nombre, correoU=empresa.correo, logoU=empresa.logo, productosU=empresa.productosServicios, misionU=empresa.mision,visionU=empresa.vision, fundadorU=empresa.fundador, CEOU=empresa.CEO, tripticoSeleccionado='', videoSeleccionado='', getTripticos(empresa.id), getVideos(empresa.id)" class="list-group-item list-group-item-action d-flex justify-content-center align-items-center border-warning border-top-0 border-left-0 border-right-0 rounded">
                                <h6>{{empresa.nombre}}</h6><img v-bind:src="empresa.logo" style="height: 30px;" class="pl-2">
                            </a>
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
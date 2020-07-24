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
    <div id="appUsuario" class="bg-primary" style="overflow-x: hidden;min-height:100vh;">
        <navegacionusuarios nombre="<?= $usuario['nombre'] ?>" correo="<?= $usuario['correo'] ?>"></navegacionusuarios>
        <div v-if="empresas === null">
            NO EXISTEN EMRESAS
        </div>
        <div v-else>
            <div class="row">
                <div class="col col-lg-9">
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
                                        <div class="card bg-transparent mb-3" style="border-style: dashed;border-color: grey; border-width: 2px;">
                                            <div class="card-body text-light">
                                                <div class="row">
                                                    <div class="col col-12 col-sm-6 col-lg-4">
                                                        <h6 class="card-title">Fundador</h6>
                                                        <small>
                                                            <p class="card-text">{{fundadorU}}</p>
                                                        </small>
                                                    </div>
                                                    <div class="col col-12 col-sm-6 col-lg-4">
                                                        <h6 class="card-title">CEO</h6>
                                                        <small>
                                                            <p class="card-text">{{CEOU}}</p>
                                                        </small>
                                                    </div>
                                                    <div class="col col-12 col-sm-12 col-lg 4">
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
                                        <div class="card mb-3 bg-transparent" style="border-style: dashed;border-color: grey; border-width: 2px;">
                                            <div class="card-body text-light">
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
                                        <div class="card bg-transparent mb-3" style="border-style: dashed;border-color: grey; border-width: 2px;">
                                            <div class="card-body text-light">
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
                                        <div class="card bg-transparent mb-3" style="border-style: dashed;border-color: grey; border-width: 2px;">
                                            <div class="card-body text-light">
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
                        <div class="tab-pane fade" id="tripticos" role="tabpanel" aria-labelledby="tripticos-tab">.tripticos..</div>
                        <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">..videos.</div>
                        <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="chat-tab">.Chat..</div>
                    </div>
                </div>
                <div class="col col-lg-3 pt-5">
                    <div class="list-group text-center border-warning" style="border-style: dashed;border-width: 2px;">
                        <h5 class="text-center text-warning pt-2">Empresas</h5>
                        <div v-for="(empresa, index) in empresas">
                            <p class="d-none">{{items[index]=empresa.id}}</p>
                            <a v-bind:id="'item' + empresa.id" v-on:click="dameElActive(empresa.id), idEmpresaU=empresa.id, empresaU=empresa.nombre, correoU=empresa.correo, logoU=empresa.logo, productosU=empresa.productosServicios, misionU=empresa.mision,visionU=empresa.vision, fundadorU=empresa.fundador, CEOU=empresa.CEO" class="list-group-item list-group-item-action bg-primary"><img v-bind:src="empresa.logo" style="height: 30px;"> {{empresa.nombre}}</a>
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
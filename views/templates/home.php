<!-- Custom JS -->
<script src="views/static/js/main.js"></script>
<!-- VUE -->
<script src="views\static\js\vue\vue.js"></script>
<script src="views\static\js\vue\vuex.js"></script>
<script src="views\static\js\vue\vue-router.js"></script>
<!-- Components -->
<script src="views/components/navigation.js"></script>
<script src="views/components/botonEditarContenido.js"></script>
<script src="views/components/vacio.js"></script>

<?php
session_start();

if (isset($_SESSION['user_id']) || isset($_SESSION['empresa_id'])) {
} else {
    header("Location: /Foro-para-empresas/welcome");
}

require_once './models/conexion.php';

// USUARIOS //////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_SESSION['user_id'])) {
    $records = Conexion::conectar()->prepare('SELECT id, nombre, correo, contrasenia FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
?>
    <div id="appUsuario">
        <navigation id="<?= $user['id']; ?>" user="<?= $user['nombre']; ?>" email="<?= $user['correo']; ?>" password="<?= $user['contrasenia']; ?>"></navigation>
        {{saludo}}
        <?php if (!empty($user)) : ?>
            <br> Welcome. <?= $user['correo'] ?>
            <br>You are Successfully Logged In
        <?php endif; ?>
    </div>

    <!-- VUE CUSTOM INSTANCE - USUARIOS -->
    <script src="views\static\js\vue\mainUsuario.js"></script>
<?php
}
?>




<?php
// EMPRESAS //////////////////////////////////////////////////////////////////////////////////////////////////
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

    $SQL = "SELECT * FROM tripticos WHERE idEmpresa = '" . $empresa['id'] . "';";
    $stmt = Conexion::conectar()->prepare($SQL);
    $stmt->execute();
    $tripticos = $stmt->fetchAll();
    $stmt = null;

    $SQL = "SELECT * FROM videos WHERE idEmpresa = '" . $empresa['id'] . "';";
    $stmt = Conexion::conectar()->prepare($SQL);
    $stmt->execute();
    $videos = $stmt->fetchAll();
    $stmt = null;

?>
    <div id="appEmpresa">
        <navigation id="<?= $empresa['id']; ?>" user="<?= $empresa['nombre']; ?>" email="<?= $empresa['correo']; ?>" password="<?= $empresa['contrasenia']; ?>" tipo="2"></navigation>
        <p class="d-none">{{id=<?= $empresa['id']; ?>}}</p>
        <div class="row align-items-center justify-content-center" style="height:92vh;">
            <div class="col col-6 text-right mt-1">
                <h2 class="text-black mt-2">
                    <span class="bg-primary text-primary">i</span>
                    {{empresa}}
                </h2>
            </div>
            <div id="contenedorLogo" class="col col-6 text-left mt-1">
                <img src="data:image/jpeg;base64,<?= base64_encode($empresa['logo'])  ?>" style="height: 50px;">
            </div>
            <div class="col-12 mt-3">
                <div class="container align-items-center justify-content-center" style="height: 80vh;">
                    <nav>
                        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">Información</a>
                            <a class="nav-item nav-link" id="nav-tripticos-tab" data-toggle="tab" href="#nav-tripticos" role="tab" aria-controls="nav-tripticos" aria-selected="false">Tripticos</a>
                            <a class="nav-item nav-link" id="nav-videos-tab" data-toggle="tab" href="#nav-videos" role="tab" aria-controls="nav-videos" aria-selected="false">Videos</a>
                            <a class="nav-item nav-link" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Chat</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                            <div v-if="productos === '', mision === '', vision === '', fundador === '', CEO === ''">
                                <div class="row mt-4 align-items-center justify-content-center" style="height: 65vh;overflow: hidden;">
                                    <vacio cat="datos"></vacio>
                                </div>
                            </div>
                            <div v-else>
                                <div class="row mt-4 align-items-center justify-content-center" style="height: 65vh;overflow: hidden;">
                                    <div class="col col-3">
                                        <div class="card border-primary mb-3" style="max-width: 18rem;">
                                            <div class="card-body text-primary">
                                                <h6 class="card-title">Productos o servicios</h6>
                                                <small class="card-text">
                                                    <p class="text-justify">{{productos}}</p>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-3">
                                        <div class="card border-primary mb-3" style="max-width: 18rem;">
                                            <div class="card-body text-primary">
                                                <h6 class="card-title">Misión</h6>
                                                <small class="card-text">
                                                    <p class="text-justify">{{mision}}</p>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-3">
                                        <div class="card border-primary mb-3" style="max-width: 18rem;">
                                            <div class="card-body text-primary">
                                                <h6 class="card-title">Visión</h6>
                                                <small class="card-text">
                                                    <p class="text-justify">{{vision}}</p>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-3">
                                        <div class="card border-primary mb-3" style="max-width: 18rem;">
                                            <div class="card-body text-primary">
                                                <h6 class="card-title">Fundador</h6>
                                                <p class="card-text">{{fundador}}</p>
                                                <h6 class="card-title">CEO</h6>
                                                <p class="card-text">{{CEO}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-tripticos" role="tabpanel" aria-labelledby="nav-tripticos-tab">
                            <div class="row mt-4 align-items-center justify-content-center" style="height: 65vh;overflow: hidden;">
                                <?php
                                if (count($tripticos) != 0) {
                                    if (count($tripticos) == 1) {
                                ?>
                                        <div id="carouselTripticosCaptions" class="carousel slide" data-ride="carousel" style="height: 65vh;">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselTripticosCaptions" data-slide-to="0" class="active"></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="17.jpg" class="d-block w-100" alt="..." style="height: 65vh;">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h5><?php echo $tripticos[0][2]; ?></h5>
                                                        <p><?php echo $tripticos[0][3]; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselTripticosCaptions" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselTripticosCaptions" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div id="carouselTripticosCaptions" class="carousel slide" data-ride="carousel" style="height: 65vh;">
                                            <ol class="carousel-indicators">
                                                <?php
                                                foreach ($tripticos as $key => $value) {
                                                    if ($key == 0) {
                                                ?>
                                                        <li data-target="#carouselTripticosCaptions" data-slide-to="0" class="active"></li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li data-target="#carouselTripticosCaptions" data-slide-to="<?php echo $key; ?>"></li>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <?php
                                                foreach ($tripticos as $key => $value) {
                                                    if ($key == 0) {
                                                ?>
                                                        <div class="carousel-item active">
                                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($value['triptico']); ?>" class="d-block w-100" alt="..." style="height: 65vh;">
                                                            <div class="carousel-caption d-none d-md-block">
                                                                <h5><?php echo $value['nombre']; ?></h5>
                                                                <p><?php echo $value['descripcion']; ?></p>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="carousel-item">
                                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($value['triptico']); ?>" class="d-block w-100" alt="..." style="height: 65vh;">
                                                            <div class="carousel-caption d-none d-md-block">
                                                                <h5><?php echo $value['nombre']; ?></h5>
                                                                <p><?php echo $value['descripcion']; ?></p>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselTripticosCaptions" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselTripticosCaptions" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <vacio cat="tripticos"></vacio>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-videos" role="tabpanel" aria-labelledby="nav-videos-tab">
                            <div class="row mt-4 align-items-center justify-content-center" style="height: 65vh;overflow: hidden;">
                                <?php
                                if (count($videos) != 0) {
                                ?>
                                    <div class="col col-3">
                                        <div class="row align-items-center justify-content-center" style="height: 65vh; overflow-y: scroll;">
                                            <ul class="list-group list-group-flush">
                                                <?php
                                                foreach ($videos as $row) {
                                                ?>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?php echo $row['nombre'] ?>
                                                        <button class="btn btn-small btn-transparent" v-on:click="video='<?php echo $row['video']; ?>', videoDeInicio = false">
                                                            <i class="far fa-play-circle"></i>
                                                        </button>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col col-9">
                                        <div class="row align-items-center justify-content-center">
                                            <div v-if="videoDeInicio === true">
                                                <iframe width="640" height="355" src="<?php echo $videos[0][3]; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                            <div v-else>
                                                <iframe width="640" height="355" v-bind:src="video" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <vacio cat="videos"></vacio>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-chat" role="tabpanel" aria-labelledby="nav-chat-tab">.Chat..</div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($empresa)) : ?>
            <br> Welcome. <?= $empresa['correo'] ?>
            <br>You are Successfully Logged In
        <?php endif; ?>
    </div>

    <!-- VUE CUSTOM INSTANCE - EMPRESAS -->
    <script src="views\static\js\vue\mainEmpresa.js"></script>
<?php
}
?>
<?php
session_start();

if (isset($_SESSION['user_id'])) {
} else {
    header("Location: /Foro-para-empresas/welcome");
}

require_once './models/conexion.php';

if (isset($_SESSION['user_id'])) {
    $records = Conexion::conectar()->prepare('SELECT id, user, email, password, type FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}
?>

<!-- Custom JS -->
<script src="views/static/js/main.js"></script>
<!-- VUE ALL -->
<script src="views\static\js\vue\vue.js"></script>
<script src="views\static\js\vue\vuex.js"></script>
<script src="views\static\js\vue\vue-router.js"></script>

<?php if (!empty($user)) : ?>
    <br> Welcome. <?= $user['email']; ?>
    <br>You are Successfully Logged In
    <a href="logout.php">
        Logout
    </a>
<?php else : ?>
    <h1>Nmmes que haces aqui xD</h1>

    <a href="login.php">Login</a> or
    <a href="signup.php">SignUp</a>
<?php endif; ?>

<button id="salir" class="btn btn-danger">SALIR</button>

<div id="app">
    {{saludo}}
</div>
<!-- Components -->

<!-- VUE CUSTOM INSTANCE -->
<script src="views\static\js\vue\main.js"></script>
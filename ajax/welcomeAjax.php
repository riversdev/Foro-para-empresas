<?php
require_once "../models/welcomeModel.php";

$peticion = $_POST['tipo'];

if ($peticion == "registro") {
    $nombre = $_POST['txtRegistroUsuario'];
    $contrasenia = $_POST['txtRegistroPassword'];
    $correo = $_POST['txtRegistroEmail'];
    $tipo = $_POST['txtRegistroSoyEmpresa'];
    if ($tipo == 3) {
        $resultado = Welcome::registrarUsuario($nombre, $correo, $contrasenia);
    }
    if ($tipo == 2) {
        $resultado = Welcome::registrarEmpresa($nombre, $correo, $contrasenia);
    }
    echo $resultado;
} elseif ($peticion == "identificacion") {
    $correo = $_POST['txtEmail'];
    $contrasenia = $_POST['txtPassword'];
    $tipo = $_POST['txtSoyEmpresa'];
    if ($tipo == 3) {
        Welcome::identificarUsuario($correo, $contrasenia, $_POST['cadFechaActual'], $_POST['cadHoraActual']);
    } elseif ($tipo == 2) {
        Welcome::identificarEmpresa($correo, $contrasenia, $_POST['cadFechaActual'], $_POST['cadHoraActual']);
    }
} elseif ($peticion == "validarAcceso") {
    Welcome::validarAcceso($_POST['cadFechaActual'], $_POST['cadHoraActual']);
} elseif ($peticion == "salir") {
    $resultado = Welcome::salir();
    echo $resultado;
}

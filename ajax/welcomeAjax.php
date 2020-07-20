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
} elseif ($peticion == "identificacion") {
    $correo = $_POST['txtEmail'];
    $contrasenia = $_POST['txtPassword'];
    $tipo = $_POST['txtSoyEmpresa'];
    if ($tipo == 3) {
        $resultado = Welcome::identificarUsuario($correo, $contrasenia);
    } elseif ($tipo == 2) {
        $resultado = Welcome::identificarEmpresa($correo, $contrasenia);
    }
} elseif ($peticion == "salir") {
    $resultado = Welcome::salir();
}

echo $resultado;

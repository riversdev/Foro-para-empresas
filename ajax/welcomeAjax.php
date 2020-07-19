<?php
require_once "../models/welcomeModel.php";

$tipo = $_POST['tipo'];

if ($tipo == "registro") {
    $nombre = $_POST['txtRegistroUsuario'];
    $contrasenia = $_POST['txtRegistroPassword'];
    $correo = $_POST['txtRegistroEmail'];
    $tipo = $_POST['txtRegistroSoyEmpresa'];
    $resultado = Welcome::registrarUsuario($nombre, $correo, $contrasenia, $tipo);
} elseif ($tipo == "identificacion") {
    $correo = $_POST['txtEmail'];
    $contrasenia = $_POST['txtPassword'];
    $resultado = Welcome::identificarUsuario($correo, $contrasenia);
} elseif ($tipo == "salir") {
    $resultado = Welcome::salir();
}

echo $resultado;

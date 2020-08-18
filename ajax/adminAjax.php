<?php
require_once "../models/ModeloAdmin.php";

$tipoPeticion = (isset($_POST['tipoPeticion'])) ? $_POST['tipoPeticion'] : 'leer';

if ($tipoPeticion == "leer") {
    ModeloAdmin::obtenerAccesos();
} elseif ($tipoPeticion == "agendarAcceso") {
    ModeloAdmin::agendarAcceso($_POST['descripcionAcceso'], $_POST['fechaAcceso'], $_POST['horaInicioAcceso'], $_POST['horaFinAcceso']);
} elseif ($tipoPeticion == "actualizarAcceso") {
    ModeloAdmin::actualizarAcceso($_POST['idAcceso'], $_POST['tituloAcceso'], $_POST['fechaAcceso'], $_POST['horaInicioAcceso'], $_POST['horaFinAcceso']);
} elseif ($tipoPeticion == "eliminarAcceso") {
    ModeloAdmin::eliminarAcceso($_POST['idAcceso']);
} elseif ($tipoPeticion == "vaciarChat") {
    ModeloAdmin::vaciarChat();
}

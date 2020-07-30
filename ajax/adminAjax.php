<?php
require_once "../models/ModeloAdmin.php";

$tipoPeticion = (isset($_POST['tipoPeticion'])) ? $_POST['tipoPeticion'] : 'leer';

if ($tipoPeticion == "leer") {
    ModeloAdmin::obtenerAccesos();
} elseif ($tipoPeticion == "agendarAcceso") {
    ModeloAdmin::agendarAcceso($_POST['descripcionAcceso'], $_POST['fechaAcceso'], $_POST['horaInicioAcceso'], $_POST['horaFinAcceso']);
}

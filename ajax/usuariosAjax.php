<?php
require_once "../models/ModeloUsuarios.php";

if ($_POST['tipoPeticion'] == "obtenerEmpresas") {
    $resultado = ModeloUsuarios::obtenerEmpresas();
    if (count($resultado) == 0) {
        echo 0;
    } else {
        echo "Hay empresas";
    }
}

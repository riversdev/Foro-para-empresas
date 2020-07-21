<?php
require_once "../models/empresasModel.php";

$tipoPeticion = $_POST['tipoPeticion'];

if ($tipoPeticion == "unico") {
    $resultado = empresasModel::buscarEmpresa($_POST['idEmpresa']);
    echo $resultado;
} elseif ($tipoPeticion == "guardar") {
    $resultado = empresasModel::agregarInformacionEmpresa($_POST['idEmpresa'], $_POST['empresa'], $_POST['productos'], $_POST['mision'], $_POST['vision'], $_POST['fundador'], $_POST['CEO']);
    echo $resultado;
}

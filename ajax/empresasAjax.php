<?php
require_once "../models/empresasModel.php";

$tipoPeticion = $_POST['tipoPeticion'];

if ($tipoPeticion == "unico") {
    $resultado = empresasModel::buscarEmpresa($_POST['idEmpresa']);
    echo $resultado;
}

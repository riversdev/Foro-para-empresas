<?php
require_once "../models/ModeloChat.php";

$tipoPeticion = $_POST['tipoPeticion'];
$tipoAcceso = $_POST['tipoAcceso'];

if ($tipoAcceso == "usuario") {
    if ($tipoPeticion == "leer") {
        $resultado = ModeloChat::obtenerMensajes($_POST['idEmpresa']);
        foreach ($resultado as $row) {
            echo '
            <div class="py-1 mx-2" style="border-bottom: 1px solid silver;">
                <span class="text-warning">' . $row['sujeto'] . '</span>
                <span style="color: #848484;">' . $row['mensaje'] . '</span>
                <span class="text-secondary" style="float: right;">' . date('g:i a', strtotime($row['fecha'])) . '</span>
            </div>
        ';
        }
    } elseif ($tipoPeticion == "guardarMensaje") {
        ModeloChat::guardarMensaje($_POST['idEmpresa'], $_POST['sujetoChat'], $_POST['mensajeChat']);
    }
} elseif ($tipoAcceso == "empresa") {
    if ($tipoPeticion == "leer") {
        $resultado = ModeloChat::obtenerMensajes($_POST['idEmpresa']);
        foreach ($resultado as $row) {
            echo '
            <div class="py-1 mx-2" style="border-bottom: 1px solid silver;">
                <span class="text-warning">' . $row['sujeto'] . '</span>
                <span style="color: #848484;">' . $row['mensaje'] . '</span>
                <span class="text-secondary" style="float: right;">' . date('g:i a', strtotime($row['fecha'])) . '</span>
            </div>
        ';
        }
    } elseif ($tipoPeticion == "guardarMensaje") {
        ModeloChat::guardarMensaje($_POST['idEmpresa'], $_POST['sujetoChat'], $_POST['mensajeChat']);
    }
}

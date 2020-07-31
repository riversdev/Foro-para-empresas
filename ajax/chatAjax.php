<?php
require_once "../models/ModeloChat.php";

$tipoPeticion = (isset($_GET['tipoPeticion'])) ? $_GET['tipoPeticion'] : 'leer';

if ($tipoPeticion == "leer") {
    $resultado = ModeloChat::obtenerMensajes();
    foreach ($resultado as $row) {
        echo '
            <div class="py-1 mx-2" style="border-bottom: 1px solid silver;width:110vh;">
                <span class="text-warning">' . $row['sujeto'] . '</span>
                <span style="color: #848484;">' . $row['mensaje'] . '</span>
                <span class="text-secondary" style="float: right;">' . date('g:i a', strtotime($row['fecha'])) . '</span>
            </div>
        ';
    }
}

if (isset($_POST['tipoPeticion']) && $_POST['tipoPeticion'] == "guardarMensaje") {
    ModeloChat::guardarMensaje($_POST['sujetoChat'], $_POST['mensajeChat']);
}

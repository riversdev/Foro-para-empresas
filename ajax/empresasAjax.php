<?php

require_once "../models/empresasModel.php";

$tipoPeticion = $_POST['tipoPeticion'];

if ($tipoPeticion == "unico") {
    $resultado = empresasModel::buscarEmpresa($_POST['idEmpresa']);
    echo $resultado;
} elseif ($tipoPeticion == "guardar") {
    $resultado = empresasModel::agregarInformacionEmpresa($_POST['idEmpresa'], $_POST['empresa'], $_POST['productos'], $_POST['mision'], $_POST['vision'], $_POST['fundador'], $_POST['CEO']);
    echo $resultado;
} elseif ($tipoPeticion == "guardarLogo") {
    if ($_FILES['imagen']['error'] === 4) {
        die("success|Vacio");
    } elseif ($_FILES['imagen']['error'] === 1) {
        die("error|El logo sobrepasa el limite de tamaño (2MB)");
    } elseif ($_FILES['imagen']['error'] === 0) {
        $imagenBinaria = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $nombreArchivo = $_FILES['imagen']['name'];
        $extensiones = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
        $extension = explode('.', $nombreArchivo);
        $extension = end($extension);
        $extension = strtolower($extension);
        if (!in_array($extension, $extensiones)) {
            die('error|Sólo elija logos con extensiones: ' . implode(', ', $extensiones));
        } else {
            empresasModel::guardarLogo($_POST['idEmpresa'], $imagenBinaria);
            $logo = empresasModel::leerLogoEmpresa($_POST['idEmpresa']);
            echo '|<img src="data:image/jpeg;base64,' . base64_encode($logo[0][0])  . '" style="height: 50px;" data-toggle="tooltip" data-placement="right" title="Cambiar logo">';
        }
    } else {
        die("error|Verifique sus datos");
    }
}

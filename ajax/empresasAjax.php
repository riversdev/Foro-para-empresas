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
            echo '|<img src="data:image/jpeg;base64,' . base64_encode($logo[0][0])  . '" style="height: 50px;">';
        }
    } else {
        die("error|Verifique sus datos");
    }
} elseif ($tipoPeticion == "obtenerTripticos") {
    $resultado = empresasModel::obtenerTripticos($_POST['idEmpresa']);
    if (count($resultado) == 0) {
        echo 0;
    } else {
        $tripticos = array();
        foreach ($resultado as $key => $row) {
            $triptico = new stdClass();
            $triptico->id = $row['id'];
            $triptico->idEmpresa = $row['idEmpresa'];
            $triptico->nombre = $row['nombre'];
            $triptico->descripcion = $row['descripcion'];
            $triptico->triptico = base64_encode($row['triptico']);
            $tripticos[$key] = $triptico;
        }
        echo json_encode($tripticos);
    }
} elseif ($tipoPeticion == "actualizarTriptico") {
    if ($_FILES['txtImagenTriptico']['error'] === 1) {
        die("error|La imagen sobrepasa el limite de tamaño (2MB)");
    } elseif ($_FILES['txtImagenTriptico']['error'] === 4) {
        empresasModel::actualizarTripticoSinImagen($_POST['txtIdTriptico'], $_POST['txtNombreTriptico'], $_POST['txtDescripcionTriptico']);
    } elseif ($_FILES['txtImagenTriptico']['error'] === 0) {
        $imagenBinaria = addslashes(file_get_contents($_FILES['txtImagenTriptico']['tmp_name']));
        $nombreArchivo = $_FILES['txtImagenTriptico']['name'];
        $extensiones = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
        $extension = explode('.', $nombreArchivo);
        $extension = end($extension);
        $extension = strtolower($extension);
        if (!in_array($extension, $extensiones)) {
            die('error|Sólo elija imagenes con extensiones: ' . implode(', ', $extensiones));
        } else {
            empresasModel::actualizarTriptico($_POST['txtIdTriptico'], $_POST['txtNombreTriptico'], $_POST['txtDescripcionTriptico'], $imagenBinaria);
        }
    } else {
        die("error|Verifique sus datos");
    }
} elseif ($tipoPeticion == "eliminarTriptico") {
    empresasModel::eliminarTriptico($_POST['idTriptico']);
}

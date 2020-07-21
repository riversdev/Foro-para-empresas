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
    echo "AQUI YA";
    if ($_FILES['imagen']['error'] === 4) {
        die("Sin imagen");
    } elseif ($_FILES['imagen']['error'] === 0) {
        $imagenBinaria = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $nombreArchivo = $_FILES['imagen']['name'];
        $extensiones = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
        $extension = explode('.', $nombreArchivo);
        $extension = end($extension);
        $extension = strtolower($extension);
        if (!in_array($extension, $extensiones)) {
            echo "no ext";
            die('Sólo se permiten archivos con las siguientes extensiones: ' . implode(', ', $extensiones));
        } else {
            $tamañoArchivo = $_FILES['imagen']['size'];
            echo $tamañoArchivo;
            $tamañoArchivoKB = round(intval(strval($tamañoArchivo / 1024)));
            $tamañoMaximoKB = "2048";
            $tamañoMaximoBytes = $tamañoMaximoKB * 1024;
            if ($tamañoArchivo > $tamañoMaximoBytes) {
                echo "Grande";
                die("El archivo " . $nombreArchivo . " es demasiado grande. El tamaño máximo del archivo es de " . $tamañoMaximoKB . "Kb.");
            } else {
                empresasModel::guardarLogo($_POST['idEmpresa'], $imagenBinaria);
            }
        }
    }
}

<?php
require_once "../models/ModeloUsuarios.php";

if ($_POST['tipoPeticion'] == "obtenerEmpresas") {
    $resultado = ModeloUsuarios::obtenerEmpresas();
    if (count($resultado) == 0) {
        echo 0;
    } else {
        $empresas = array();
        foreach ($resultado as $key => $value) {
            $empresa = new stdClass();
            $empresa->id = $value['id'];
            $empresa->nombre = $value['nombre'];
            $empresa->correo = $value['correo'];
            $empresa->logo = base64_encode($value['logo']);
            $empresa->productosServicios = $value['productosServicios'];
            $empresa->mision = $value['mision'];
            $empresa->vision = $value['vision'];
            $empresa->fundador = $value['fundador'];
            $empresa->CEO = $value['CEO'];
            $empresas[$key] = $empresa;
        }
        echo json_encode($empresas);
    }
}

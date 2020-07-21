<?php

require_once "conexion.php";

class empresasModel
{
    public static function buscarEmpresa($idEmpresa)
    {
        $SQL = "SELECT nombre, productosServicios, mision, vision, fundador, CEO FROM empresas WHERE id = '$idEmpresa'";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        $stmt = null;
        return json_encode($resultado);
    }
    public static function listarEmpresas()
    {
        $SQL = "";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
}

<?php
require_once "conexion.php";

class ModeloUsuarios
{
    public static function obtenerEmpresas()
    {
        $SQL = "SELECT * FROM empresas";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        $stmt = null;
        return $resultado;
    }
}

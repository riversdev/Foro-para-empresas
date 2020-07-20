<?php

require_once "./conexion.php";

class empresasModel
{
    public static function listarEmpresas()
    {
        $SQL = "";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
}

<?php
require_once "conexion.php";

class ModeloChat
{
    public static function obtenerMensajes($idEmpresa)
    {
        $SQL = "SELECT * FROM chat WHERE idEmpresa='$idEmpresa' ORDER BY id ASC";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        $stmt = null;
        return $resultado;
    }
    public static function guardarMensaje($idEmpresa, $sujeto, $mensaje)
    {
        $SQL = "INSERT INTO chat (idEmpresa,sujeto,mensaje) VALUES ('$idEmpresa','$sujeto','$mensaje');";
        $stmt = Conexion::conectar()->prepare($SQL);
        if ($stmt->execute()) {
            echo "success|Mensaje guardado!";
        } else {
            echo "error|Imposible guardar mensaje!";
        }
    }
}

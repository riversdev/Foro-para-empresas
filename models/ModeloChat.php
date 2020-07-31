<?php
require_once "conexion.php";

class ModeloChat
{
    public static function obtenerMensajes()
    {
        $SQL = "SELECT * FROM chat ORDER BY id ASC";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        $stmt = null;
        return $resultado;
    }
    public static function guardarMensaje($sujeto, $mensaje)
    {
        $SQL = "INSERT INTO chat (sujeto,mensaje) VALUES ('$sujeto','$mensaje');";
        $stmt = Conexion::conectar()->prepare($SQL);
        if ($stmt->execute()) {
            echo "success|Mensaje guardado!";
        } else {
            echo "error|Imposible guardar mensaje!";
        }
    }
}

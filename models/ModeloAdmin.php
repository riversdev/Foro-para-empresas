<?php
require_once "conexion.php";

class ModeloAdmin
{
    public static function agendarAcceso($titulo, $fecha, $horaInicio, $horaFin)
    {
        $start = $fecha . ' ' . $horaInicio;
        $end = $fecha . ' ' . $horaFin;
        $SQL = "INSERT INTO accesos (tittle,start,end,fecha,horaInicio,horaFin) VALUES ('$titulo','$start','$end','$fecha','$horaInicio','$horaFin');";
        $stmt = Conexion::conectar()->prepare($SQL);
        if ($stmt->execute()) {
            echo 'success|Acceso guardado !';
        } else {
            echo 'error|Imposible guardar acceso !';
        }
        $stmt = null;
    }
    public static function obtenerAccesos()
    {
        $SQL = "SELECT * FROM accesos";
        # MOSTRANDO ACCESOS
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
    }
}

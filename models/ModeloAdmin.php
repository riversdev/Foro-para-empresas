<?php
require_once "conexion.php";

class ModeloAdmin
{
    public static function agendarAcceso($titulo, $fecha, $horaInicio, $horaFin)
    {
        $start = $fecha . ' ' . $horaInicio;
        $end = $fecha . ' ' . $horaFin;
        $SQL = "INSERT INTO accesos (title,start,end,fecha,horaInicio,horaFin) VALUES ('$titulo','$start','$end','$fecha','$horaInicio','$horaFin');";
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
    public static function actualizarAcceso($idAcceso, $titulo, $fecha, $horaInicio, $horaFin)
    {
        $start = $fecha . ' ' . $horaInicio;
        $end = $fecha . ' ' . $horaFin;
        $SQL = "UPDATE accesos
                SET title='$titulo',
                    start='$start',
                    end='$end',
                    fecha='$fecha',
                    horaInicio='$horaInicio',
                    horaFin='$horaFin'
                WHERE idAcceso='$idAcceso';";
        $stmt = Conexion::conectar()->prepare($SQL);
        if ($stmt->execute()) {
            echo 'success|Acceso actualizado !';
        } else {
            echo 'error|Imposible actualizar acceso !';
        }
        $stmt = null;
    }
    public static function eliminarAcceso($idAcceso)
    {
        $SQL = "DELETE FROM accesos WHERE idAcceso='$idAcceso'";
        $stmt = Conexion::conectar()->prepare($SQL);
        if ($stmt->execute()) {
            echo "success|Acceso eliminado!";
        } else {
            echo "error|Imposible eliminar acceso!";
        }
        $stmt = null;
    }
    public static function vaciarChat()
    {
        $SQL = "TRUNCATE chat;";
        $stmt = Conexion::conectar()->prepare($SQL);
        if ($stmt->execute()) {
            echo "success|Chat vacío!";
        } else {
            echo "error|Imposible vaciar chat!";
        }
        $stmt = null;
    }
}

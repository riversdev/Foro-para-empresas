<?php
error_reporting(0);

require_once "conexion.php";

class empresasModel
{
    public static function obtenerTripticos($idEmpresa)
    {
        $SQL = "SELECT * FROM tripticos WHERE idEmpresa='$idEmpresa';";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        $stmt = null;
        return $resultado;
    }
    public static function leerLogoEmpresa($idEmpresa)
    {
        $stmt = Conexion::conectar()->prepare('SELECT logo FROM empresas WHERE id = :id');
        $stmt->bindParam(':id', $idEmpresa);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        $stmt = null;
        return $resultado;
    }
    public static function buscarEmpresa($idEmpresa)
    {
        $SQL = "SELECT nombre, correo, contrasenia, productosServicios, mision, vision, fundador, CEO FROM empresas WHERE id = '$idEmpresa'";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        $stmt = null;
        return json_encode($resultado);
    }
    public static function agregarInformacionEmpresa($idEmpresa, $empresa, $productosServicios, $mision, $vision, $fundador, $CEO)
    {
        $SQL = "UPDATE empresas
                SET nombre='$empresa',
                    productosServicios='$productosServicios',
                    mision='$mision',
                    vision='$vision',
                    fundador='$fundador',
                    CEO='$CEO'
                WHERE id = $idEmpresa";
        $stmt = Conexion::conectar()->prepare($SQL);
        if ($stmt->execute()) {
            return "Información guardada!";
        } else {
            return "Peticion agregar fallida!";
        }
        $stmt = null;
    }
    public static function guardarLogo($idEmpresa, $logo)
    {
        $SQL = "UPDATE empresas
                SET logo='$logo'
                WHERE id = '$idEmpresa'";
        $stmt = Conexion::conectar()->prepare($SQL);
        try {
            if ($stmt->execute()) {
                echo "success|Logo actualizado!";
            } else {
                echo "error|Peticion guardar logo fallida!";
            }
        } catch (Exception $e) {
            echo "error|Logo demasiado grande";
        }
        $stmt = null;
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

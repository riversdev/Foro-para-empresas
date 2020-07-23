<?php
error_reporting(0);

require_once "conexion.php";

class ModeloEmpresas
{
    public static function agregarVideo($idEmpresa, $nombre, $link)
    {
        $SQL = "INSERT INTO videos (nombre,idEmpresa,video) VALUES ('$nombre','$idEmpresa','$link');";
        $stmt = Conexion::conectar()->prepare($SQL);
        if ($stmt->execute()) {
            echo "success|Video agregado!";
        } else {
            echo "error|Imposible agregar video!";
        }
    }
    public static function agregarTriptico($idEmpresa, $nombre, $descripcion, $imagen)
    {
        $SQL = "INSERT INTO tripticos (idEmpresa,nombre,descripcion,triptico) VALUES ('$idEmpresa','$nombre','$descripcion','$imagen');";
        $stmt = Conexion::conectar()->prepare($SQL);
        try {
            if ($stmt->execute()) {
                echo "success|Triptico agregado!";
            } else {
                echo "error|Imposible agregar triptico!";
            }
        } catch (Exception $e) {
            echo "error|Imagen demasiado grande";
        }
    }
    public static function eliminarTriptico($idTriptico)
    {
        $SQL = "DELETE FROM tripticos WHERE id='$idTriptico'";
        $stmt = Conexion::conectar()->prepare($SQL);
        if ($stmt->execute()) {
            echo "success|Triptico eliminado!";
        } else {
            echo "error|Imposible eliminar triptico!";
        }
        $stmt = null;
    }
    public static function actualizarTripticoSinImagen($idTriptico, $nombre, $descripcion)
    {
        $SQL = "UPDATE tripticos
                SET nombre='$nombre',
                    descripcion='$descripcion'
                WHERE id = '$idTriptico'";
        $stmt = Conexion::conectar()->prepare($SQL);
        if ($stmt->execute()) {
            echo "success|Triptico actualizado!";
        } else {
            echo "error|Peticion guardar triptico fallida!";
        }
        $stmt = null;
    }
    public static function actualizarTriptico($idTriptico, $nombre, $descripcion, $imagen)
    {
        $SQL = "UPDATE tripticos
                SET nombre='$nombre',
                    descripcion='$descripcion',
                    triptico='$imagen'
                WHERE id = '$idTriptico'";
        $stmt = Conexion::conectar()->prepare($SQL);
        try {
            if ($stmt->execute()) {
                echo "success|Triptico actualizado!";
            } else {
                echo "error|Peticion guardar triptico fallida!";
            }
        } catch (Exception $e) {
            echo "error|Imagen demasiado grande";
        }
        $stmt = null;
    }
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
}

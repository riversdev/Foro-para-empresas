<?php
session_start();

require_once "conexion.php";

class Welcome
{
    public static function registrarEmpresa($nombre, $email, $contrasenia)
    {
        $nombre = strtoupper($nombre);
        $SQL = "SELECT * FROM empresas WHERE correo = '$email';";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        if (count($stmt->fetchAll()) == 0) {
            $stmt = null;
            $contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT);
            $SQL = "INSERT INTO empresas (nombre,correo,contrasenia) VALUES ('$nombre','$email','$contrasenia');";
            $stmt = Conexion::conectar()->prepare($SQL);
            if ($stmt->execute()) {
                return "Empresa registrada!";
            } else {
                return "Peticion registrar fallida!";
            }
            $stmt = null;
        } else {
            return "El mail de empresa ya existe!";
            $stmt = null;
        }
    }

    public static function registrarUsuario($nombre, $email, $contrasenia)
    {
        $SQL = "SELECT * FROM usuarios WHERE correo = '$email';";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        if (count($stmt->fetchAll()) == 0) {
            $stmt = null;
            $contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT);
            $SQL = "INSERT INTO usuarios (nombre,correo,contrasenia) VALUES ('$nombre','$email','$contrasenia');";
            $stmt = Conexion::conectar()->prepare($SQL);
            if ($stmt->execute()) {
                return "Usuario registrado!";
            } else {
                return "Peticion registrar fallida!";
            }
            $stmt = null;
        } else {
            return "El mail de usuario ya existe!";
            $stmt = null;
        }
    }

    public static function identificarEmpresa($correo, $contrasenia, $fechaActual, $horaActual)
    {
        $SQL = "SELECT * FROM accesos WHERE fecha = '$fechaActual' AND horaInicio<='$horaActual' AND horaFin>='$horaActual';";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        $stmt = null;
        if (count($resultado) > 0) {
            $SQL = "SELECT id, contrasenia FROM empresas WHERE correo='$correo';";
            $stmt = Conexion::conectar()->prepare($SQL);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if (count($resultado) > 0 && password_verify($contrasenia, $resultado['contrasenia'])) {
                $_SESSION['empresa_id'] = $resultado['id'];
                echo "success| ";
            } else {
                echo "error|Verifica tus datos!";
            }
            $stmt = null;
        } else {
            echo "error|Acceso no permitido!";
        }
    }

    public static function identificarUsuario($correo, $contrasenia, $fechaActual, $horaActual)
    {
        if ($correo == "admin@admin") {
            $SQL = "SELECT id, contrasenia FROM usuarios WHERE correo='$correo';";
            $stmt = Conexion::conectar()->prepare($SQL);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if (count($resultado) > 0 && password_verify($contrasenia, $resultado['contrasenia'])) {
                $_SESSION['admin_id'] = $resultado['id'];
                echo "success| ";
            } else {
                echo "error|Verifica tus datos!";
            }
            $stmt = null;
        } else {
            $SQL = "SELECT * FROM accesos WHERE fecha = '$fechaActual' AND horaInicio<='$horaActual' AND horaFin>='$horaActual';";
            $stmt = Conexion::conectar()->prepare($SQL);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $stmt = null;
            if (count($resultado) > 0) {
                $SQL = "SELECT id, contrasenia FROM usuarios WHERE correo='$correo';";
                $stmt = Conexion::conectar()->prepare($SQL);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                if (count($resultado) > 0 && password_verify($contrasenia, $resultado['contrasenia'])) {
                    $_SESSION['user_id'] = $resultado['id'];
                    echo "success| ";
                } else {
                    echo "error|Verifica tus datos!";
                }
                $stmt = null;
            } else {
                echo "error|Acceso no permitido!";
            }
        }
    }

    public static function validarAcceso($fechaActual, $horaActual)
    {
        $SQL = "SELECT * FROM accesos WHERE fecha = '$fechaActual' AND horaInicio<='$horaActual' AND horaFin>='$horaActual';";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        $stmt = null;
        if (count($resultado) == 0) {
            echo "error|Acceso no permitido!";
        } else {
            echo "success|Acceso valido!";
        }
    }

    public static function salir()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}

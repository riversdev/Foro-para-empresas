<?php
session_start();

require_once "conexion.php";

class Welcome
{
    public static function registrarUsuario($nombre, $email, $contrasenia, $tipo)
    {
        $SQL = "SELECT * FROM users WHERE email = '$email';";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        if (count($stmt->fetchAll()) == 0) {
            $stmt = null;
            $contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT);
            $SQL = "INSERT INTO users (user,email,password,type) VALUES ('$nombre','$email','$contrasenia','$tipo');";
            $stmt = Conexion::conectar()->prepare($SQL);
            if ($stmt->execute()) {
                return true;
            } else {
                return "Peticion registrar fallida";
            }
            $stmt = null;
        } else {
            return "El usuario ya existe";
            $stmt = null;
        }
    }

    public static function identificarUsuario($correo, $contrasenia)
    {
        $SQL = "SELECT a.id,a.user,a.email,a.password,b.type
                FROM users AS a
                INNER JOIN typeusers AS b ON b.id=a.type
                WHERE a.email='$correo';";
        $stmt = Conexion::conectar()->prepare($SQL);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($resultado) > 0 && password_verify($contrasenia, $resultado['password'])) {
            $_SESSION['user_id'] = $resultado['id'];
            return 1;
        } else {
            return 0;
        }
        $stmt = null;
    }

    public static function salir()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}

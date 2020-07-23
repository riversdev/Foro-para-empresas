<?php
class viewsModel
{
    protected function obtenerVistasModelo($vistas)
    {
        $listaBlanca = ["empresa", "usuario"];
        if (in_array($vistas, $listaBlanca)) { // si la cadena de la ruta esta en la lista blanca dejara acceder
            if (is_file("./views/templates/" . $vistas . ".php")) {
                $contenido = "./views/templates/" . $vistas . ".php";
            } else {
                $contenido = "welcome";
            }
        } else {
            $contenido = "welcome";
        }
        return $contenido;
    }
}

<?php
class viewsModel
{
    protected function obtenerVistasModelo($vistas)
    {
        $listaBlanca = ["home", "busqueda", "inventary"];
        if (in_array($vistas, $listaBlanca)) { // si la cadena de la ruta esta en la lista blanca dejara acceder
            if (is_file("./views/templates/" . $vistas . ".js")) {
                $contenido = "./views/templates/" . $vistas . ".js";
            } else {
                $contenido = "welcome";
            }
        } else {
            $contenido = "welcome";
        }
        return $contenido;
    }
}

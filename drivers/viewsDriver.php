<?php
    require_once "./models/viewsModel.php";
    class viewsDriver extends viewsModel{
        public function obtenerPlantillaControlador(){
            return require_once "./views/layout.php";
        }
        public function obtenerVistasControlador(){
            if (isset($_GET['views'])) {
                $ruta = explode("/",$_GET['views']);
                $respuesta = viewsModel::obtenerVistasModelo($ruta[0]); // Seleccionar un metodo de la clse heredada
            } else {
                $respuesta = "welcome";
            }
            return $respuesta;
        }
    }
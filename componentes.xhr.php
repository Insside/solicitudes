<?php
$ROOT = (!isset($ROOT)) ? "../../" : $ROOT;
require_once($ROOT . "modulos/comercial/librerias/Configuracion.cnf.php");
Sesion::init();
$usuario=Sesion::usuario();

$menus = new Aplicacion_Menus();
echo($menus->menu("3000000",$usuario['usuario']));

?>
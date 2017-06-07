<?php
error_reporting(E_ALL);
if(!defined("ROOT")){define('ROOT', dirname(__FILE__) . '/../../../');}
if(!defined("ROOT_MODULE_SOCIAL")){define('ROOT_MODULE_SOLICITUDES', dirname(__FILE__) . '/../');}
$ROOT = (!isset($ROOT)) ? ROOT:$ROOT;
require_once(ROOT. "librerias/Configuracion.cnf.php");
Sesion::init();
if(!class_exists('Validaciones')){require_once($ROOT."librerias/Validaciones.class.php");}
/** Clases del Modulo * */
require_once($ROOT . "modulos/solicitudes/librerias/Asuntos.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Solicitudes_Respuestas.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Categorias.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Causales.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Filtros.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Servicios.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Solicitud.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Solicitudes.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Solicitudes_Solicitudes.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Solicitudes_Usuarios.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Solicitudes_Archivos.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Respuestas.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Solicitudes_Notificaciones.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Traslados.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Formatos.class.php");
//require_once($ROOT . "modulos/solicitudes/librerias/Solicitudes_Mensajeria.class.php");
/** Otros Modulos * */
require_once($ROOT . "modulos/usuarios/librerias/Usuarios.class.php");
require_once($ROOT . "modulos/usuarios/librerias/Usuarios_Equipos.class.php");
require_once($ROOT . "modulos/suscriptores/librerias/Suscriptores.class.php");
require_once($ROOT . "modulos/suscriptores/librerias/Legalizaciones.class.php");

?>
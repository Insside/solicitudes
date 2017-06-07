<?php
$cadenas = new Cadenas();
$fechas = new Fechas();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
$sevicios = new Servicios();
$categorias = new Categorias();
$solicitudes = new Solicitudes();
$causales = new Causales();
$validaciones = new Validaciones();
$respuestas = new Respuestas();
$notificaciones = new Solicitudes_Notificaciones();
$asuntos = new Asuntos();
$suscriptores = new Suscriptores();

$s = $solicitudes->consultar($validaciones->recibir('solicitud'));
/** Requeridos **/
require_once($_PATH."/informacion.inc.php");
require_once($_PATH."/historial.inc.php");
/** Tabs **/
$tp=new TabbedPane(array("pagesHeight"=>"3000px"));
$tp->addTab("General","general",$f->fila["informacion"]);
$tp->addTab("Historial","historial",$f->fila["historial"]);
/** Filas **/
$f->filas($tp->getPane());
/** Botones **/
/** JavaScripts **/
//$f->eClick("modificar".$f->id,"MUI.closeWindow($('".$f->ventana."'));MUI.Tesoreria_Solicitud_Cheque_Modificar('".@$valores['solicitud']."');");
$f->JavaScript("var tabs = new MUI.TabbedPane('.tab','.feature',{autoplay: false,transitionDuration:500,slideInterval:3000,hover:true});");
?>
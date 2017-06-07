<?php

$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;

$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cerrar");
$f->campos['modificar'] = $f->button("modificar" . $f->id, "button", "Modificar");
/** Segmentos * */
require_once($ROOT . "modulos/solicitudes/formularios/notificacion/consultar/segmentos/detalles.inc.php");
require_once($ROOT . "modulos/solicitudes/formularios/notificacion/consultar/segmentos/contenido.inc.php");
/** <TabbedPane> **/
$tp = new TabbedPane(array("pagesHeight" => "300px"));
$tp->addTab("Detalles",null, $f->fila["detalles"]);
$tp->addTab("Contenido",null, $f->fila["contenido"]);
/** Compilando * */
$f->filas($tp->getPane());
/** </TabbedPane> **/
/** Botones * */
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['modificar'], "inferior-derecha");
$f->botones($f->campos['cancelar'], "inferior-derecha");
/** JavaScripts * */
$f->windowTitle("Solicitudes / Notificaciones / Visualizar /","1.1");
$f->windowResize(array("autoresize"=>false,"width"=>"610","height"=>"400"));
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->eClick("modificar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));MUI.Solicitudes_Notificacion_Modificar('".$valores['notificacion']."');");
?>
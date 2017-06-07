<?php

$ROOT = (!isset($ROOT)) ? "../../../../../" : $ROOT;

$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cerrar");
$f->campos['modificar'] = $f->button("modificar" . $f->id, "submit", "Modificar");
/** Segmentos * */
require_once($ROOT . "modulos/solicitudes/formularios/notificacion/modificar/segmentos/detalles.inc.php");
require_once($ROOT . "modulos/solicitudes/formularios/notificacion/modificar/segmentos/contenido.inc.php");

$f->fila["tabs"] = ""
        . "<ul id=\"tabs".$f->id."\" class=\"TabbedPane\">"
        . "<li><a class=\"tab\" href=\"#\" id=\"it1\">Detalles</a></li>"
        . "<li><a class=\"tab\" href=\"#\" id=\"it3\">Contenido</a></li>"
        . "</ul>";
$f->fila["home"] = ""
        . "<div id=\"home".$f->id."\">"
        . "<div class=\"feature\">" . $f->fila["detalles"] . "</div>"
        . "<div class=\"feature\">" . $f->fila["contenido"] . "</div>"
        . "</div>";
/** Compilando * */
$f->filas($f->fila['tabs']);
$f->filas($f->fila['home']);
/** Botones * */
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['modificar'], "inferior-derecha");
/** JavaScripts * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'),\" Solicitudes / Notificaciones / Visualizar / \");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'),{width: 610,height:410});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->JavaScript("var tabsnotificacion = new MUI.TabbedPane('#tabs".$f->id." li a', '#home".$f->id." .feature', {autoplay: false,transitionDuration: 500,slideInterval: 3000,hover: true});");
?>
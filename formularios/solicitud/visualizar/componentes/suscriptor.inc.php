<?php

/** Variables Recibidas * */
$solicitud = $solicitudes->consultar($validaciones->recibir('solicitud'));
/** Elementos * */
if ($solicitud['causal'] != "211") {
    $f->fila["i3"] = $f->fila("\n<!-- Suscriptor //-->\n"
            . "<h2>2.1. Suscriptor Referenciado.</h2>");
    $f->fila["suscriptor1"] = $f->fila($f->celdas["suscriptor"] . $f->celdas["suscriptor_identificacion"] . $f->celdas["suscriptor_nombres"] . $f->celdas["suscriptor_apellidos"]);
    $f->fila["suscriptor2"] = $f->fila($f->celdas["suscriptor_direccion"] . $f->celdas["suscriptor_telefonos"] . $f->celdas["suscriptor_correo"] . $f->celdas["suscriptor_estrato"] . $f->celdas["suscriptor_predial"]);
    $f->fila["f8"] = $f->fila($f->celdas["orden"] . $f->celdas["fecha"]);



    $f->fila["suscriptor"] = "<div style=\" border-style:solid;border-width:1px;border-color:#cccccc;padding:10px;\">";
    $f->fila["suscriptor"] .= $f->fila['i3'] . $f->fila['suscriptor1'] . $f->fila['suscriptor2'];
    $f->fila["suscriptor"] .= "</div>";
} else {
    $f->fila["suscriptor"] = "";
}
?>
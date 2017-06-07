<?php
/** Celdas 1**/
$f->celdas["solicitud"] = $f->celda("Código de Solicitud:", $f->campos['solicitud'],"","w100px");
$f->celdas["solicitud-radicado"] = $f->celda("Radicado:", $f->campos['solicitud-radicado'],"","");
$f->celdas["solicitud-radicacion"] = $f->celda("Radicación:", $f->campos['solicitud-radicacion'],"","w100px");
$f->celdas["solicitud-suscriptor"] = $f->celda("Suscriptor:", $f->campos['solicitud-suscriptor'],"","w100px");
$f->celdas["suscriptor-nombre"] = $f->celda("Nombre Completo:", $f->campos['suscriptor-nombre'],"","");
$f->celdas["suscriptor-direccion"] = $f->celda("Dirección del Predio:", $f->campos['suscriptor-direccion'],"","");
/** Celdas 2**/
$f->celdas["respuesta"] = $f->celda("Código de Respuesta:", $f->campos['respuesta'],"","w150");
$f->celdas["tipo"] = $f->celda("Tipo:", $f->campos['tipo']);
$f->celdas["formato"] = $f->celda("Formato:", $f->campos['formato']);
$f->celdas["radicado"] = $f->celda("Radicado:", $f->campos['radicado']);
$f->celdas["detalle"] = $f->celda("Detalle:", $f->campos['detalle']);
$f->celdas["fecha"] = $f->celda("Fecha / Radicación:", $f->campos['fecha'],"","w120");
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora'],"","w100px");
$f->celdas["categoria"] = $f->celda("Categoria:", $f->campos['categoria']);
$f->celdas["estado"] = $f->celda("Estado:", $f->campos['estado']);
/** Celdas 3**/
$f->celdas["detalle"] = $f->celda("Contenido Textual:", urldecode($f->campos['detalle']),"","w150");

?>
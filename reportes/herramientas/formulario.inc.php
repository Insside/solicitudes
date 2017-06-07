<?php
$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
require_once($ROOT . "modulos/solicitudes/librerias/Configuracion.cnf.php");
Sesion::init();
/*
 * Copyright (c) 2014, Jose Alexis Correa Valencia
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */


$v = new Validaciones();
$s = new Solicitudes();

$fechas=new Fechas();
$servicios=new Servicios();
$transaccion=Request::getValue("transaccion");
$trasmision = Request::getValue("trasmision");;

$fecha=explode("-",$fechas->hoy());
$inicio_alternativo=$fecha[0]."-".$fecha[1]."-01";
$final_alternativo=$fecha[0]."-".$fecha[1]."-31";

$usuario=Sesion::usuario();
$equipo=$usuario['equipo'];
$servicio=$v->recibir("servicio");
$inicio=$v->recibir("inicio");
$final=$v->recibir("final");

$servicio=empty($servicio) ? "01": $servicio;

$inicio=empty($inicio) ? $inicio_alternativo :$inicio;
$final=empty($final) ? $final_alternativo :$final;

$f = new Forms($transaccion);
echo("<div class=\"toolbox divider\">");
echo($f->apertura());
/** Campos **/
$f->campos['servicio']=$servicios->combo("servicio","01");
$f->campos['inicio'] = $f->calendario("inicio".$f->id,$inicio,"-1","2");
$f->campos['final'] = $f->calendario("final".$f->id,$final,"-1","2");
$f->campos['consolidar'] = $f->button("consolidar" . $f->id, "button", "Consolidar");
$f->campos['descargar'] = $f->button("descargar" . $f->id, "button", "Descargar");
/** Celdas **/
$f->celdas["etiqueta-servicio"] = $f->celda("","Servicios:","","sinfondo");
$f->celdas["etiqueta-inicio"] = $f->celda("","Inicio:","","sinfondo");
$f->celdas["etiqueta-final"] = $f->celda("","Final:","","sinfondo");
$f->celdas["servicio"] = $f->celda("",$f->campos['servicio'],"","w150 sinfondo");
$f->celdas["inicio"] = $f->celda("",$f->campos['inicio'],"","w200 sinfondo");
$f->celdas["final"] = $f->celda("",$f->campos['final'],"","w200 sinfondo"); 
$f->celdas["consolidar"] = $f->celda("",$f->campos['consolidar'],"","sinfondo");
$f->celdas["descargar"] = $f->celda("",$f->campos['descargar'],"","sinfondo");
$f->fila["fila1"] = $f->fila($f->celdas["etiqueta-inicio"] .$f->celdas["inicio"].$f->celdas["etiqueta-final"].$f->celdas["final"].$f->celdas["consolidar"].$f->celdas["descargar"]);
$f->filas($f->fila['fila1']);
$f->eClick("consolidar".$f->id,"MUI.Solicitudes_Reporte_Consultar(\$('inicio".$f->id."').value,\$('final".$f->id."').value);MUI.closeWindow($('" . ($f->ventana) . "'));");
$f->eClick("descargar".$f->id,"location.href='modulos/solicitudes/reportes/solicitudes.xls.php?inicio=".$inicio."&final=".$final."&equipo=".$equipo."';MUI.closeWindow($('" . ($f->ventana) . "'));");
echo("</div>");
?>
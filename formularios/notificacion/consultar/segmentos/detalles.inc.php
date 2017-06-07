<?php

/* 
 * Copyright (c) 2016, inssi
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
$usuarios=new Usuarios();
$notificaciones=new Solicitudes_Notificaciones();
/** Variables **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$notificacion=$notificaciones->consultar($validaciones->recibir("notificacion"));
$tipo=$notificaciones->tipos_consultar($notificacion['tipo']);
$formato=$notificaciones->formatos_consultar($notificacion['formato']);
$empleado=$usuarios->empleado($notificacion['creador']);
/** Valores **/
$valores=$notificacion;
$valores['tipo']=$valores['tipo'].": ".$tipo['nombre'];
$valores['formato']=$valores['formato'].": ".$formato['nombre'];
$valores['creador']=$valores['creador'].": ".$cadenas->capitalizar($empleado['nombres']." ".$empleado['apellidos']);
/** Campos **/
$f->campos['notificacion']=$f->campo("notificacion",$valores['notificacion']);
$f->campos['solicitud']=$f->campo("solicitud",$valores['solicitud']);
$f->campos['respuesta']=$f->campo("respuesta",$valores['respuesta']);
$f->campos['radicacion']=$f->campo("radicacion",$valores['radicacion']);
$f->campos['tipo']=$f->campo("tipo",$valores['tipo']);
$f->campos['formato']=$f->campo("formato",$valores['formato']);
$f->campos['contenido']=$f->campo("contenido",$valores['contenido']);
$f->campos['fecha']=$f->campo("fecha",$valores['fecha']);
$f->campos['hora']=$f->campo("hora",$valores['hora']);
$f->campos['creador']=$f->campo("creador",$valores['creador']);
$f->campos['estado']=$f->campo("estado",$valores['estado']);
$f->campos['cerrar']=$f->button("cerrar".$f->id,"button","Cerrar","","MUI.closeWindow($('" . ($f->ventana) . "'));");
$f->campos['actualizar']=$f->button("actualizar".$f->id,"button","Modificar","","MUI.closeWindow($('" . ($f->ventana) . "'));MUI.Solicitudes_Notificacion_Actualizar_Detalles('".$notificacion['notificacion']."');");
/** Celdas **/
$f->celdas["notificacion"] = $f->celda("Código  de Notificacion:", $f->campos['notificacion']);
$f->celdas["solicitud"] = $f->celda("Código de Solicitud:", $f->campos['solicitud']);
$f->celdas["respuesta"] = $f->celda("Código  de Respuesta:", $f->campos['respuesta']);
$f->celdas["radicacion"] = $f->celda("Radicación (Documento Fisico):", $f->campos['radicacion']);
$f->celdas["tipo"] = $f->celda("Tipo de Notificación:", $f->campos['tipo']);
$f->celdas["formato"] = $f->celda("Formato de Documento Aplicado:", $f->campos['formato']);
$f->celdas["contenido"] = $f->celda("Contenido:", $f->campos['contenido']);
$f->celdas["fecha"] = $f->celda("Fecha de Creación:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora de Registro:", $f->campos['hora']);
$f->celdas["creador"] = $f->celda("Creador (Usuario):", $f->campos['creador']);
$f->celdas["estado"] = $f->celda("Estado:", $f->campos['estado']);
/** Filas **/
$f->fila["df1"] = $f->fila("<h2>Detalles Explícitos de la Notificación.</h2>");
$f->fila["df2"] = $f->fila($f->celdas["notificacion"].$f->celdas["solicitud"]);
$f->fila["df3"] = $f->fila($f->celdas["respuesta"].$f->celdas["radicacion"]);
$f->fila["df4"] = $f->fila($f->celdas["tipo"]);
//$f->fila["df5"] = $f->fila($f->celdas["formato"]);
$f->fila["df6"] = $f->fila("<h2>Información del Registro & Responsabilidad.</h2>");
$f->fila["df7"] = $f->fila($f->celdas["fecha"].$f->celdas["hora"]);
$f->fila["df8"] = $f->fila($f->celdas["creador"]);
//$f->fila["fila4"] = $f->fila($f->celdas["estado"]);
/** Compilando **/
$f->fila["detalles"]=$f->fila['df1']
        .$f->fila['df2']
        .$f->fila['df3']
        .$f->fila['df4']
        .$f->fila['df6']
        .$f->fila['df7'];

?>
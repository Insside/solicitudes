<?php
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/solicitudes/librerias/Configuracion.cnf.php");

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
$validaciones=new Validaciones();
$transaccion=$validaciones->recibir("transaccion");
$trasmision = $validaciones->recibir("trasmision");
$f = new Forms($transaccion);
echo($f->apertura());
/** Campos * */
$f->campos['icono']="<div class=\"i100x100_ayuda\" style=\"float: left;\"></div>";
$f->campos['info']="<h2>Detalle de la Causal.</h2><p>Corresponde al código asignado a la razón de la reclamación ó petición.
Debe escoger el código dependiendo del tipo de trámite. En caso que para el mismo radicado
recibido, en el mismo período exista el tipo de trámite reclamación y petición debe generar dos
registros.</p>";
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Continuar");
/** Celdas * */
$f->celdas["icono"] = $f->celda("", $f->campos['icono'], "", "sinfondo");
$f->celdas["info"] = $f->celda("", $f->campos['info'], "", "sinfondo");
/** Filas * */
$f->fila["info"] = $f->fila($f->celdas['icono'].$f->celdas['info']);
/** Ordenando **/
$f->filas($f->fila['info']);
$f->botones($f->campos['cancelar'],"inferior-derecha");
/** JavaSript **/
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Ayuda.\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 480, height: 230});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>
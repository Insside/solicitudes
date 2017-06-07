<?php

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

print_r($_REQUEST);

$v=new Validaciones();
$notificaciones=new Notificaciones();
/** Datos **/
$d["solicitud"]=$v->recibir("solicitud");
$d["notificacion"]=$v->recibir("notificacion");
$d["tipo"]=$v->recibir("tipo");
$d["radicacion"]=$v->recibir("radicacion");
$d["contenido"]=$v->recibir("contenido");
$d["fecha"]=$v->recibir("fecha");
/** Transacciones **/
$notificaciones->actualizar($d["notificacion"],"tipo", $d["tipo"]);
$notificaciones->actualizar($d["notificacion"],"radicacion", $d["radicacion"]);
$notificaciones->actualizar($d["notificacion"],"contenido", urlencode($d["contenido"]));
$notificaciones->actualizar($d["notificacion"],"fecha", $d["fecha"]);
/** JavaScript **/
$f->windowClose();
$f->JavaScript("MUI.Solicitudes_Solicitud_Consultar(\"".$d["solicitud"]."\");");
?>
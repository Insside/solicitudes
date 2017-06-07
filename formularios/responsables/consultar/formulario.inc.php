<?php

/*
 * Copyright (c) 2015, Alexis
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
/*
 * Copyright (c) 2013, Alexis
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

$solicitudes=new Solicitudes();
$solicitud = $solicitudes->consultar($v->recibir("solicitud"));
/** Campos * */
$f->oculto("solicitud", $solicitud['solicitud']);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cerrar");
$f->campos['responsabilizar'] = $f->button("responsabilizar" . $f->id, "button", "Modificar");
/** Includes **/
require_once(PATH."/includes/responsable.inc.php");
require_once(PATH."/includes/creador.inc.php");
require_once(PATH."/includes/equipo.inc.php");
/** <TabbedPane> **/
$tp = new TabbedPane(array("pagesHeight" => "310px"));
$tp->addTab("Responsable",null, $f->fila["responsable"]);
$tp->addTab("Creador",null, $f->fila["creador"]);
$tp->addTab("Equipo",null, $f->fila["equipo"]);
/** Compilando * */
$f->filas($tp->getPane());
/** </TabbedPane> **/
//if($sesion->getValue("SUSCRIPTORES-SUCRIPTOR-U")){$f->botones($f->campos['actualizar']);}
/** Botones * */
$f->botones($f->campos['ayuda'], "inferior-izquierda");
//$f->botones($f->campos['georeferenciar'], "inferior-izquierda");
$f->botones($f->campos['responsabilizar'], "inferior-derecha");
$f->botones($f->campos['cancelar'], "inferior-derecha");
/** JavaScripts * */
$f->windowTitle("Responsables de Recepción & Tramite","1.3");
$f->windowResize(array("autoresize"=>false,"width"=>"680","height"=>"400"));
$f->windowCenter();
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->eClick("responsabilizar" . $f->id,"MUI.closeWindow($('" . $f->ventana . "'));MUI.Solicitudes_Solicitud_Responsabilizar('".$solicitud['solicitud']."');");
?>
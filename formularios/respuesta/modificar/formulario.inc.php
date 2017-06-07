<?php
$cadenas = new Cadenas();
$fechas = new Fechas();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
$validaciones = new Validaciones();
$respuestas=new Respuestas();
$solicitudes=new Solicitudes();
$suscriptores=new Suscriptores();
$formatos=new Formatos();
$empleados = new Empleados();
$usuarios=new Usuarios();
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

/** Variables **/
$respuesta=$respuestas->consultar($validaciones->recibir("respuesta"));
$solicitud=$solicitudes->consultar($respuesta['solicitud']);
$suscriptor=$suscriptores->consultar($solicitud['suscriptor']);
$_path= dirname(__FILE__);
/** Valores **/
$valores=$respuesta;
$usuario=$usuarios->consultar($valores['creador']);
$empleado = $empleados->perfil($usuario['perfil']);
/** Requires **/
require_once($_path."/includes/campos.inc.php");
require_once($_path."/includes/celdas.inc.php");
require_once($_path."/includes/informacion.inc.php");
require_once($_path."/includes/detalle.inc.php");
require_once($_path."/includes/creador.inc.php");

/** Filas **/
$f->fila["r1"] = $f->fila($f->celdas["creador"]);

/** Tab Responsable **/

/** <TabbedPane> **/
$tp = new TabbedPane(array("pagesHeight" => "390px"));
$tp->addTab("Información",null, $f->fila["informacion"]);
$tp->addTab("Contenido",null, $f->fila["detalle"]);
$tp->addTab("Responsable",null, $f->fila["creador"]);
/** Compilando * */
$f->filas($tp->getPane());
/** </TabbedPane> **/
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha"); 
/** JavaScripts **/
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'),'Modificar Respuesta <span class=\"version\">v1.6 Revisión 20161213</span>');");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width:640, height:480});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
//$f->eClick("georeferencia" . $f->id, "MUI.Medidores_Georeferencia_Crear('" . $relacion['suscriptor'] . "');");
?>
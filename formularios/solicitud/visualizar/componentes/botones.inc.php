<?php

require_once($ROOT . "modulos/comercial/librerias/Comercial_Aforos.class.php");
$legalizaciones = new Legalizaciones();
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
$solicitud = $solicitudes->consultar($validaciones->recibir('solicitud'));

$f->campos['cerrar'] = $f->button("cerrar" . $f->id, "button", "Cerrar");
$f->campos['actualizar'] = $f->button("actualizar" . $f->id, "button", "Actualizar");
$legalizacion = $legalizaciones->estado($solicitud['solicitud']);


if (($solicitud['causal'] == "211") && ($legalizacion == "rojo")) {
// Se debe verificar si esta aforado antes de proceder a realizar la legalización.
    $aforos = new Comercial_Aforos();
    $sa = $aforos->solicitud($solicitud['solicitud']);/** Solicitud Aforada * */
    $ea = $aforos->estado($sa["aforo"]);/** Estado Aforo * */
    if ($ea) {
        $f->campos['legalizar'] = $f->button("legalizar" . $f->id, "button", "Legalizar");
        $f->botones($f->campos["legalizar"]);
        $f->eClick("legalizar" . $f->id, "MUI.Suscriptores_Solicitud_Legalizar('" . $solicitud['solicitud'] . "');");
    }
}
/** Botones * */
$f->botones($f->campos["cerrar"]);
//$f->botones($f->campos["actualizar"]);
?>
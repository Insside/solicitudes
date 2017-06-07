<?php
/** Filas **/
$f->fila["if1"]="<h2>Solicitud Relacionada.</h2>";
$f->fila["if2"] = $f->fila($f->celdas["solicitud"].$f->celdas["solicitud-radicado"].$f->celdas["solicitud-radicacion"]);
$f->fila["if3"] = $f->fila($f->celdas["solicitud-suscriptor"].$f->celdas["suscriptor-nombre"]);
$f->fila["if4"] = $f->fila($f->celdas["suscriptor-direccion"]);
$f->fila["if5"]="<h2>Respuesta Generada</h2>";
$f->fila["if6"] = $f->fila($f->celdas["respuesta"].$f->celdas["radicado"].$f->celdas["fecha"].$f->celdas["hora"]);
$f->fila["if7"] = $f->fila($f->celdas["formato"].$f->celdas["tipo"].$f->celdas["categoria"]);
/** Final **/
$f->fila["informacion"]=$f->fila["if1"]
        .$f->fila['if2']
        .$f->fila['if3']
        .$f->fila["if4"]
        .$f->fila['if5']
        .$f->fila['if6']
        .$f->fila['if7'];
?>
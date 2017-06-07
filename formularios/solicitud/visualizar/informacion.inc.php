<?php

require_once($_PATH. "/componentes/encabezado.inc.php");
require_once($_PATH. "/componentes/solicitud.inc.php");
require_once($_PATH. "/componentes/solicitante.inc.php");
require_once($_PATH. "/componentes/suscriptor.inc.php");
require_once($_PATH. "/componentes/respuestas.inc.php");
require_once($_PATH. "/componentes/notificaciones.inc.php");
require_once($_PATH. "/componentes/adjuntos.inc.php");
require_once($_PATH. "/componentes/botones.inc.php");
/** Filas * */
$f->fila["informacion"] = $f->fila(
        $f->fila["encabezado"]
        . $f->fila["solicitud"]
        . $f->fila["solicitante"]
        . $f->fila["suscriptor"]
        . $f->fila["respuestas"]
        . $f->fila["notificaciones"]
        . $f->fila["adjuntos"]
);
?>
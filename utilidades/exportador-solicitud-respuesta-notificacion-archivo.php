<?php

$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/solicitudes/librerias/Configuracion.cnf.php");
header('Content-Type: application/json');

if (isset($_REQUEST["usuario"]) && !empty($_REQUEST["usuario"])) {
    /** Generar Archivo JSON de las Solicitudes * */
    $usuario = $_REQUEST["usuario"];
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `solicitudes_solicitudes` WHERE `creador` ='$usuario' ORDER BY `solicitud`;";
    $consulta = $db->sql_query($sql);
    $conteo = 0;
    $r = array();
    while ($fila = $db->sql_fetchrow($consulta)) {
        $conteo++;
        array_push($r, $fila);
    }
    $db->sql_close();
    file_put_contents($usuario . "-solicitudes.json", json_encode($r));
    /** Generar Archivo JSON Respuestas * */
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `solicitudes_respuestas` WHERE `creador` ='$usuario' ORDER BY `respuesta`;";
    $consulta = $db->sql_query($sql);
    $conteo = 0;
    $r = array();
    while ($fila = $db->sql_fetchrow($consulta)) {
        $conteo++;
        array_push($r, $fila);
    }
    $db->sql_close();
    file_put_contents($usuario . "-respuestas.json", json_encode($r));
    /** Generar Archivo JSON Notificaciones * */
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `solicitudes_notificaciones` WHERE `creador` ='$usuario' ORDER BY `notificacion`;";
    $consulta = $db->sql_query($sql);
    $conteo = 0;
    $r = array();
    while ($fila = $db->sql_fetchrow($consulta)) {
        $conteo++;
        array_push($r, $fila);
    }
    $db->sql_close();
    file_put_contents($usuario . "-notificaciones.json", json_encode($r));
    /** Generar Archivo JSON Archivos **/
    $db = new MySQL(Sesion::getConexion());
    $sql = "SELECT * FROM `solicitudes_archivos` WHERE `creador` ='$usuario' ORDER BY `archivo`;";
    $consulta = $db->sql_query($sql);
    $conteo=0;
    $r=array();
    while ($fila = $db->sql_fetchrow($consulta)) {
      $conteo++;
      array_push($r,$fila);
    }
    $db->sql_close();
    file_put_contents($usuario."-archivos.json",json_encode($r));
} else {
    echo("se requiere un usuario.");
}
?>
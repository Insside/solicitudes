<?php
$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
if(!class_exists('MySQL')) {require_once($ROOT."librerias/Sesion.class.php");}
if(!class_exists('MySQL')) {require_once($ROOT."librerias/MySQL.class.php");}
Sesion::init();
$me=new Medidores_Estados();
$db=new MySQL(Sesion::getConexion());
$consulta=$db->sql_query("SELECT * FROM `medidores_cambiados`;"); 
$numero_registros=$db->sql_numrows($consulta);
$conteo=0;
echo("<table border=\"1\">");
while($fila=$db->sql_fetchrow($consulta)){
  $conteo++;
  $e=$me->suscriptor($fila['suscriptor']);
  echo("<tr><td>".$conteo."</td><td>".$fila['movimiento']."</td><td>".$fila['suscriptor']."</td><td>".$e['referencia']."</td></tr>");
}
$db->sql_close();
echo("</table>");
?>
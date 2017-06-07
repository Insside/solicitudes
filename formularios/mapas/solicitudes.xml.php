<?php
$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
if(!class_exists('MySQL')) {require_once($ROOT."librerias/MySQL.class.php");}
if(!class_exists('Medidores')) {require_once($ROOT."modulos/medidores/librerias/Medidores.class.php");}
?>
<?php
header("Content-type: text/xml");
$db=new MySQL(Sesion::getConexion());
$consulta=$db->sql_query("SET NAMES 'utf8'");
$consulta=$db->sql_query("SELECT
  `suscriptores`.`suscriptor`, `suscriptores`.`identificacion`,
  `suscriptores`.`nombres`, `suscriptores`.`apellidos`,
  `suscriptores`.`direccion`, `suscriptores`.`predial`,
  `suscriptores`.`telefonos`, `suscriptores`.`referencia`,
  `suscriptores`.`estrato`, `medidores_estados`.`estado`,`medidores_estados`.`referencia`,
  `suscriptores`.`latitud`,`suscriptores`.`longitud`
FROM
  `medidores_estados` INNER JOIN
  `suscriptores` ON `medidores_estados`.`suscriptor` =
    `suscriptores`.`suscriptor`
;"); 
// htmlentities
$numero_registros=$db->sql_numrows($consulta);
echo("<markers>");
for($i=0;$i<$numero_registros;$i++) {
  $fila=$db->sql_fetchrow($consulta);
  $notificacion=$medidores-> notificacion_estado($fila['estado']);
  echo('<marker 
   estado="'.$fila['estado'].'" 
   suscriptor="'.$fila['suscriptor'].'" 
  	identificacion="'.$fila['identificacion'].'" 
	nombres="'.($fila['nombres']).'" 
	apellidos="'.($fila['apellidos']).'" 
	notificacion="'.($notificacion['notificacion']).'" 
	referencia="'.(strtolower($fila['referencia'])).'" 
	lat="'.$fila['latitud'].'" 
	lng="'.$fila['longitud'].'"/>');
}
$db->sql_close();
echo("</markers>");
?>
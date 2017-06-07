<?php

$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
if (!class_exists('MySQL')) {
  require_once($ROOT . "librerias/MySQL.class.php");
}
if (!class_exists('Medidores')) {
  require_once($ROOT . "modulos/medidores/librerias/Medidores.class.php");
}
if (!class_exists('Suscriptores')) {
  require_once($ROOT . "modulos/medidores/librerias/Medidores.class.php");
}
?>
<?php

header("Content-type: text/xml");
$db = new MySQL(Sesion::getConexion());
$consulta = $db->sql_query("SET NAMES 'utf8'");
$consulta = $db->sql_query("SELECT * FROM `solicitudes_solicitudes` "
        . "WHERE `radicacion` > '2015-01-01' AND `radicacion` < '2015-06-14';");
// htmlentities
$numero_registros = $db->sql_numrows($consulta);
echo("<markers>");
for ($i = 0; $i < $numero_registros; $i++) {
  $fila = $db->sql_fetchrow($consulta);
  $suscriptor = consultar($fila["suscriptor"]);
  echo('<marker 
  suscriptor="' . $fila['suscriptor'] . '"
  nombre="' . urlencode($suscriptor['nombres']) . '" 
  direccion="' . urlencode($suscriptor['direccion']) . '" 
	lat="' . $suscriptor['latitud'] . '" 
	lng="' . $suscriptor['longitud'] . '"/>');
}
$db->sql_close();
echo("</markers>");

function consultar($suscriptor) {
  $db = new MySQL(Sesion::getConexion());
  $sql = "SELECT
  `suscriptores`.*,
  `suscriptores`.`suscriptor` AS `suscriptor1`,
  `gps`.`latitud` AS `latitud`,
  `gps`.`longitud` AS `longitud`
FROM
  `suscriptores`
  INNER JOIN `gps` ON `suscriptores`.`suscriptor` = `gps`.`suscriptor`
WHERE
  `gps`.`suscriptor` = '".$suscriptor."'
LIMIT 0, 1; ";
  $consulta = $db->sql_query($sql);
  $fila = $db->sql_fetchrow($consulta);
  $db->sql_close();
  return($fila);
}

?>
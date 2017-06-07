<?php
$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$usuario=Sesion::usuario();
$validaciones=new Validaciones();
$respuestas=new Respuestas();
$notificaciones=new Solicitudes_Notificaciones();
$traslados=new Traslados();
$equipo=(!empty($usuario["equipo"]))?$usuario["equipo"]:$validaciones->recibir("equipo");
$cadenas=new Cadenas();
$fechas=new Fechas();
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */
$inicio=$validaciones->recibir("inicio");
$final=$validaciones->recibir("final");
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
/** Include PHPExcel */
require_once($ROOT . 'librerias/excel/PHPExcel.php');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
// Add some data

$db = new MySQL(Sesion::getConexion());
$sql = "SELECT * "
        . "FROM `solicitudes_solicitudes` "
        . "WHERE((`radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "')"
        . "AND(`equipo`='" . $equipo. "'))"
        . "ORDER BY `radicacion` ASC;";

//echo($sql);
$consulta = $db->sql_query($sql);

$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', "CODIGO DANE")
        ->setCellValue('B1', "NOMBRE DEL SOLICITANTE")
        ->setCellValue('C1', "DIRECCIÓN")
        ->setCellValue('D1', "TELEFONO")
        ->setCellValue('E1', "SERVICIO")
        ->setCellValue('F1', "RADICADO DE RECIBIDO")
        ->setCellValue('G1', "FECHA RADICACIÓN")
        ->setCellValue('H1', "TIPO DE TRAMITE")
        ->setCellValue('I1', "CODIGO DE LA CAUSAL")
        ->setCellValue('J1', "DETALLE DE LA CAUSAL OTROS")
        ->setCellValue('K1', "NUMERO DE CUENTA")
        ->setCellValue('L1', "NUMERO IDENTIFICADOR DE LA FACTURA")
        ->setCellValue('M1', "TIPO DE RESPUESTA")
        ->setCellValue('N1', "FECHA DE RESPUESTA")
        ->setCellValue('O1', "RADICADO DE RESPUESTA")
        ->setCellValue('P1', "FECHA DE NOTIFICACION DE EJECUCION")
        ->setCellValue('Q1', "TIPO DE NOTIFICACION")
        ->setCellValue('R1', "FECHA DE TRASLADO A SSPD");

$conteo = 1;
while ($fila = $db->sql_fetchrow($consulta)) {
  $conteo++;
  $respuesta = $respuestas->publica($fila['solicitud']);
  $notificacion = $notificaciones->notificacion_final($fila['solicitud']);
  $traslado = $traslados->solicitud($fila['solicitud']);
  $fila['respuesta'] = $respuesta['respuesta'];
  $fila['contestacion'] = $respuesta['fecha'];
  $fila['factura'] = !empty($fila['factura']) ? $fila['factura'] : "N";
  $fila['telefono'] = !empty($fila['telefono']) ? $fila['telefono'] : "N";
  // Creando la fila
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A'.$conteo, $fila['dane'])
          ->setCellValue('B'.$conteo, $cadenas->capitalizar($fila['nombres'] . " " . $fila['apellidos']))
          ->setCellValue('C'.$conteo, $cadenas->capitalizar($fila['direccion']))
          ->setCellValue('D'.$conteo, $fila['telefono'])
          ->setCellValue('E'.$conteo, $fila['servicio'])
          ->setCellValue('F'.$conteo, strtoupper($fila['radicado']))
          ->setCellValue('G'.$conteo, $fechas->dmy($fila['radicacion']))
          ->setCellValue('H'.$conteo, $fila['categoria'])
          ->setCellValue('I'.$conteo, $fila['causal'])
          ->setCellValue('J'.$conteo, $cadenas->capitalizar($fila['detalle']))
          ->setCellValue('K'.$conteo, $fila['suscriptor'])
          ->setCellValue('L'.$conteo, $fila['factura'])
          ->setCellValue('M'.$conteo, $respuesta['tipo'])
          ->setCellValue('N'.$conteo, $fechas->dmy(@$respuesta['fecha']))
          ->setCellValue('O'.$conteo, strtoupper($respuesta['radicado']))
          ->setCellValue('P'.$conteo, $fechas->dmy(@$notificacion['fecha']))
          ->setCellValue('Q'.$conteo, $notificacion['tipo'])
          ->setCellValue('R'.$conteo, $traslado['fecha']);
}

$db->sql_close();

// Miscellaneous glyphs, UTF-8
$objPHPExcel->getActiveSheet()->setTitle('Planilla Automatica');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="reporte-' . time() . '.xls"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
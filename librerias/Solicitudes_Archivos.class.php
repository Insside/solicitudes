<?php

$ROOT=(!isset($ROOT))?"../../../":$ROOT;
require_once($ROOT."modulos/solicitudes/librerias/Configuracion.cnf.php");
require_once($ROOT."modulos/usuarios/librerias/Configuracion.cnf.php");



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of Archivos
 * @author Alexis
 */

class Solicitudes_Archivos extends Archivos {

  var $transaccion;
  var $sesion;
  var $fechas;
  var $modulos;
  var $usuarios;
  var $permisos;
  var $validaciones;

  function Solicitudes_Archivos() {
    $this->sesion=new Sesion();
    $this->fechas=new Fechas();
    $this->validaciones=new Validaciones();
    $this->transaccion=$this->validaciones->recibir('transaccion');
    $this->usuarios=new Usuarios();

  }

  /**
   * Permite registrar un archivo cargado al sistema relacionalmente con un proveedor.
   * @param type $categoria
   * @param type $nombre
   * @param type $observacion
   * @param type $ruta
   * @param type $tamanno
   */
  public function registrar($datos) {
    $db=new MySQL(Sesion::getConexion());
    $sql="INSERT INTO `solicitudes_archivos` SET ";
    $sql.="`archivo`='".$datos['archivo']."',";
    $sql.="`solicitud`='".$datos['solicitud']."',";
    $sql.="`categoria`='".$datos['categoria']."',";
    $sql.="`nombre`='".$datos['nombre']."',";
    $sql.="`observacion`='".$datos['observacion']."',";
    $sql.="`ruta`='".$datos['ruta']."',";
    $sql.="`aforo`='".$datos['aforo']."',";
    $sql.="`tamanno`='".$datos['tamanno']."',";
    $sql.="`fecha`='".$datos['fecha']."',";
    $sql.="`hora`='".$datos['hora']."',";
    $sql.="`creador`='".$datos['creador']."';";
    $consulta=$db->sql_query($sql);
    echo($sql);
    $db->sql_close();
    return($consulta);
  }

  /**
   * Retorna el HTML corespondiente a un elemento tipo <<select>> el cual contiene el listado de las
   * categorias asignables a los archivos que se adjuntan en el formulario de proveedores
   * */
  function categoria($categoria) {
    $db=new MySQL(Sesion::getConexion());
    $consulta=$db->sql_query("SELECT * FROM `solicitudes_archivos_categorias` WHERE `categoria` = '".$categoria."'");
    $fila=$db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  /**
   * Retorna el HTML corespondiente a un elemento tipo <<select>> el cual contiene el listado de las
   * categorias asignables a los archivos que se adjuntan en el formulario de proveedores
   * */
  function categorias($id,$selected,$class="") {
    if(empty($selected)){
      $selected=isset($_REQUEST['_'.$id])?$_REQUEST['_'.$id]:"";
    }
    $f=new Forms($this->transaccion);
    $html=$f->combo_consulta($id,"nombre","categoria","solicitudes_archivos_categorias",$selected,"",$class);
    return($html);
  }

  /**
   * Permite consultar los datos de un archivo registrado en la tabla <<proveedores_archivos>>, no se relaciona
   * con ningun ancestro conocido asta la fecha
   * @param type $archivo
   * @return type
   */
  function consultar($archivo) {
    $db=new MySQL(Sesion::getConexion());
    $sql="SELECT * FROM `solicitudes_archivos` WHERE `archivo` = '".$archivo."'";
    $consulta=$db->sql_query($sql);
    $fila=$db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  /**
   * Esta funcion implementa el procedimiento necesario para eliminar un archivo relacionado con un proveedor
   * en primera instancia elimina el registro de la tabla correspondiente en la base de datos <<proveedores_archivos>>
   * en segunda instancia elimina el archivo fisicamnete valiendose de la funcion implementada por su
   * ancestro <<Archivos::Eliminar>>
   * @param type $archivo
   * @return type
   */
  function eliminar($archivo) {
    $db=new MySQL(Sesion::getConexion());
    $sql="DELETE FROM `solicitudes_archivos` WHERE `archivo`='".$archivo."';";
    echo($sql);
    $consulta=$db->sql_query($sql);
    $db->sql_close();
    return($consulta);
  }
  
  
  
   function tabla($solicitud,$usuario) {
    $db=new MySQL(Sesion::getConexion());
    $consulta=$db->sql_query("SELECT * FROM `solicitudes_archivos` WHERE `solicitud` = '".$solicitud."' ORDER BY `fecha` DESC, `hora` DESC");
    $html="<table>";
    $html.="<tr>"
            . "<th>Archivo</th>"
            . "<th>Visualizar</th>"
            . "<th>Categoria</th>"
            . "<th>Detalles</th>"
            . "<th>Fecha</th>"
            . "<th>Hora</th>"
            . "<th></th>"
            . "</tr>";
    while($fila=$db->sql_fetchrow($consulta)) {
      $archivo=$this->consultar($fila['archivo']);
      $creador=$archivo['creador'];
      $categoria=$this->categoria($fila['categoria']);
      $html.="<tr>";
      $html.="<td><b>".$fila['archivo']."</b></td>";
      $html.="<td><a href=\"".$fila['ruta']."\" target=\"_blanck\"> ".$categoria['nombre']."</a><i>".$fila['nombre']."</i></td>";
      $html.="<td>".$fila['categoria']."</td><td>".""."</td>";
      $html.="<td>".$fila['fecha']."</td>";
      $html.="<td>".$fila['hora']."</td>";
      if($this->usuarios->permiso("SOLICITUDES-ARCHIVOS-ELIMINAR-TODOS",$usuario)){
        $html.="<td><a href=\"#\" onClick=\"MUI.Solicitudes_Archivo_Eliminar('".$fila['archivo']."');\"><img src=\"imagenes/16x16/eliminar.png\"></a></td>";
      }elseif($this->usuarios->permiso("SOLICITUDES-ARCHIVOS-ELIMINAR",$usuario)&&($creador==$usuario)){
        $html.="<td><a href=\"#\" onClick=\"MUI.Solicitudes_Archivo_Eliminar('".$fila['archivo']."');\"><img src=\"imagenes/16x16/eliminar.png\"></a></td>";
      }
        $html.="</tr>";
    }
    $html.="</table></div>";
    $db->sql_close();
    return($html);
  }

}

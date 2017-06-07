<?php

$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "librerias/Correo.class.php");
require_once($ROOT . "modulos/solicitudes/librerias/Configuracion.cnf.php");
/**
 * Módulo de Solicitudes - Envio de Mensajes.
 * PHP Version 5
 * @package Insside/modulos/solicitudes/librerias
 * @link www.insside.com
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 * @Copyright Insside (c) <2015>, <Jose Alexis Correa Valencia>
 * @license http://www.insside.com/plataforma/eula.html EULA License
 * */

/**
 * Esta clase a sido diseñada para facilitar el envió de mensajes vía correo 
 * electrónico como notificaciones resultantes de diversos estados, desde la 
 * recepción de nuevas solicitudes hasta el reporte de advertencias o 
 * notificaciones por proximidad al vencimiento de términos o similares.
 * @author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 * */
class Solicitudes_Mensajeria {

  /**
   * Este metodo envia una notificación de recepción y radicación de una 
   * solicitud. Los parametros para su correcta implementación se 
   * describen a continuación.
   * @param string $solicitud codigo de la solicitud que generara los mensajes
   */
  public function solicitud_creada($solicitud) {
    $solicitudes = new Solicitudes();
    $solicitud = $solicitudes->consultar($solicitud);
    $c = new Correo();
    $c->destinatario = array("email" => "jalexiscv@gmail.com", "alias" => "Jose Alexis Correa");
    $c->asunto = "Solicitud Creada -" . $solicitud["solicitud"];
    $c->mensaje = $this->encabezado();
    $c->mensaje.= "Solicitud Creada" . $solicitud["solicitud"];
    $c->mensaje.=$this->recomensaciones();
    $c->Gmail();
    return($c->enviar());
  }

  private function encabezado() { 
    $texto = ""
            . "<img src=\"http://www.insside.com/plataforma/sites/default/files/archivos/insside-encabezado.png\">"
            . "<p style=\"font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:15px;line-height:14px;color:#777\">"
            . "El presente mensaje se genera automáticamente desde Sistema Integral "
            . "de Administración Informática (<a href=\"http://www.insside.com/\">IMIS</a>) "
            . "y corresponde información radicada, gestionada o procesada en el mismo "
            . "y que se considera es de su interés o competencia en términos de respaldo, "
            . "constancia, notificación o advertencia. Para mayor información lea "
            . "y analice el contenido textualmente enunciado en el presente mensaje."
            . "<br>-----------------------------------------------------------"
            . "</p>";
    return($texto);
  }

  private function recomensaciones() {
    $texto = ""
            . "<p style=\"font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:15px;line-height:14px;color:#777\">"
            . "<br>-----------------------------------------------------------"
            . "<br>Antes de imprimir este mensaje, asegúrate que sea necesario. Proteger"
            . "<br>el medio ambiente está también en tus manos."
            . "<br>-----------------------------------------------------------"
            . "<br>Este mensaje está amparado por la RESERVA PROFESIONAL, conforme al"
            . "<br>artículo 74 de la Constitución Política. Por consiguiente el Código"
            . "<br>Penal prohibe reproducirlo, reenviarlo, divulgarlo o realizar"
            . "<br>cualquier otro uso del mismo, salvo previo PERMISO EXPRESO del"
            . "<br>suscrito consultor legal. Si por error usted recibe este correo, por"
            . "<br>favor, ELIMÍNELO e infórmeme  de esta circunstancia para evitar su"
            . "<br>coparticipación en la infracción penal.</p>"
            . "<img src=\"http://www.insside.com/plataforma/sites/default/files/archivos/insside_0.png\">";
    return($texto);
  }

}

$sm = new Solicitudes_Mensajeria();
$sm->solicitud_creada("1441728185");

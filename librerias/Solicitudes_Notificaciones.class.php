<?php

$ROOT = (!isset($ROOT)) ? "../../" : $ROOT;
require_once($ROOT . "modulos/solicitudes/librerias/Configuracion.cnf.php");

class Solicitudes_Notificaciones {

    var $sesion, $fechas, $tabla;

    function Notificaciones() {
        $this->sesion = new Sesion();
        $this->fechas = new Fechas();
        $this->tabla = "distribucion_instalaciones";
    }

    function insertar($datos) {
        if (is_array($datos)) {
            $datos['notificacion'] = empty($datos['notificacion']) ? time() : $datos['notificacion'];
            $sql['datos'] = $this->evaluar($datos, "notificacion");
            $sql['datos'] .= $this->evaluar($datos, "solicitud");
            $sql['datos'] .= $this->evaluar($datos, "respuesta");
            $sql['datos'] .= $this->evaluar($datos, "tipo");
            $sql['datos'] .= $this->evaluar($datos, "formato");
            $sql['datos'] .= $this->evaluar($datos, "contenido");
            $sql['datos'] .= $this->evaluar($datos, "fecha");
            $sql['datos'] .= $this->evaluar($datos, "hora");
            $sql['datos'] .= $this->evaluar($datos, "estado");
            $sql['datos'] .= $this->evaluar($datos, "radicacion");
            $db = new MySQL(Sesion::getConexion());
            $sql['sql'] = ("INSERT DELAYED  INTO `solicitudes_notificaciones` SET " . $sql['datos'] . "`creador`='" . $datos['creador'] . "';");
            $consulta = $db->sql_query($sql['sql']);
            $db->sql_close();
            echo($sql['sql'] . "<br>");
            return($consulta);
        } else {
            return("Error: Clase: Solictudes Metodo: Crear");
        }
    }

    /**
     * Si el dato evaluado existe su referencia y contenido son reexpresdos para interarse a una estructura sql
     * @param type $vector
     * @param type $dato
     * @return type
     */
    function evaluar($vector, $dato) {
        if (isset($vector[$dato]) && !empty($vector[$dato])) {
            return("`" . $dato . "`='" . $vector[$dato] . "',");
        } else {
            return("");
        }
    }

    function crear($notificacion, $solicitud, $respuesta, $tipo, $formato, $fecha, $hora, $creador) {
        $db = new MySQL(Sesion::getConexion());
        $sql = "INSERT INTO `solicitudes_notificaciones` SET ";
        $sql .= "`notificacion`='" . $notificacion . "',";
        $sql .= "`solicitud`='" . $solicitud . "',";
        $sql .= "`respuesta`='" . $respuesta . "',";
        $sql .= "`tipo`='" . $tipo . "',";
        $sql .= "`formato`='" . $formato . "',";
        $sql .= "`creador`='" . $creador . "',";
        $sql .= "`fecha`='" . $fecha . "',";
        $sql .= "`hora`='" . $hora . "';";
        echo($sql);
        $consulta = $db->sql_query($sql);
        $db->sql_close();
        return($consulta);
    }

    function actualizar($notificacion, $campo, $valor) {
        $db = new MySQL(Sesion::getConexion());
        $sql = "UPDATE `solicitudes_notificaciones` SET ";
        $sql .= "`" . $campo . "`='" . $valor . "'";
        $sql .= " WHERE `notificacion`='" . $notificacion . "';";
        $consulta = $db->sql_query($sql);
        $db->sql_close();
    }

    function eliminar($respuesta) {
        $db = new MySQL(Sesion::getConexion());
        $sql = "DELETE FROM `solicitudes_respuestas` WHERE `respuesta`='" . $respuesta . "';";
        $consulta = $db->sql_query($sql);
        $db->sql_close();
    }

    function consultar($notificacion) {
        $db = new MySQL(Sesion::getConexion());
        $consulta = $db->sql_query("SELECT * FROM `solicitudes_notificaciones` WHERE `notificacion`='" . $notificacion . "' ;");
        $fila = $db->sql_fetchrow($consulta);
        $db->sql_close();
        return($fila);
    }

    /**
     * Retorna la información correspondiente a una tipologia de notificación
     * @param type $tipo
     * @return type
     */
    function formato($tipo) {
        $db = new MySQL(Sesion::getConexion());
        $consulta = $db->sql_query("SELECT * FROM `solicitudes_notificaciones_tipos_formatos` WHERE `tipo`='" . $tipo . "' ;");
        $fila = $db->sql_fetchrow($consulta);
        $db->sql_close();
        return($fila);
    }

    /**
     * Retorna la respuesta asociada a una solicitud
     * @param type $solicitud
     * @return type
     */
    function respuesta($respuesta) {
        $db = new MySQL(Sesion::getConexion());
        $consulta = $db->sql_query("SELECT * FROM `solicitudes_notificaciones` WHERE `respuesta`='" . $respuesta . "' ;");
        $fila = $db->sql_fetchrow($consulta);
        $db->sql_close();
        return($fila);
    }

    function solicitud($solicitud) {
        $db = new MySQL(Sesion::getConexion());
        $consulta = $db->sql_query("SELECT * FROM `solicitudes_notificaciones` WHERE `solicitud`='" . $solicitud . "' ;");
        $fila = $db->sql_fetchrow($consulta);
        $db->sql_close();
        return($fila);
    }

    function estado_notificacion($solicitud) {
        $db = new MySQL(Sesion::getConexion());
        $consulta = $db->sql_query("SELECT * FROM `solicitudes_notificaciones` WHERE `solicitud`='" . $solicitud . "' ;");
        $resultados = $db->sql_fetchrow($consulta);
        $db->sql_close();
        if ($resultados > 0) {
            return("verde");
        } else {
            return("rojo");
        }
    }

    /**
     * 
     */
    function tipos($name, $selected, $clase = "required", $change = "") {
        $db = new MySQL(Sesion::getConexion());
        $acentos = $db->sql_query("SET NAMES 'utf8'");
        $sql = "SELECT * FROM `solicitudes_notificaciones_tipos`  ORDER BY `tipo` ASC";
        $consulta = $db->sql_query($sql);
        $html = ('<select name="' . $name . '"id="' . $name . '" class="' . $clase . '" onChange="' . $change . '">');
        $conteo = 0;
        while ($fila = $db->sql_fetchrow($consulta)) {
            $html .= ('<option value="' . $fila['tipo'] . '"' . (($selected == $fila['tipo']) ? "selected" : "") . '>' . $fila['tipo'] . ": " . $fila['nombre'] . '</option>');
            $conteo++;
        }
        $db->sql_close();
        $html .= ("</select>");
        return($html);
    }

    function tipos_consultar($tipo) {
        $db = new MySQL(Sesion::getConexion());
        $consulta = $db->sql_query("SELECT * FROM `solicitudes_notificaciones_tipos` WHERE `tipo`='" . $tipo . "' ;");
        $fila = $db->sql_fetchrow($consulta);
        $db->sql_close();
        return($fila);
    }

    function formatos($name, $selected, $clase = "required", $change = "") {
        $db = new MySQL(Sesion::getConexion());
        $acentos = $db->sql_query("SET NAMES 'utf8'");
        $sql = "SELECT * FROM `solicitudes_notificaciones_tipos_formatos`  ORDER BY `tipo` ASC";
        $consulta = $db->sql_query($sql);
        $html = ('<select name="' . $name . '"id="' . $name . '" class="' . $clase . '" onChange="' . $change . '">');
        $conteo = 0;
        while ($fila = $db->sql_fetchrow($consulta)) {
            $html .= ('<option value="' . $fila['tipo'] . '"' . (($selected == $fila['tipo']) ? "selected" : "") . '>' . $fila['tipo'] . ": " . $fila['nombre'] . '</option>');
            $conteo++;
        }
        $db->sql_close();
        $html .= ("</select>");
        return($html);
    }

    function formatos_consultar($tipo) {
        $db = new MySQL(Sesion::getConexion());
        $consulta = $db->sql_query("SELECT * FROM `solicitudes_notificaciones_tipos_formatos` WHERE `tipo`='" . $tipo . "' ;");
        $fila = $db->sql_fetchrow($consulta);
        $db->sql_close();
        return($fila);
    }

    function tabla($solicitud) {
        $html = "<table class=\"\">";
        $html .= "<tr>"
                . "<td style=\"width:60px;text-align:center;\">Notificación</td>"
                . "<td style=\"width:30px;text-align:center;\">Tipo</td>"
                . "<td>Detalles</td>"
                . "<td style=\"width:60px;text-align:center;\">Fecha</td>"
                . "<td style=\"width:60px;text-align:center;\">Hora</td>"
                . "</tr>";
        $db = new MySQL(Sesion::getConexion());
        $sql = "SELECT * FROM `solicitudes_notificaciones` WHERE(`solicitud`='" . $solicitud . "') ORDER BY `notificacion`";
        $consulta = $db->sql_query($sql);
        while ($fila = $db->sql_fetchrow($consulta)) {
            $tipo = $this->formato($fila['formato']);
            $fila['detalle'] = "<a href=\"#\" onClick=\"MUI.Solicitudes_Notificacion_Consultar('" . $fila['notificacion'] . "');\">" . $tipo['nombre'] . "</a>";
            $html .= "<tr>"
                    . "<td>" . $fila['notificacion'] . "</td>"
                    . "<td>" . $fila['tipo'] . "</td>"
                    . "<td>" . $fila['detalle'] . "</td>"
                    . "<td style=\"width:60px;text-align:center;\">" . $fila['fecha'] . "</td>"
                    . "<td style=\"width:60px;text-align:center;\">" . $fila['hora'] . "</td>"
                    . "</tr>";
        }
        $db->sql_close();
        $html .= "</table>";
        return($html);
    }

    /**
     * Retorna el listado total de respuestas registradas en la base de datos, como
     * un vector. Por defecto solo retornara las respuestas que figuren como 
     * activas, publicas y esten asociadas a una solicitud especifica la cual se 
     * ha pasado en los parametros.
     * @param String $acceso {ACTIVO,DENEGADO} determina el resultado segun el estado de acceso de las empresas listadas.
     * @return array con el listado de empresas activas.
     */

    public function respuestas($parametros = array()) {
        $solicitud = $parametros["solicitud"];
        $categoria = "PUBLICA";
        $estado = "ACTIVA";
        $db = new MySQL(Sesion::getConexion());
        $solicitudes = array();
        $consulta = $db->sql_query(""
                . "SELECT `respuesta` "
                . "FROM `solicitudes_respuestas` "
                . "WHERE `categoria` ='$categoria' "
                . "AND `estado`='$estado' "
                . "AND `solicitud` ='$solicitud';");
        while ($fila = $db->sql_fetchrow($consulta)) {
            array_push($solicitudes, $fila);
        }
        $db->sql_close();
        return($solicitudes);
    }

    /**
     * Corresponde a la ultima notificacion registrada en sistema para con una solicitud y sus respuestas
     * @param type $notificacion
     * @return type
     */
    function notificacion_final($solicitud) {
        $db = new MySQL(Sesion::getConexion());
        $consulta = $db->sql_query("SELECT * FROM `solicitudes_notificaciones` WHERE `solicitud`='" . $solicitud . "'  ORDER BY `fecha` DESC LIMIT 1;");
        $fila = $db->sql_fetchrow($consulta);
        $db->sql_close();
        return($fila);
    }

}

/** Se deja por compatibilidad * */
class Notificaciones extends Solicitudes_Notificaciones {
    
}

?>
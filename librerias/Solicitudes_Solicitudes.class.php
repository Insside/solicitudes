<?php

if (!class_exists("Solicitudes_Solicitudes")) {

    class Solicitudes_Solicitudes {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "INSERT INTO `solicitudes_solicitudes` SET "
                        . "`solicitud`='" . $datos['solicitud'] . "',"
                        . "`dane`='" . $datos['dane'] . "',"
                        . "`servicio`='" . $datos['servicio'] . "',"
                        . "`radicado`='" . $datos['radicado'] . "',"
                        . "`radicacion`='" . $datos['radicacion'] . "',"
                        . "`categoria`='" . $datos['categoria'] . "',"
                        . "`trasferido`='" . $datos['trasferido'] . "',"
                        . "`causal`='" . $datos['causal'] . "',"
                        . "`asunto`='" . $datos['asunto'] . "',"
                        . "`detalle`='" . $datos['detalle'] . "',"
                        . "`suscriptor`='" . $datos['suscriptor'] . "',"
                        . "`factura`='" . $datos['factura'] . "',"
                        . "`notificado`='" . $datos['notificado'] . "',"
                        . "`notificacion`='" . $datos['notificacion'] . "',"
                        . "`sspd`='" . $datos['sspd'] . "',"
                        . "`ejecucion`='" . $datos['ejecucion'] . "',"
                        . "`orden`='" . $datos['orden'] . "',"
                        . "`fecha`='" . $datos['fecha'] . "',"
                        . "`nombres`='" . $datos['nombres'] . "',"
                        . "`apellidos`='" . $datos['apellidos'] . "',"
                        . "`documentos`='" . $datos['documentos'] . "',"
                        . "`identificacion`='" . $datos['identificacion'] . "',"
                        . "`nacimiento`='" . $datos['nacimiento'] . "',"
                        . "`sexo`='" . $datos['sexo'] . "',"
                        . "`telefono`='" . $datos['telefono'] . "',"
                        . "`movil`='" . $datos['movil'] . "',"
                        . "`correo`='" . $datos['correo'] . "',"
                        . "`pais`='" . $datos['pais'] . "',"
                        . "`region`='" . $datos['region'] . "',"
                        . "`ciudad`='" . $datos['ciudad'] . "',"
                        . "`sector`='" . $datos['sector'] . "',"
                        . "`direccion`='" . $datos['direccion'] . "',"
                        . "`referencia`='" . $datos['referencia'] . "',"
                        . "`expiracion`='" . $datos['expiracion'] . "',"
                        . "`instalacion`='" . $datos['instalacion'] . "',"
                        . "`estrato`='" . $datos['estrato'] . "',"
                        . "`diametro`='" . $datos['diametro'] . "',"
                        . "`legalizado`='" . $datos['legalizado'] . "',"
                        . "`matricula`='" . $datos['matricula'] . "',"
                        . "`aforado`='" . $datos['aforado'] . "',"
                        . "`creador`='" . $datos['creador'] . "',"
                        . "`responsable`='" . $datos['responsable'] . "',"
                        . "`origen`='" . $datos['origen'] . "',"
                        . "`equipo`='" . $datos['equipo'] . "',"
                        . "`credito`='" . $datos['credito'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Solicitudes_Solicitudes::crear se esperaba un vector.");
            }
        }

        public function actualizar($solicitud, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `solicitudes_solicitudes` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `solicitud`='" . $solicitud . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($solicitud) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `solicitudes_solicitudes` "
                    . "WHERE `solicitud`='" . $solicitud . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($solicitud) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `solicitudes_solicitudes` "
                    . "WHERE `solicitud`='" . $solicitud . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }
        
        /**
         * Retorna los datos de una solicitud realizando una consulta que tiene
         * por parametro un numero de matricula, se asocia esta clase de consulta
         * con las legalizaciones realizadas.
         * @param type $matricula
         * @return type
         */
        public function getByMatricula($matricula) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `solicitudes_solicitudes` "
                    . "WHERE `matricula`='" . $matricula . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

    }

}
?>
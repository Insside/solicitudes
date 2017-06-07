<?php

if (!class_exists("Solicitudes_Respuestas")) {

    class Solicitudes_Respuestas {

        public function crear($datos = array()) {
            if (is_array($datos)) {
                $db = new MySQL(Sesion::getConexion());
                $sql = "INSERT INTO `solicitudes_respuestas` SET "
                        . "`respuesta`='" . $datos['respuesta'] . "',"
                        . "`solicitud`='" . $datos['solicitud'] . "',"
                        . "`tipo`='" . $datos['tipo'] . "',"
                        . "`formato`='" . $datos['formato'] . "',"
                        . "`radicado`='" . $datos['radicado'] . "',"
                        . "`orden`='" . $datos['orden'] . "',"
                        . "`cobro`='" . $datos['cobro'] . "',"
                        . "`detalle`='" . $datos['detalle'] . "',"
                        . "`fecha`='" . $datos['fecha'] . "',"
                        . "`hora`='" . $datos['hora'] . "',"
                        . "`creador`='" . $datos['creador'] . "',"
                        . "`categoria`='" . $datos['categoria'] . "',"
                        . "`estado`='" . $datos['estado'] . "'"
                        . ";";
                $db->sql_query($sql);
                $db->sql_close();
            } else {
                echo("Error: Solicitudes_Respuestas::crear se esperaba un vector.");
            }
        }

        public function actualizar($respuesta, $campo, $valor) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "UPDATE `solicitudes_respuestas` "
                    . "SET `" . $campo . "`='" . $valor . "' "
                    . "WHERE `respuesta`='" . $respuesta . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function eliminar($respuesta) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "DELETE FROM `solicitudes_respuestas` "
                    . "WHERE `respuesta`='" . $respuesta . "';";
            $db->sql_query($sql);
            $db->sql_close();
        }

        public function consultar($respuesta) {
            $db = new MySQL(Sesion::getConexion());
            $sql = "SELECT * FROM `solicitudes_respuestas` "
                    . "WHERE `respuesta`='" . $respuesta . "';";
            $consulta = $db->sql_query($sql);
            $fila = $db->sql_fetchrow($consulta);
            $db->sql_close();
            return($fila);
        }

    }

}
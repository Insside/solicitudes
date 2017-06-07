<?php

$ROOT = (!isset($ROOT)) ? "../../../" : $ROOT;
require_once($ROOT . "modulos/solicitudes/librerias/Configuracion.cnf.php");
if (isset($_REQUEST["usuario"]) && !empty($_REQUEST["usuario"])) {
    $usuario = $_REQUEST["usuario"];
    /** Importar Archivo JSON de las Solicitudes * */
    $ss = new Solicitudes();
    $archivo = "http://www.insside.com/framework/modulos/solicitudes/utilidades/" . $usuario . "-solicitudes.json";
    $solicitudes = json_decode(file_get_contents($archivo));
    foreach ($solicitudes as $solicitud) {
        $datos = array();
        $datos['solicitud'] = $solicitud->solicitud;
        $datos['dane'] = $solicitud->dane;
        $datos['servicio'] = $solicitud->servicio;
        $datos['radicado'] = $solicitud->radicado;
        $datos['radicacion'] = $solicitud->radicacion;
        $datos['categoria'] = $solicitud->categoria;
        $datos['trasferido'] = $solicitud->trasferido;
        $datos['causal'] = $solicitud->causal;
        $datos['asunto'] = $solicitud->asunto;
        $datos['detalle'] = $solicitud->detalle;
        $datos['suscriptor'] = $solicitud->suscriptor;
        $datos['factura'] = $solicitud->factura;
        $datos['notificado'] = $solicitud->notificado;
        $datos['notificacion'] = $solicitud->notificacion;
        $datos['sspd'] = $solicitud->sspd;
        $datos['ejecucion'] = $solicitud->ejecucion;
        $datos['orden'] = $solicitud->orden;
        $datos['fecha'] = $solicitud->fecha;
        $datos['nombres'] = $solicitud->nombres;
        $datos['apellidos'] = $solicitud->apellidos;
        $datos['documentos'] = $solicitud->documentos;
        $datos['identificacion'] = $solicitud->identificacion;
        $datos['nacimiento'] = $solicitud->nacimiento;
        $datos['sexo'] = $solicitud->sexo;
        $datos['telefono'] = $solicitud->telefono;
        $datos['movil'] = $solicitud->movil;
        $datos['correo'] = $solicitud->correo;
        $datos['pais'] = $solicitud->pais;
        $datos['region'] = $solicitud->region;
        $datos['ciudad'] = $solicitud->ciudad;
        $datos['sector'] = $solicitud->sector;
        $datos['direccion'] = $solicitud->direccion;
        $datos['referencia'] = $solicitud->referencia;
        $datos['expiracion'] = $solicitud->expiracion;
        $datos['instalacion'] = $solicitud->instalacion;
        $datos['estrato'] = $solicitud->estrato;
        $datos['diametro'] = $solicitud->diametro;
        $datos['legalizado'] = $solicitud->legalizado;
        $datos['matricula'] = $solicitud->matricula;
        $datos['aforado'] = $solicitud->aforado;
        $datos['creador'] = $solicitud->creador;
        $datos['responsable'] = $solicitud->responsable;
        $datos['origen'] = $solicitud->origen;
        $datos['equipo'] = $solicitud->equipo;
        $datos['credito'] = $solicitud->credito;
        $ss->crear($datos);
    }
    /** Importar Archivo JSON de las Respuestas * */
    $sr = new solicitudes_respuestas();
    $archivo = "http://www.insside.com/framework/modulos/solicitudes/utilidades/" . $usuario . "-respuestas.json";
    $respuestas = json_decode(file_get_contents($archivo));
    foreach ($respuestas as $respuesta) {
        $datos = array();
        $datos['respuesta'] = $respuesta->respuesta;
        $datos['solicitud'] = $respuesta->solicitud;
        $datos['tipo'] = $respuesta->tipo;
        $datos['formato'] = $respuesta->formato;
        $datos['radicado'] = $respuesta->radicado;
        $datos['orden'] = $respuesta->orden;
        $datos['cobro'] = $respuesta->cobro;
        $datos['detalle'] = $respuesta->detalle;
        $datos['fecha'] = $respuesta->fecha;
        $datos['hora'] = $respuesta->hora;
        $datos['creador'] = $respuesta->creador;
        $datos['categoria'] = $respuesta->categoria;
        $datos['estado'] = $respuesta->estado;
        $sr->crear($datos);
    }
    /** Importar Archivo JSON de las Notificaciones * */
    $sn = new Solicitudes_Notificaciones();
    $archivo = "http://www.insside.com/framework/modulos/solicitudes/utilidades/" . $usuario . "-notificaciones.json";
    $notificaciones = json_decode(file_get_contents($archivo));
    foreach ($notificaciones as $notificacion) {
        $datos = array();
        $datos['notificacion'] = $notificacion->notificacion;
        $datos['solicitud'] = $notificacion->solicitud;
        $datos['respuesta'] = $notificacion->respuesta;
        $datos['radicacion'] = $notificacion->radicacion;
        $datos['tipo'] = $notificacion->tipo;
        $datos['formato'] = $notificacion->formato;
        $datos['contenido'] = $notificacion->contenido;
        $datos['fecha'] = $notificacion->fecha;
        $datos['hora'] = $notificacion->hora;
        $datos['creador'] = $notificacion->creador;
        $datos['estado'] = $notificacion->estado;
        $sn->insertar($datos);
    }
    /** Importar Archivo JSON de las Archivos * */
    $sa = new Solicitudes_Archivos();
    $archivo = "http://www.insside.com/framework/modulos/solicitudes/utilidades/".$usuario."-archivos.json";
    $notificaciones = json_decode(file_get_contents($archivo));
    foreach ($notificaciones as $notificacion) {
        $datos = array();
        $datos['archivo'] = $notificacion->archivo;
        $datos['solicitud'] = $notificacion->solicitud;
        $datos['categoria'] = $notificacion->categoria;
        $datos['aforo'] = $notificacion->aforo;
        $datos['nombre'] = $notificacion->nombre;
        $datos['observacion'] = $notificacion->observacion;
        $datos['ruta'] = $notificacion->ruta;
        $datos['tamanno'] = $notificacion->tamanno;
        $datos['fecha'] = $notificacion->fecha;
        $datos['hora'] = $notificacion->hora;
        $datos['creador'] = $notificacion->creador;
        $sa->registrar($datos);
    }
} else {
    echo("se requiere un usuario.");
}
?>

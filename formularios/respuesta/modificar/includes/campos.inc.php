<?php
/** Campos 1*/
$f->campos['solicitud']=$f->getText(array("id"=>"solicitud","value"=>$valores['solicitud'],"size"=>"10","class"=>"required codigo","readonly"=>true));
$f->campos['solicitud-suscriptor']=$f->campo("solicitud_suscriptor",$solicitud['suscriptor'],"");
$f->campos['solicitud-radicado']=$f->campo("solicitud_radicacion",$solicitud['radicado'],"");
$f->campos['solicitud-radicacion']=$f->campo("solicitud_radicacion",$solicitud['radicacion'],"");
$f->campos['suscriptor-nombre']=$f->campo("suscriptor_nombre",$cadenas->capitalizar($suscriptor['nombres']." ".$suscriptor['apellidos']),"");
$f->campos['suscriptor-direccion']=$f->campo("suscriptor_direccion",$cadenas->capitalizar($suscriptor['direccion']." ".$suscriptor['referencia']),"");
/** Campos 2*/
$f->campos['respuesta']=$f->dynamic(array("field"=>"respuesta","value"=>$valores["respuesta"],"readonly"=>true,"class"=>"automatico"));
$f->campos['tipo'] = $respuestas->tipos("tipo", $valores['tipo']);
$f->campos['formato'] = $formatos->combo("formato","");
$f->campos['radicado']=$f->text("radicado",$valores['radicado'], "20","required", false);
$f->campos['fecha']=$f->calendario("fecha",$valores['fecha'],"0","1");
$f->campos['hora']=$f->text("hora",$valores['hora'], "8","required automatico", true);
$f->campos['creador']=$f->text("creador",$valores['creador'], "10","required", true,true);
$f->campos['categoria'] = $respuestas->categorias($valores['categoria'],"w100px");
$f->campos['estado']=$f->text("estado",$valores['estado'], "128","", true);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit","Modificar");
$f->campos['detalle'] = $f->getTextArea(array("id"=>"detalle".$f->id,"value"=>urldecode($valores['detalle']),"pattern"=>"rtf","rtf"=>true,"readonly"=>false,"class"=>"h250px"));
?>
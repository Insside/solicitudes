<?php
/** Clases Declaradas E Inicializadas * */
$su=new Solicitudes_Usuarios();
$u=$su->consultar($valores['creador']);
$perfil = $su->perfil($u['perfil']);
/** Campos * */
$f->campos['perfil'] = $f->campo("empleado", @$perfil['perfil']);
$f->campos['nombres'] = $f->campo("nombres", @$perfil['nombres']);
$f->campos['apellidos'] = $f->campo("apellidos", @$perfil['apellidos']);
$f->campos['direccion'] = $f->campo("direccion", @$perfil['direccion']);
$f->campos['telefono'] = $f->campo("telefono", @$perfil['telefono']);
$f->campos['correo'] = $f->campo("correo", @$perfil['correo']);
$f->campos['sexo'] = $f->campo("sexo", @$perfil['sexo']);
$f->campos['creado'] = $f->campo("creado", @$perfil['creado']);
$f->campos['actualizado'] = $f->campo("actualizado", @$perfil['actualizado']);
$f->campos['creador'] = $f->campo("creador", @$perfil['creador']);
$f->campos['foto'] ="<img src=\"".@$perfil['foto']."?".time()."\" width=\"200\" height=\"267\"/>";
/** Celdas * */
$f->celdas["perfil"] = $f->celda("Perfil:", $f->campos['perfil']);
$f->celdas["nombres"] = $f->celda("Nombres:", $f->campos['nombres']);
$f->celdas["apellidos"] = $f->celda("Apellidos:", $f->campos['apellidos']);
$f->celdas["direccion"] = $f->celda("Dirección:", $f->campos['direccion']);
$f->celdas["telefono"] = $f->celda("Teléfonos:", $f->campos['telefono']);
$f->celdas["correo"] = $f->celda("Correo Electrónico:", $f->campos['correo']);
$f->celdas["sexo"] = $f->celda("Sexo:", $f->campos['sexo']);
$f->celdas["creado"] = $f->celda("Creado:", $f->campos['creado']);
$f->celdas["actualizado"] = $f->celda("Actualizado:", $f->campos['actualizado']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
$f->celdas["info"] = $f->celda("", "<p>Para todos los efectos que este formato implica, se aclara que la responsabilidad legal recae sobre la versión final del mismo que se imprime o exhibe públicamente en internet o en medio físico con la respectiva firma del jefe del área. La versión accesible  vía internet se define como un elemento público de contenido textual o de referente al adjunto digitalizado de la respuesta física emitida. Donde ya sea el adjunto digitalizado de la respuesta o la respuesta textual poseen una validez legal.</p>");
/** Filas **/
$f->fila['sf1']=$f->fila($f->celdas["info"]);
$f->fila['sf2']=$f->fila($f->celdas["perfil"]);
$f->fila['sf3']=$f->fila($f->celdas["nombres"] . $f->celdas["apellidos"]);
$f->fila['sf4']=$f->fila($f->celdas["direccion"].$f->celdas["telefono"]);
$f->fila['sf5']=$f->fila($f->celdas["correo"]);
/** Bloques **/
$f->celdas["foto"] = $f->celda("", $f->campos['foto'],"","w200");
$f->celdas["datos"] = $f->celda("",$f->fila['sf1'].$f->fila['sf2'].$f->fila['sf3'].$f->fila['sf4'].$f->fila['sf5']);
/** Filas * */
$f->fila["creador"] =$f->fila($f->celdas["foto"].$f->celdas["datos"]);
?>
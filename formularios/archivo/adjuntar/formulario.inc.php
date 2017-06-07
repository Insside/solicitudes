<?php
$validaciones = new Validaciones();
$archivos = new Solicitudes_Archivos();
$solicitud = $validaciones->recibir("solicitud");

$f->oculto("solicitud", $_REQUEST['solicitud']);
$html = "<p>En este formulario podrá adjuntar los archivos de la digitalización de los diferentes documentos físicos relacionados con la solicitud. Para adjuntar un documento deberá hacer clic en Adjuntar archivo local-Examinar. Recuerde que “no debe tener el archivo abierto” cuando lo vaya a adjuntar y debe verificar que el archivo esté guardado con un nombre “corto”.</p>";
$f->campos['archivo'] = $f->archivo("archivo" . $f->id, "", "");
$f->campos['categoria'] = $archivos->categorias("categoria", "");
$f->campos['observacion'] = $f->textarea("observacion", "", "textarea", 25, 80, false, false, false, 255);
$f->campos['adjuntar'] = $f->button("adjuntar" . $f->id, "button", "Adjuntar");
// Celdas
$f->celdas['info'] = $f->celda("", $html);
$f->celdas['archivo'] = $f->celda("Archivo a cargar (*.pdf):", $f->campos['archivo']);
$f->celdas['categoria'] = $f->celda("Categoria del archivo a cargar:", $f->campos['categoria']);
$f->celdas['observacion'] = $f->celda("Observación / Comentario:", $f->campos['observacion']);
$f->celdas['siguiente'] = $f->campos['adjuntar'];
// Filas
$f->fila["info"] = $f->fila($f->celdas['info']);
$f->fila["archivo"] = $f->fila($f->celdas['archivo']);
$f->fila["categoria"] = $f->fila($f->celdas['categoria']);
$f->fila["observacion"] = $f->fila($f->celdas['observacion']);
//Compilacion
$f->filas($f->fila['info']);
$f->filas($f->fila['categoria']);
$f->filas($f->fila['archivo']);
$f->filas($f->fila["observacion"]);
$f->botones($f->campos['adjuntar'], "inferior-derecha");

$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Adjuntar Archivos\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 390, height: 420});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
?>
<script type="text/javascript">
    if ($('adjuntar<?php echo($f->id); ?>')) {
        $('adjuntar<?php echo($f->id); ?>').addEvent('click', function (e) {
            console.log("Cargando archivo...");
            var uploader = new MUI.Uploader({
                "emulation": false,
                "urlEncoded": false,
                "url": "archivos/index.php",
                "async": false,
                "data": {
                    "modulo": "912",
                    "accion": "solicitud-adjuntos",
                    "transaccion": "<?php echo($f->id); ?>",
                    "solicitud": "<?php echo($solicitud); ?>",
                    "categoria": $('categoria').value,
                    "observacion": $('observacion').value
                },
                "onRequest": function () {
                    //$("photo<?php echo($f->id); ?>").setProperty("src","imagenes/gifs/loader-profile-photo.gif");
                    console.log('Iniciando Upload');
                    $("<?php echo($f->id);?>_spinner").show();
                    $("<?php echo($f->id);?>").hide();
                },
                "onComplete": function (response) {
                    console.log(response);
//                    var datos= JSON.decode(response);
//                    console.log(datos.vista);
//                    $("photo<?php echo($f->id); ?>").setProperty("src",datos.url);
                    //
                    //console.log(response);
                    //console.log('completed');
                    $("<?php echo($f->id);?>_spinner").hide();
                    MUI.closeWindow($('<?php echo($f->ventana);?>')); 
                    MUI.Solicitudes_Solicitud_Consultar('<?php echo($solicitud); ?>');
                },
                "onProgress": function (event, xhr) {
                    if (event.lengthComputable) {
                        var percentComplete = event.loaded / event.total;
                        //console.log('percent completed: ' + percentComplete.toString());
                    } else {
                        //console.log("Unable to compute progress information since the total size is unknown");
                    }
                }
            });
            uploader.addFile("archivo<?php echo($f->id); ?>");
            uploader.send();
        });
    }
</script>
<?php
$ROOT = (!isset($ROOT)) ? "../../../../" : $ROOT;
if(!class_exists('MySQL')) {require_once($ROOT."librerias/Sesion.class.php");}
if(!class_exists('MySQL')) {require_once($ROOT."librerias/MySQL.class.php");}
Sesion::init();
//\\//\\//\\//\\//\\//\\== VERIFICACION DE PERMISOS ==//\\//\\//\\//\\//\\//\
//$permisos->crear("MAPA-SUSCRIPTORES-R","Permite visualizar el geoposicionamiento de las solicitudes.","SISTEMA");
//$permisos->crear("SUSCRIPTORES-PERFILES-R","Permite visualizar el perfil completo de los suscriptores.","SISTEMA");
$estado=false;
$mensajes[]=NULL;
//if($sesion->getValue("MAPA-SUSCRIPTORES-R")&&$sesion->getValue("SUSCRIPTORES-PERFILES-R")){$estado=true;}
$estado=true;
//if(!$estado&&!$sesion->getValue("MAPA-SUSCRIPTORES-R")){$mensajes[0]="Se requiere el permiso <b>MAPA-SUSCRIPTORES-R</b> para utilizar este componente.";}
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
?>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>SOLICITUDES PQRS</title>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="utilidad.js"></script>
<script type="text/javascript">
  var infowindow;
  var map;

  function initialize() {
    var myLatlng = new google.maps.LatLng(3.914272,-76.295423);
    var myOptions = {zoom: 16,center: myLatlng,mapTypeId: google.maps.MapTypeId.ROADMAP}
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    downloadUrl("solicitudes.xml.php", function(data) {
      var markers = data.documentElement.getElementsByTagName("marker");
      for (var i = 0; i < markers.length; i++) {
		var lat=parseFloat(markers[i].getAttribute("lat"));
		var lng=parseFloat(markers[i].getAttribute("lng"));
        var latlng = new google.maps.LatLng(lat,lng);
        var marker = createMarker(markers[i],latlng);
       }
     });
  }

  function createMarker(datos, latlng) {
	 var icono = '../../../../imagenes/mapas/petroglyphs.png';
    var marker = new google.maps.Marker({position: latlng, map: map,icon:icono});
    google.maps.event.addListener(marker, "click", function() {
      if (infowindow) infowindow.close();
      infowindow = new google.maps.InfoWindow({content:html(marker,datos)});
      infowindow.open(map, marker);
    });
    return marker;
  }



function html(marker,datos) {
	var estado=datos.getAttribute("estado");
	var notificacion=datos.getAttribute("notificacion");
	var identificacion=datos.getAttribute("identificacion");
	var nombres=datos.getAttribute("nombres");
	var apellidos=datos.getAttribute("apellidos");
	var direccion=datos.getAttribute("direccion");
	var telefono=datos.getAttribute("telefono");
	var movil=datos.getAttribute("movil");
	
  var html  = '<div class="informacion"><img src="../../../imagenes/iconos/mapa-suscriptor.gif" align="left"/>';
   html +="<b>Identificación</b>:"+identificacion+"</br>";
	  html +="<b>Nombre</b>:"+nombres+" "+apellidos+"</br>";
	  html +="<b>Dirección</b>:"+direccion+"</br>";
	  html += '<b>Opciones</b>: <a href="#">Perfil</a> | <a href="#">Solicitudes</a>';
	  if(notificacion==""){
	  html += '</br><a href="#" onClick="agendado(\''+estado+'\',\''+""+'\');">Agendar Notificación De Levantamiento</a></div>';
	  }
  return html;
}

function agendado(estado,marker){
	parent.Demo.Medidores_Estado_Notificacion_Crear(estado);
	//alert(marker);
	//var icono = '../icons/agendado.png';
	//marker.setIcon(icono);
}








</script>
<style>
.informacion{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	width: 320px;
}
</style>
</head>
<body onLoad="initialize()">
  <div id="map_canvas" style="width:100%; height:100%"></div>
  
</body>
</html>

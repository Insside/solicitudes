<?php
$criterio=Request::getValue("criterio");
$valor=Request::getValue("valor");
$inicial=Request::getValue("fechainicial");
$final=Request::getValue("fechafinal");
$f->JavaScript("MUI.Solicitudes_Propias_Busqueda('".$criterio."','".$valor."','".$inicial."','".$final."');");
?>
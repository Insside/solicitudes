<?php

if (!class_exists('Solicitudes_Usuarios')) {
    if (!class_exists('Usuarios')) {
        require_once($ROOT . "modulos/usuarios/librerias/Usuarios.class.php");
    }

    class Solicitudes_Usuarios extends Usuarios {
        
    }

}
?>
<?php
   $modulo = $modulos->crear("912", "Solicitudes", "Módulo PQR", "");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-MODULO-A", "Acceso Modulo De Usuarios", "Permite acceder al modulo Usuarios.", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPONSABILIZABLE", "Acceso Modulo De Usuarios", "Permite acceder al modulo Usuarios.", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-ACTUALIZAR", "Permite actualizar (editar) respuestas propias", "Este permiso le permite eliminar las respuesta a solicitudes que hayan sido creadas por el propio usuario. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-ACTUALIZAR-TODAS", "Permite actualizar (editar) cualquier respuesta", "Este permiso le permite eliminar las respuesta a solicitudes que hayan sido creadas por el propio usuario. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-ELIMINAR", "Eliminar respuestas propias", "Este permiso le permite eliminar las respuesta a solicitudes que hayan sido creadas por el propio usuario. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-ELIMINAR-TODAS", "Eliminar cualquier respuesta", "Este permiso le permite eliminar cualquier respuesta existente en una determinada solicitud registrada en el sistema, ya sea de la autoría del propio usuario o cualquier otro. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-FORMATOS-ELIMINAR", "Eliminar formatos / plantillas propios", "Este permiso le permite eliminar los formatos o plantillas que hayan sido creadas por el propio usuario. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-FORMATOS-ELIMINAR-TODOS", "Eliminar cualquier formato / plantilla seleccionado", "Este permiso le permite eliminar los formatos o plantillas que que hayan sido creadas por cualquier usuario. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPONDER", "Permite generar respuestas internas", "Este permiso le permite dar respuesta a una solicitud y marcar la respuesta como interna es decir que no sera direcctamente accesible por el solicitante o suscriptor. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPONDER-PUBLICAMENTE", "Permite generar respuestas externas", "Este permiso le permite dar respuestas externas es decir aque llas que son visibles publicamente para el suscriptor y/o solicitante.", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-TRASFERIR", "Permite trasferir sus solicitudes de un periodo a otro", "Este permiso le permite dar respuestas externas es decir aque llas que son visibles publicamente para el suscriptor y/o solicitante.", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-TRASFERIR-TODAS", "Permite trasferir cualquier solicitud de un periodo a otro", "Este permiso le permite dar respuestas externas es decir aque llas que son visibles publicamente para el suscriptor y/o solicitante.", "0000000000");



    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-VISUALIZAR", "Permite visualizar la lista de asuntos definidos en las diferentes causales", "SISTEMA");
    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-CREAR", "Permite crear asuntos", "SISTEMA");
    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-ACTUALIZAR", "Permite actualizar la informacion de un asunto, si eres el creador del mismo", "SISTEMA");
    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-ACTUALIZAR-TODO", "Permite actualizar la informacion de cualquier asunto existente", "SISTEMA");
    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-ELIMINAR", "Permite eliminar un asunto, si eres el creador del mismo", "SISTEMA");
    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-ELIMINAR-TODO", "Permite eliminar cualquier asunto existente", "SISTEMA");

    
    
        $this->permisos->permiso_crear("912", "SOLICITUDES-ARCHIVOS-ELIMINAR", "Eliminar archivos propios", "Este permiso le permite eliminar archivos adjuntados a una solicitud registrada en el sistema, solo si usted es quien a adjuntado los mismos. ", "0000000000");
    $this->permisos->permiso_crear("912", "SOLICITUDES-ARCHIVOS-ELIMINAR-TODOS", "Eliminar cualquier archivo", "Este permiso le permite eliminar cualquier archivo adjuntado a una solicitud registrada en el sistema, ya sea de la autoría del propio usuario o cualquier otro. ", "0000000000");

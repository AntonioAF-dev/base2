<?php
// Rutas del sistema
define('BASE_URL', 'http://localhost/capacitaciones/public/');
define('BASE_PATH', dirname(__DIR__) . '/');

// Estados del sistema
define('ESTADO_ACTIVO', 'ACTIVO');
define('ESTADO_INACTIVO', 'INACTIVO');
define('ESTADO_PENDIENTE', 'PENDIENTE');
define('ESTADO_COMPLETADO', 'COMPLETADO');
define('ESTADO_CANCELADO', 'CANCELADO');

// Tipos de mensajes
define('MSG_EXITO', 'success');
define('MSG_ERROR', 'error');
define('MSG_INFO', 'info');
define('MSG_ALERTA', 'warning');

// Roles de usuario
define('ROL_ADMIN', 'Administrador');
define('ROL_PROFESOR', 'Profesor');
define('ROL_ESTUDIANTE', 'Estudiante');
?>
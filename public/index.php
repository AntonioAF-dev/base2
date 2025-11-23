<?php
// Mostrar errores en desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión
session_start();

// Verificar y cargar configuración
$constantsPath = __DIR__ . '/../config/constants.php';

if (!file_exists($constantsPath)) {
    die("<h1>Error de Configuración</h1>
         <p>No se encuentra el archivo: <strong>config/constants.php</strong></p>
         <p>Ruta esperada: <code>{$constantsPath}</code></p>
         <p>Por favor, crea el archivo con el contenido proporcionado.</p>");
}

require_once $constantsPath;

// Obtener página y acción
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Routing del sistema
try {
    switch ($page) {
        case 'home':
            $homePath = __DIR__ . '/../views/home.php';
            if (file_exists($homePath)) {
                require_once $homePath;
            } else {
                throw new Exception("No se encuentra el archivo: views/home.php");
            }
            break;
            
        case 'vistas':
            require_once __DIR__ . '/../controllers/VistaController.php';
            $controller = new VistaController();
            $controller->index();
            break;
            
        case 'cursos':
            require_once __DIR__ . '/../controllers/CursoController.php';
            $controller = new CursoController();
            
            switch ($action) {
                case 'crear':
                    $controller->crear();
                    break;
                case 'buscar':
                    $controller->buscar();
                    break;
                case 'validar':
                    $controller->validarDisponibilidad();
                    break;
                default:
                    $controller->index();
            }
            break;
            
        case 'inscripciones':
            require_once __DIR__ . '/../controllers/InscripcionController.php';
            $controller = new InscripcionController();
            
            switch ($action) {
                case 'actualizar':
                    $controller->actualizar();
                    break;
                case 'buscar':
                    $controller->buscar();
                    break;
                case 'mensaje':
                    $controller->obtenerMensajeEstado();
                    break;
                default:
                    $controller->index();
            }
            break;
            
        case 'pagos':
            require_once __DIR__ . '/../controllers/PagoController.php';
            $controller = new PagoController();
            
            switch ($action) {
                case 'eliminar':
                    $controller->eliminar();
                    break;
                case 'buscar':
                    $controller->buscar();
                    break;
                case 'descuento':
                    $controller->calcularDescuento();
                    break;
                default:
                    $controller->index();
            }
            break;
            
        case 'estudiantes':
            require_once __DIR__ . '/../controllers/EstudianteController.php';
            $controller = new EstudianteController();
            
            switch ($action) {
                case 'crear':
                    $controller->crear();
                    break;
                default:
                    $controller->index();
            }
            break;
            
        case 'notas':
            require_once __DIR__ . '/../controllers/NotaController.php';
            $controller = new NotaController();
            
            switch ($action) {
                case 'buscar':
                    $controller->buscar();
                    break;
                default:
                    $controller->index();
            }
            break;
            
        case 'funciones':
            require_once __DIR__ . '/../controllers/FuncionController.php';
            $controller = new FuncionController();
            $controller->index();
            break;
            
        default:
            require_once __DIR__ . '/../views/home.php';
    }
    
} catch (Exception $e) {
    echo "<div style='background:#f8d7da; color:#721c24; padding:20px; margin:20px; border:1px solid #f5c6cb; border-radius:5px;'>";
    echo "<h2>❌ Error del Sistema</h2>";
    echo "<p><strong>Mensaje:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>Archivo:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
    echo "<p><strong>Línea:</strong> " . $e->getLine() . "</p>";
    echo "<hr>";
    echo "<p><small>Verifica que todos los archivos estén en su lugar y que la base de datos esté configurada.</small></p>";
    echo "</div>";
}
?>

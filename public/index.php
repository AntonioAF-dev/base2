<?php
// Mostrar errores en desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión
session_start();

// Cargar configuración
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../includes/middleware.php';

// Inicializar middleware
$middleware = new Middleware();

// Obtener página y acción
$page = $_GET['page'] ?? 'login';
$action = $_GET['action'] ?? 'index';

// Páginas públicas (no requieren autenticación)
$publicPages = ['login', 'registro'];

// Si no está en página pública y no está autenticado, redirigir a login
if (!in_array($page, $publicPages) && !isset($_SESSION['logged_in'])) {
    header('Location: index.php?page=login');
    exit;
}

// Routing del sistema
try {
    switch ($page) {
        // ==================== AUTENTICACIÓN ====================
        case 'login':
            require_once __DIR__ . '/../controllers/AuthController.php';
            $controller = new AuthController();
            
            if ($action === 'process') {
                $controller->processLogin();
            } else {
                $controller->showLogin();
            }
            break;
            
        case 'logout':
            require_once __DIR__ . '/../controllers/AuthController.php';
            $controller = new AuthController();
            $controller->logout();
            break;
            
        case 'dashboard':
            require_once __DIR__ . '/../controllers/AuthController.php';
            $controller = new AuthController();
            $controller->dashboard();
            break;
        
        // ==================== GESTIÓN DE USUARIOS ====================
        case 'usuarios':
            require_once __DIR__ . '/../controllers/UsuarioController.php';
            $controller = new UsuarioController();
            
            switch ($action) {
                case 'crear':
                    $controller->crear();
                    break;
                case 'editar':
                    $controller->editar();
                    break;
                case 'cambiar_password':
                    $controller->cambiarPassword();
                    break;
                case 'eliminar':
                    $controller->eliminar();
                    break;
                default:
                    $controller->index();
            }
            break;
        
        // ==================== VISTAS ====================
        case 'vistas':
            require_once __DIR__ . '/../controllers/VistaController.php';
            $controller = new VistaController();
            $controller->index();
            break;
            
        // ==================== CURSOS ====================
        case 'cursos':
            require_once __DIR__ . '/../controllers/CursoController.php';
            $controller = new CursoController();
            
            switch ($action) {
                case 'crear':
                    // Solo admin y profesores pueden crear cursos
                    $middleware->requireRole(['Administrador', 'Profesor']);
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
            
        // ==================== INSCRIPCIONES ====================
        case 'inscripciones':
            require_once __DIR__ . '/../controllers/InscripcionController.php';
            $controller = new InscripcionController();
            
            switch ($action) {
                case 'inscribirse':
                    // Estudiantes pueden inscribirse
                    $controller->inscribirse();
                    break;
                case 'mis-inscripciones':
                    // Ver solo mis inscripciones
                    $controller->misInscripciones();
                    break;
                case 'actualizar':
                    // Solo admin y profesor pueden actualizar
                    $middleware->requireRole(['Administrador', 'Profesor']);
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
            
        // ==================== PAGOS ====================
        case 'pagos':
            require_once __DIR__ . '/../controllers/PagoController.php';
            $controller = new PagoController();
            
            switch ($action) {
                case 'mis-pagos':
                    // Ver solo mis pagos
                    $controller->misPagos();
                    break;
                case 'eliminar':
                    // Solo admin puede eliminar pagos
                    $middleware->requireRole(['Administrador']);
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
            
        // ==================== ESTUDIANTES ====================
        case 'estudiantes':
            require_once __DIR__ . '/../controllers/EstudianteController.php';
            $controller = new EstudianteController();
            
            switch ($action) {
                case 'crear':
                    // Solo admin puede crear estudiantes
                    $middleware->requireRole(['Administrador']);
                    $controller->crear();
                    break;
                default:
                    $controller->index();
            }
            break;
            
        // ==================== NOTAS ====================
        case 'notas':
            require_once __DIR__ . '/../controllers/NotaController.php';
            $controller = new NotaController();
            
            switch ($action) {
                case 'mis-notas':
                    // Ver solo mis notas
                    $controller->misNotas();
                    break;
                case 'buscar':
                    $controller->buscar();
                    break;
                default:
                    $controller->index();
            }
            break;
            
        // ==================== FUNCIONES ====================
        case 'funciones':
            require_once __DIR__ . '/../controllers/FuncionController.php';
            $controller = new FuncionController();
            $controller->index();
            break;
            
        // ==================== PÁGINA POR DEFECTO ====================
        default:
            require_once __DIR__ . '/../controllers/AuthController.php';
            $controller = new AuthController();
            $controller->dashboard();
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

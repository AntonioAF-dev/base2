<?php
session_start();
require_once __DIR__ . '/../config/database.php';

echo "<h1>🔍 Verificación de Roles y Permisos</h1>";
echo "<style>
    body { font-family: Arial; padding: 20px; background: #f5f7fa; }
    .success { background: #d4edda; color: #155724; padding: 15px; margin: 10px 0; border-radius: 5px; }
    .error { background: #f8d7da; color: #721c24; padding: 15px; margin: 10px 0; border-radius: 5px; }
    .info { background: #d1ecf1; color: #0c5460; padding: 15px; margin: 10px 0; border-radius: 5px; }
    .warning { background: #fff3cd; color: #856404; padding: 15px; margin: 10px 0; border-radius: 5px; }
    table { width: 100%; border-collapse: collapse; background: white; margin: 20px 0; }
    th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
    th { background: #667eea; color: white; }
    .badge { padding: 5px 10px; border-radius: 3px; color: white; font-weight: bold; }
    .admin { background: #28a745; }
    .profesor { background: #17a2b8; }
    .estudiante { background: #6c757d; }
</style>";

// Verificar sesión actual
echo "<h2>📊 Sesión Actual</h2>";
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    echo "<div class='success'>";
    echo "<strong>✅ Usuario Autenticado</strong><br>";
    echo "<strong>ID:</strong> " . ($_SESSION['user_id'] ?? 'N/A') . "<br>";
    echo "<strong>Nombre:</strong> " . htmlspecialchars($_SESSION['user_name'] ?? 'N/A') . "<br>";
    echo "<strong>Email:</strong> " . htmlspecialchars($_SESSION['user_email'] ?? 'N/A') . "<br>";
    echo "<strong>Rol:</strong> <span class='badge " . strtolower($_SESSION['user_role'] ?? '') . "'>" . htmlspecialchars($_SESSION['user_role'] ?? 'N/A') . "</span><br>";
    echo "</div>";
    
    // Verificar navbar según rol
    $rol = $_SESSION['user_role'] ?? '';
    echo "<h3>🎯 Menú Visible para este Rol</h3>";
    echo "<div class='info'>";
    
    if ($rol === 'Administrador') {
        echo "<strong>Administrador ve:</strong><br>";
        echo "✅ Dashboard<br>";
        echo "✅ Usuarios<br>";
        echo "✅ Vistas<br>";
        echo "✅ Cursos<br>";
        echo "✅ Inscripciones<br>";
        echo "✅ Pagos<br>";
        echo "✅ Estudiantes<br>";
        echo "✅ Notas<br>";
        echo "✅ Funciones<br>";
    } elseif ($rol === 'Profesor') {
        echo "<strong>Profesor ve:</strong><br>";
        echo "✅ Dashboard<br>";
        echo "✅ Mis Cursos<br>";
        echo "✅ Inscripciones<br>";
        echo "✅ Estudiantes<br>";
        echo "✅ Calificaciones<br>";
        echo "✅ Reportes<br>";
    } elseif ($rol === 'Estudiante') {
        echo "<strong>Estudiante ve:</strong><br>";
        echo "✅ Dashboard<br>";
        echo "✅ Cursos<br>";
        echo "✅ Mis Inscripciones<br>";
        echo "✅ Mis Calificaciones<br>";
        echo "✅ Mis Pagos<br>";
    } else {
        echo "<strong>⚠️ Rol no reconocido:</strong> " . htmlspecialchars($rol);
    }
    
    echo "</div>";
    
} else {
    echo "<div class='warning'>";
    echo "<strong>⚠️ No hay usuario autenticado</strong><br>";
    echo "Por favor, <a href='../public/index.php?page=login'>inicia sesión</a>";
    echo "</div>";
}

// Mostrar todos los usuarios y sus roles
echo "<h2>👥 Todos los Usuarios del Sistema</h2>";

$db = Database::getInstance();
$conn = $db->getConnection();

$query = "SELECT IdUsu, NomUsu, ApeUsu, EmailUsu, RolUsu, FechaRegUsu FROM Usuario ORDER BY RolUsu, IdUsu";
$result = $conn->query($query);

$roles = ['Administrador' => 0, 'Profesor' => 0, 'Estudiante' => 0, 'Otros' => 0];

echo "<table>";
echo "<tr>
        <th>ID</th>
        <th>Nombre Completo</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Fecha Registro</th>
        <th>Probar Login</th>
      </tr>";

while ($user = $result->fetch_assoc()) {
    $rolClass = strtolower($user['RolUsu']);
    
    // Contar roles
    if (isset($roles[$user['RolUsu']])) {
        $roles[$user['RolUsu']]++;
    } else {
        $roles['Otros']++;
    }
    
    echo "<tr>";
    echo "<td>" . $user['IdUsu'] . "</td>";
    echo "<td>" . htmlspecialchars($user['NomUsu'] . ' ' . $user['ApeUsu']) . "</td>";
    echo "<td>" . htmlspecialchars($user['EmailUsu']) . "</td>";
    echo "<td><span class='badge $rolClass'>" . htmlspecialchars($user['RolUsu']) . "</span></td>";
    echo "<td>" . $user['FechaRegUsu'] . "</td>";
    echo "<td><a href='../public/index.php?page=login' style='color: #667eea;'>Probar →</a></td>";
    echo "</tr>";
}

echo "</table>";

// Estadísticas de roles
echo "<h2>📊 Estadísticas de Roles</h2>";
echo "<div style='display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;'>";

foreach ($roles as $rol => $cantidad) {
    if ($cantidad > 0) {
        $badgeClass = strtolower($rol);
        echo "<div style='background: white; padding: 20px; border-radius: 10px; text-align: center;'>";
        echo "<span class='badge $badgeClass' style='font-size: 1.2em;'>$rol</span><br><br>";
        echo "<strong style='font-size: 2em;'>$cantidad</strong><br>";
        echo "<small>usuarios</small>";
        echo "</div>";
    }
}

echo "</div>";

// Matriz de permisos
echo "<h2>🔒 Matriz de Permisos por Rol</h2>";
echo "<table>";
echo "<tr>
        <th>Acción</th>
        <th>Administrador</th>
        <th>Profesor</th>
        <th>Estudiante</th>
      </tr>";

$permisos = [
    'Ver Dashboard' => ['✅', '✅', '✅'],
    'Gestionar Usuarios' => ['✅', '❌', '❌'],
    'Ver Vistas' => ['✅', '✅', '❌'],
    'Crear Cursos' => ['✅', '✅', '❌'],
    'Ver Todos los Cursos' => ['✅', '✅', '✅'],
    'Ver Todas las Inscripciones' => ['✅', '✅', '❌'],
    'Ver Solo Mis Inscripciones' => ['✅', '✅', '✅'],
    'Gestionar Pagos' => ['✅', '❌', '❌'],
    'Ver Mis Pagos' => ['✅', '❌', '✅'],
    'Calificar Estudiantes' => ['✅', '✅', '❌'],
    'Ver Mis Notas' => ['✅', '❌', '✅'],
    'Usar Funciones del Sistema' => ['✅', '❌', '❌'],
];

foreach ($permisos as $accion => $roles_permisos) {
    echo "<tr>";
    echo "<td><strong>$accion</strong></td>";
    foreach ($roles_permisos as $permiso) {
        $color = $permiso === '✅' ? '#28a745' : '#dc3545';
        echo "<td style='text-align: center; color: $color; font-size: 1.5em;'>$permiso</td>";
    }
    echo "</tr>";
}

echo "</table>";

// Prueba de navbar
echo "<h2>🎨 Prueba Visual del Navbar</h2>";
echo "<div class='info'>";
echo "<p>El navbar se muestra diferente según el rol del usuario logueado:</p>";
echo "<ul>";
echo "<li><strong>Administrador:</strong> Ve todos los módulos</li>";
echo "<li><strong>Profesor:</strong> Ve solo cursos, inscripciones, estudiantes y calificaciones</li>";
echo "<li><strong>Estudiante:</strong> Ve solo cursos disponibles, sus inscripciones, notas y pagos</li>";
echo "</ul>";
echo "</div>";

// Verificar archivo navbar
$navbarPath = __DIR__ . '/../views/layout/navbar.php';
echo "<h3>📄 Verificación del Archivo Navbar</h3>";
if (file_exists($navbarPath)) {
    echo "<div class='success'>✅ El archivo navbar.php existe</div>";
    
    $navbarContent = file_get_contents($navbarPath);
    
    // Verificar que tiene la lógica de roles
    if (strpos($navbarContent, '$userRole') !== false) {
        echo "<div class='success'>✅ El navbar tiene lógica de roles implementada</div>";
    } else {
        echo "<div class='error'>❌ El navbar NO tiene lógica de roles</div>";
    }
    
    if (strpos($navbarContent, 'Administrador') !== false) {
        echo "<div class='success'>✅ Tiene menú para Administrador</div>";
    }
    
    if (strpos($navbarContent, 'Profesor') !== false) {
        echo "<div class='success'>✅ Tiene menú para Profesor</div>";
    }
    
    if (strpos($navbarContent, 'Estudiante') !== false) {
        echo "<div class='success'>✅ Tiene menú para Estudiante</div>";
    }
} else {
    echo "<div class='error'>❌ No se encuentra el archivo navbar.php</div>";
}

echo "<hr>";
echo "<div class='info'>";
echo "<h3>🔧 Acciones Recomendadas</h3>";
echo "<ol>";
echo "<li>Verifica que el archivo <code>views/layout/navbar.php</code> esté actualizado</li>";
echo "<li>Cierra sesión y vuelve a iniciar con diferentes usuarios</li>";
echo "<li>Verifica que cada rol vea solo sus opciones correspondientes</li>";
echo "</ol>";
echo "</div>";
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔍 Verificación del Sistema</h1>";

// 1. Verificar estructura de carpetas
echo "<h2>1. Estructura de Carpetas</h2>";
$folders = [
    'config',
    'database',
    'models',
    'controllers',
    'views',
    'views/layout',
    'views/vistas',
    'views/cursos',
    'views/inscripciones',
    'views/pagos',
    'views/estudiantes',
    'views/notas',
    'views/funciones',
    'public',
    'public/css',
    'public/js'
];

foreach ($folders as $folder) {
    $path = __DIR__ . '/../' . $folder;
    if (is_dir($path)) {
        echo "✅ <strong>{$folder}/</strong> existe<br>";
    } else {
        echo "❌ <strong>{$folder}/</strong> NO existe<br>";
    }
}

// 2. Verificar archivos críticos
echo "<h2>2. Archivos Críticos</h2>";
$files = [
    'config/constants.php',
    'config/database.php',
    'public/index.php',
    'views/home.php',
    'views/layout/header.php',
    'views/layout/navbar.php',
    'views/layout/footer.php'
];

foreach ($files as $file) {
    $path = __DIR__ . '/../' . $file;
    if (file_exists($path)) {
        echo "✅ <strong>{$file}</strong> existe<br>";
    } else {
        echo "❌ <strong>{$file}</strong> NO existe<br>";
    }
}

// 3. Probar conexión a base de datos
echo "<h2>3. Conexión a Base de Datos</h2>";
try {
    $conn = new mysqli('localhost', 'root', '', 'SistemaCapacitaciones');
    
    if ($conn->connect_error) {
        echo "❌ Error de conexión: " . $conn->connect_error . "<br>";
    } else {
        echo "✅ Conexión exitosa a la base de datos<br>";
        
        // Verificar tablas
        $result = $conn->query("SHOW TABLES");
        $tables = [];
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
        }
        
        echo "<strong>Tablas encontradas:</strong> " . count($tables) . "<br>";
        if (count($tables) > 0) {
            echo "<ul style='column-count: 2;'>";
            foreach ($tables as $table) {
                echo "<li>{$table}</li>";
            }
            echo "</ul>";
        }
        
        $conn->close();
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}

// 4. Información de PHP
echo "<h2>4. Configuración de PHP</h2>";
echo "✅ Versión de PHP: <strong>" . phpversion() . "</strong><br>";
echo "✅ mysqli disponible: <strong>" . (extension_loaded('mysqli') ? 'Sí' : 'No') . "</strong><br>";

// 5. Conclusión
echo "<hr>";
echo "<h2>✅ Siguiente Paso</h2>";
echo "<p>Si todo está en verde arriba, accede a:</p>";
echo "<p><a href='index.php' style='display:inline-block; padding:10px 20px; background:#667eea; color:white; text-decoration:none; border-radius:5px;'>Ir al Sistema</a></p>";
?>
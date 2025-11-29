<?php
require_once __DIR__ . '/../config/database.php';

$db = Database::getInstance();
$conn = $db->getConnection();

// Contar usuarios por tipo de contraseña
$query = "SELECT 
    COUNT(*) as Total,
    SUM(CASE WHEN LENGTH(PassUsu) = 60 AND PassUsu LIKE '$2y$%' THEN 1 ELSE 0 END) as Hasheadas,
    SUM(CASE WHEN LENGTH(PassUsu) != 60 OR PassUsu NOT LIKE '$2y$%' THEN 1 ELSE 0 END) as TextoPlano
FROM Usuario";

$result = $conn->query($query);
$stats = $result->fetch_assoc();

$porcentajeHasheadas = ($stats['Hasheadas'] / $stats['Total']) * 100;
$porcentajeTextoPlano = ($stats['TextoPlano'] / $stats['Total']) * 100;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Estado de Migración</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f7fa; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        .stat-box { padding: 20px; margin: 10px 0; border-radius: 5px; }
        .total { background: #d1ecf1; color: #0c5460; }
        .hasheadas { background: #d4edda; color: #155724; }
        .texto-plano { background: #fff3cd; color: #856404; }
        .progress-bar { width: 100%; height: 30px; background: #e9ecef; border-radius: 15px; overflow: hidden; margin: 20px 0; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, #28a745, #20c997); transition: width 0.3s; }
        .stat-number { font-size: 2em; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Estado de Migración de Contraseñas</h1>
        
        <div class="stat-box total">
            <h2>Total de Usuarios</h2>
            <div class="stat-number"><?php echo number_format($stats['Total']); ?></div>
        </div>
        
        <div class="stat-box hasheadas">
            <h2>✅ Contraseñas Hasheadas (Seguras)</h2>
            <div class="stat-number"><?php echo number_format($stats['Hasheadas']); ?></div>
            <p><?php echo number_format($porcentajeHasheadas, 2); ?>% del total</p>
        </div>
        
        <div class="stat-box texto-plano">
            <h2>⚠️ Contraseñas en Texto Plano (Pendientes)</h2>
            <div class="stat-number"><?php echo number_format($stats['TextoPlano']); ?></div>
            <p><?php echo number_format($porcentajeTextoPlano, 2); ?>% del total</p>
        </div>
        
        <h2>Progreso de Migración</h2>
        <div class="progress-bar">
            <div class="progress-fill" style="width: <?php echo $porcentajeHasheadas; ?>%;"></div>
        </div>
        <p style="text-align: center;"><?php echo number_format($porcentajeHasheadas, 2); ?>% migrado</p>
        
        <div style="margin-top: 30px; padding: 20px; background: #d1ecf1; border-radius: 5px;">
            <h3>ℹ️ Información</h3>
            <p><strong>Migración automática:</strong> Cada vez que un usuario inicia sesión con contraseña en texto plano, el sistema la hashea automáticamente.</p>
            <p><strong>Sin intervención:</strong> No necesitas hacer nada, el proceso es completamente automático.</p>
            <p><strong>Tiempo estimado:</strong> La mayoría de usuarios activos migrarán en 1-2 meses.</p>
        </div>
    </div>
</body>
</html>
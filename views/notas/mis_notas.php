<?php 
$pageTitle = "Mis Calificaciones";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>📝 Mis Calificaciones</h1>
    <a href="index.php?page=dashboard" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Mis Notas por Curso</h2>
    
    <?php if (count($notas) > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Calificación</th>
                        <th>Clasificación</th>
                        <th>Fecha</th>
                        <th>Evaluación</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalNotas = 0;
                    $sumaNotas = 0;
                    foreach ($notas as $nota): 
                        $totalNotas++;
                        $sumaNotas += $nota['CalifNot'];
                        
                        // Clasificar nota
                        $clasificacion = 'DESAPROBADO';
                        $colorClase = 'error';
                        if ($nota['CalifNot'] >= 18) {
                            $clasificacion = 'EXCELENTE';
                            $colorClase = 'success';
                        } elseif ($nota['CalifNot'] >= 15) {
                            $clasificacion = 'BUENO';
                            $colorClase = 'info';
                        } elseif ($nota['CalifNot'] >= 13) {
                            $clasificacion = 'REGULAR';
                            $colorClase = 'warning';
                        } elseif ($nota['CalifNot'] >= 11) {
                            $clasificacion = 'APROBADO';
                            $colorClase = 'secondary';
                        }
                    ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($nota['TituloCur']); ?></strong></td>
                            <td><strong style="font-size: 1.2em;"><?php echo number_format($nota['CalifNot'], 2); ?></strong></td>
                            <td>
                                <span class="badge badge-<?php echo $colorClase; ?>">
                                    <?php echo $clasificacion; ?>
                                </span>
                            </td>
                            <td><?php echo $nota['FechaCalifNot']; ?></td>
                            <td><?php echo htmlspecialchars($nota['NomEval'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($nota['TipoEval'] ?? 'N/A'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="info-section">
            <h3>📊 Mi Rendimiento</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Total de Evaluaciones:</strong><br>
                    <span style="font-size: 2em;"><?php echo $totalNotas; ?></span>
                </div>
                <div class="info-item">
                    <strong>Promedio General:</strong><br>
                    <span style="font-size: 2em; color: #667eea;">
                        <?php echo $totalNotas > 0 ? number_format($sumaNotas / $totalNotas, 2) : '0.00'; ?>
                    </span>
                </div>
                <div class="info-item">
                    <strong>Nota Más Alta:</strong><br>
                    <span style="font-size: 2em; color: #28a745;">
                        <?php echo $totalNotas > 0 ? number_format(max(array_column($notas, 'CalifNot')), 2) : '0.00'; ?>
                    </span>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <h3>📝 Aún no tienes calificaciones</h3>
            <p>Las calificaciones aparecerán aquí una vez que tus profesores evalúen tus trabajos.</p>
            <a href="index.php?page=inscripciones&action=mis-inscripciones" class="btn btn-primary">Ver Mis Inscripciones</a>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
<?php 
$pageTitle = "Notas";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>📝 Gestión de Notas</h1>
    <a href="index.php?page=notas&action=buscar" class="btn btn-primary">🔍 Buscar Notas</a>
</div>

<div class="card">
    <h2>Todas las Notas</h2>
    <p class="text-muted">Vista: vista_notas_estudiantes</p>
    
    <?php if (count($notas) > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Calificación</th>
                        <th>Fecha</th>
                        <th>Estudiante</th>
                        <th>Email</th>
                        <th>Curso</th>
                        <th>Evaluación</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notas as $nota): ?>
                        <tr>
                            <td><?php echo $nota['IdNot']; ?></td>
                            <td><strong><?php echo number_format($nota['CalifNot'], 2); ?></strong></td>
                            <td><?php echo $nota['FechaCalifNot']; ?></td>
                            <td><?php echo htmlspecialchars($nota['NombreEstudiante']); ?></td>
                            <td><?php echo htmlspecialchars($nota['EmailUsu']); ?></td>
                            <td><?php echo htmlspecialchars($nota['TituloCur']); ?></td>
                            <td><?php echo htmlspecialchars($nota['NomEval'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($nota['TipoEval'] ?? 'N/A'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No hay notas registradas.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
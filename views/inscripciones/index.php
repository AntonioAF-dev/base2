<?php
$pageTitle = "Inscripciones";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>✍️ Gestión de Inscripciones</h1>
    <div class="btn-group">
        <a href="index.php?page=inscripciones&action=actualizar" class="btn btn-warning">Actualizar Estado</a>
        <a href="index.php?page=inscripciones&action=buscar" class="btn btn-primary">🔍 Buscar</a>
    </div>
</div>

<div class="card">
    <h2>Todas las Inscripciones</h2>
    <p class="text-muted">Vista: vista_inscripciones_detalladas</p>

    <?php if (count($inscripciones) > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Estudiante</th>
                        <th>Email</th>
                        <th>Curso</th>
                        <th>Precio</th>
                        <th>Nivel</th>
                        <th>Profesor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inscripciones as $ins): ?>
                        <tr>
                            <td><?php echo $ins['IdIns']; ?></td>
                            <td><?php echo $ins['FechaIns']; ?></td>
                            <td><span class="badge badge-<?php
                                                            echo $ins['EstadoIns'] == 'ACTIVA' ? 'success' : ($ins['EstadoIns'] == 'COMPLETADA' ? 'info' : ($ins['EstadoIns'] == 'PENDIENTE' ? 'warning' : 'secondary')); ?>">
                                    <?php echo $ins['EstadoIns']; ?>
                                </span></td>
                            <td><?php echo htmlspecialchars($ins['NombreEstudiante']); ?></td>
                            <td><?php echo htmlspecialchars($ins['EmailUsu']); ?></td>
                            <td><?php echo htmlspecialchars($ins['TituloCur']); ?></td>
                            <td>S/. <?php echo number_format($ins['PrecioCur'], 2); ?></td>
                            <td><?php echo htmlspecialchars($ins['NomNivel']); ?></td>
                            <td><?php echo htmlspecialchars($ins['NombreProfesor']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No hay inscripciones registradas.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
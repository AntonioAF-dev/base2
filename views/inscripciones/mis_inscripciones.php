<?php 
$pageTitle = "Mis Inscripciones";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>✍️ Mis Inscripciones</h1>
    <a href="index.php?page=cursos" class="btn btn-success">+ Inscribirme en un Curso</a>
</div>

<div class="card">
    <h2>Cursos en los que estoy inscrito</h2>
    
    <?php if (count($inscripciones) > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Curso</th>
                        <th>Fecha Inscripción</th>
                        <th>Estado</th>
                        <th>Nivel</th>
                        <th>Profesor</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inscripciones as $ins): ?>
                        <tr>
                            <td><?php echo $ins['IdIns']; ?></td>
                            <td><strong><?php echo htmlspecialchars($ins['TituloCur']); ?></strong></td>
                            <td><?php echo $ins['FechaIns']; ?></td>
                            <td>
                                <span class="badge badge-<?php 
                                    echo $ins['EstadoIns'] == 'ACTIVA' ? 'success' : 
                                         ($ins['EstadoIns'] == 'COMPLETADA' ? 'info' : 
                                         ($ins['EstadoIns'] == 'PENDIENTE' ? 'warning' : 'secondary')); ?>">
                                    <?php echo $ins['EstadoIns']; ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($ins['NomNivel']); ?></td>
                            <td><?php echo htmlspecialchars($ins['NombreProfesor']); ?></td>
                            <td>S/. <?php echo number_format($ins['PrecioCur'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="info-section">
            <h3>📊 Resumen</h3>
            <div class="info-grid">
                <?php
                $estados = ['ACTIVA' => 0, 'PENDIENTE' => 0, 'COMPLETADA' => 0];
                foreach ($inscripciones as $ins) {
                    if (isset($estados[$ins['EstadoIns']])) {
                        $estados[$ins['EstadoIns']]++;
                    }
                }
                ?>
                <div class="info-item">
                    <strong>Activas:</strong> <?php echo $estados['ACTIVA']; ?>
                </div>
                <div class="info-item">
                    <strong>Pendientes:</strong> <?php echo $estados['PENDIENTE']; ?>
                </div>
                <div class="info-item">
                    <strong>Completadas:</strong> <?php echo $estados['COMPLETADA']; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <h3>📚 Aún no tienes inscripciones</h3>
            <p>¡Explora nuestro catálogo de cursos y comienza tu aprendizaje!</p>
            <a href="index.php?page=cursos" class="btn btn-primary">Ver Cursos Disponibles</a>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
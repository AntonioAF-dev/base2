<?php 
$pageTitle = "Cursos";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>📚 Gestión de Cursos</h1>
    <div class="btn-group">
        <a href="index.php?page=cursos&action=crear" class="btn btn-success">+ Nuevo Curso</a>
        <a href="index.php?page=cursos&action=buscar" class="btn btn-primary">🔍 Buscar Cursos</a>
    </div>
</div>

<div class="card">
    <h2>Todos los Cursos</h2>
    <p class="text-muted">Vista: vista_cursos_completos</p>
    
    <?php if (count($cursos) > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Nivel</th>
                        <th>Tipo</th>
                        <th>Profesor</th>
                        <th>Plataforma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $curso): ?>
                        <tr>
                            <td><?php echo $curso['IdCur']; ?></td>
                            <td><?php echo htmlspecialchars($curso['TituloCur']); ?></td>
                            <td>S/. <?php echo number_format($curso['PrecioCur'], 2); ?></td>
                            <td><span class="badge badge-<?php echo $curso['EstadoCur'] == 'ACTIVO' ? 'success' : 'secondary'; ?>">
                                <?php echo $curso['EstadoCur']; ?>
                            </span></td>
                            <td><?php echo htmlspecialchars($curso['NomNivel']); ?></td>
                            <td><?php echo htmlspecialchars($curso['NomTipoCur']); ?></td>
                            <td><?php echo htmlspecialchars($curso['NombreProfesor']); ?></td>
                            <td><?php echo htmlspecialchars($curso['NomPlat']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No hay cursos registrados.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
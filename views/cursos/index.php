<?php 
$pageTitle = "Cursos";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';

$userRole = $_SESSION['user_role'] ?? '';
?>

<div class="page-header">
    <h1>📚 <?php echo $userRole === 'Estudiante' ? 'Catálogo de Cursos' : 'Gestión de Cursos'; ?></h1>
    <div class="btn-group">
        <?php if ($userRole === 'Administrador' || $userRole === 'Profesor'): ?>
            <a href="index.php?page=cursos&action=crear" class="btn btn-success">+ Nuevo Curso</a>
        <?php endif; ?>
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
                        <?php if ($userRole === 'Estudiante'): ?>
                            <th>Acción</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $curso): ?>
                        <tr>
                            <td><?php echo $curso['IdCur']; ?></td>
                            <td><strong><?php echo htmlspecialchars($curso['TituloCur']); ?></strong></td>
                            <td>S/. <?php echo number_format($curso['PrecioCur'], 2); ?></td>
                            <td><span class="badge badge-<?php echo $curso['EstadoCur'] == 'ACTIVO' ? 'success' : 'secondary'; ?>">
                                <?php echo $curso['EstadoCur']; ?>
                            </span></td>
                            <td><?php echo htmlspecialchars($curso['NomNivel']); ?></td>
                            <td><?php echo htmlspecialchars($curso['NomTipoCur']); ?></td>
                            <td><?php echo htmlspecialchars($curso['NombreProfesor']); ?></td>
                            <td><?php echo htmlspecialchars($curso['NomPlat']); ?></td>
                            <?php if ($userRole === 'Estudiante' && $curso['EstadoCur'] == 'ACTIVO'): ?>
                                <td>
                                    <form method="POST" action="index.php?page=inscripciones&action=inscribirse" style="display: inline;">
                                        <input type="hidden" name="id_curso" value="<?php echo $curso['IdCur']; ?>">
                                        <button type="submit" class="btn btn-success" style="padding: 0.5rem 1rem; font-size: 0.875rem;"
                                                onclick="return confirm('¿Deseas inscribirte en este curso?');">
                                            ✍️ Inscribirme
                                        </button>
                                    </form>
                                </td>
                            <?php endif; ?>
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
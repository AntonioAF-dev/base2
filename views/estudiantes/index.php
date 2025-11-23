<?php 
$pageTitle = "Estudiantes";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>👨‍🎓 Gestión de Estudiantes</h1>
    <a href="index.php?page=estudiantes&action=crear" class="btn btn-success">+ Registrar Estudiante</a>
</div>

<div class="card">
    <h2>Todos los Estudiantes</h2>
    <p class="text-muted">Consulta con JOIN: Usuario + Estudiante</p>
    
    <?php if (count($estudiantes) > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Biografía</th>
                        <th>Fecha Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estudiantes as $est): ?>
                        <tr>
                            <td><?php echo $est['IdEstud']; ?></td>
                            <td><?php echo htmlspecialchars($est['Nombre']); ?></td>
                            <td><?php echo htmlspecialchars($est['EmailUsu']); ?></td>
                            <td><?php echo htmlspecialchars(substr($est['BioEstud'] ?? 'Sin biografía', 0, 50)) . '...'; ?></td>
                            <td><?php echo $est['FechaRegUsu']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No hay estudiantes registrados.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
<?php
$pageTitle = "Gestión de Usuarios";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>👥 Gestión de Usuarios</h1>
    <a href="index.php?page=usuarios&action=crear" class="btn btn-success">+ Nuevo Usuario</a>
</div>

<div class="card">
    <h2>Todos los Usuarios del Sistema</h2>
    <p class="text-muted">Gestiona usuarios, roles y permisos</p>

    <?php if (count($usuarios) > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['IdUsu']; ?></td>
                            <td><?php echo htmlspecialchars($usuario['NomUsu'] . ' ' . $usuario['ApeUsu']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['EmailUsu']); ?></td>
                            <td>
                                <span class="badge badge-<?php
                                                            echo $usuario['RolUsu'] === 'Administrador' ? 'success' : ($usuario['RolUsu'] === 'Profesor' ? 'info' : 'secondary');
                                                            ?>">
                                    <?php echo htmlspecialchars($usuario['RolUsu']); ?>
                                </span>
                            </td>
                            <td><?php echo $usuario['FechaRegUsu']; ?></td>
                            <td>
                                <a href="index.php?page=usuarios&action=editar&id=<?php echo $usuario['IdUsu']; ?>"
                                    class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                                    ✏️ Editar
                                </a>
                                <a href="index.php?page=usuarios&action=cambiar_password&id=<?php echo $usuario['IdUsu']; ?>"
                                    class="btn btn-warning" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                                    🔒 Cambiar Contraseña
                                </a>
                                <?php if ($usuario['IdUsu'] != $_SESSION['user_id']): ?>
                                    <a href="index.php?page=usuarios&action=eliminar&id=<?php echo $usuario['IdUsu']; ?>"
                                        class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.875rem;"
                                        onclick="return confirm('¿Está seguro de desactivar este usuario?');">
                                        🚫 Desactivar
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No hay usuarios registrados.</p>
    <?php endif; ?>
</div>

<div class="info-section">
    <h2>📋 Roles del Sistema</h2>
    <div class="info-grid">
        <div class="info-item">
            <strong>👑 Administrador</strong><br>
            Acceso total al sistema
        </div>
        <div class="info-item">
            <strong>👨‍🏫 Profesor</strong><br>
            Gestiona cursos y evalúa estudiantes
        </div>
        <div class="info-item">
            <strong>👨‍🎓 Estudiante</strong><br>
            Se inscribe y participa en cursos
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
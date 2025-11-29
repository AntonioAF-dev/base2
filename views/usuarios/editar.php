<?php
$pageTitle = "Editar Usuario";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>✏️ Editar Usuario</h1>
    <a href="index.php?page=usuarios" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Actualizar Información del Usuario</h2>
    <p class="text-muted">Usuario ID: <?php echo $usuario['IdUsu']; ?></p>

    <form method="POST" action="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre *</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    value="<?php echo htmlspecialchars($usuario['NomUsu']); ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="apellido">Apellido *</label>
                <input type="text" name="apellido" id="apellido" class="form-control"
                    value="<?php echo htmlspecialchars($usuario['ApeUsu']); ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" id="email" class="form-control"
                value="<?php echo htmlspecialchars($usuario['EmailUsu']); ?>" required>
        </div>

        <div class="form-group">
            <label for="rol">Rol *</label>
            <select name="rol" id="rol" class="form-control" required>
                <option value="Administrador" <?php echo $usuario['RolUsu'] === 'Administrador' ? 'selected' : ''; ?>>
                    👑 Administrador
                </option>
                <option value="Profesor" <?php echo $usuario['RolUsu'] === 'Profesor' ? 'selected' : ''; ?>>
                    👨‍🏫 Profesor
                </option>
                <option value="Estudiante" <?php echo $usuario['RolUsu'] === 'Estudiante' ? 'selected' : ''; ?>>
                    👨‍🎓 Estudiante
                </option>
            </select>
        </div>

        <div class="alert alert-warning">
            <strong>⚠️ Nota:</strong> Para cambiar la contraseña, use el botón "Cambiar Contraseña" en la lista de usuarios.
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        <a href="index.php?page=usuarios" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
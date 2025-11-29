<?php
$pageTitle = "Cambiar Contraseña";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>🔒 Cambiar Contraseña</h1>
    <a href="index.php?page=usuarios" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Establecer Nueva Contraseña</h2>
    <p class="text-muted">Usuario ID: <?php echo $_GET['id']; ?></p>

    <form method="POST" action="" onsubmit="return validarPassword();">
        <div class="form-group">
            <label for="password">Nueva Contraseña *</label>
            <input type="password" name="password" id="password" class="form-control"
                minlength="6" required>
            <small class="form-text text-muted">Mínimo 6 caracteres</small>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirmar Contraseña *</label>
            <input type="password" name="confirm_password" id="confirm_password"
                class="form-control" minlength="6" required>
        </div>

        <div id="passwordError" class="alert alert-danger" style="display: none;">
            Las contraseñas no coinciden
        </div>

        <button type="submit" class="btn btn-warning">Cambiar Contraseña</button>
        <a href="index.php?page=usuarios" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    function validarPassword() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const errorDiv = document.getElementById('passwordError');

        if (password !== confirmPassword) {
            errorDiv.style.display = 'block';
            return false;
        }

        errorDiv.style.display = 'none';
        return true;
    }
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
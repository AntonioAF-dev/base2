<?php 
$pageTitle = "Crear Usuario";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>👥 Crear Nuevo Usuario</h1>
    <a href="index.php?page=usuarios" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Formulario de Usuario</h2>
    <p class="text-muted">Complete los datos del nuevo usuario</p>
    
    <form method="POST" action="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre *</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            
            <div class="form-group col-md-6">
                <label for="apellido">Apellido *</label>
                <input type="text" name="apellido" id="apellido" class="form-control" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" id="email" class="form-control" required>
            <small class="form-text text-muted">El email será usado para iniciar sesión</small>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Contraseña *</label>
                <input type="password" name="password" id="password" class="form-control" minlength="6" required>
                <small class="form-text text-muted">Mínimo 6 caracteres</small>
            </div>
            
            <div class="form-group col-md-6">
                <label for="rol">Rol *</label>
                <select name="rol" id="rol" class="form-control" required>
                    <option value="">-- Seleccione un rol --</option>
                    <option value="Administrador">👑 Administrador</option>
                    <option value="Profesor">👨‍🏫 Profesor</option>
                    <option value="Estudiante">👨‍🎓 Estudiante</option>
                </select>
            </div>
        </div>
        
        <div class="alert alert-info">
            <strong>ℹ️ Información sobre Roles:</strong><br>
            <strong>Administrador:</strong> Acceso total al sistema, puede gestionar usuarios<br>
            <strong>Profesor:</strong> Puede crear y gestionar cursos, ver estudiantes<br>
            <strong>Estudiante:</strong> Puede inscribirse en cursos y ver sus calificaciones
        </div>
        
        <button type="submit" class="btn btn-success">Crear Usuario</button>
        <a href="index.php?page=usuarios" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

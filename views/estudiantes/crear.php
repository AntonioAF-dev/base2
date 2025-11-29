<?php 
$pageTitle = "Registrar Estudiante";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>👨‍🎓 Registrar Nuevo Estudiante</h1>
    <a href="index.php?page=estudiantes" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Formulario de Registro</h2>
    <p class="text-muted">Procedimiento: sp_insertar_estudiante</p>
    
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
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña *</label>
            <input type="password" name="password" id="password" class="form-control" minlength="6" required>
            <small class="form-text text-muted">Mínimo 6 caracteres</small>
        </div>
        
        <div class="form-group">
            <label for="bio">Biografía</label>
            <textarea name="bio" id="bio" class="form-control" rows="3" 
                      placeholder="Breve descripción del estudiante..."></textarea>
        </div>
        
        <button type="submit" class="btn btn-success">Registrar Estudiante</button>
        <a href="index.php?page=estudiantes" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

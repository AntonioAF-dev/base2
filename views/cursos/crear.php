<?php 
$pageTitle = "Crear Curso";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>📚 Crear Nuevo Curso</h1>
    <a href="index.php?page=cursos" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Formulario de Curso</h2>
    <p class="text-muted">Procedimiento: sp_insertar_curso</p>
    
    <form method="POST" action="">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="titulo">Título del Curso *</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
            </div>
            
            <div class="form-group col-md-4">
                <label for="precio">Precio (S/.) *</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="descripcion">Descripción *</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="estado">Estado *</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="ACTIVO">Activo</option>
                    <option value="INACTIVO">Inactivo</option>
                </select>
            </div>
            
            <div class="form-group col-md-3">
                <label for="id_nivel">Nivel *</label>
                <select name="id_nivel" id="id_nivel" class="form-control" required>
                    <option value="1">Principiante</option>
                    <option value="2">Intermedio</option>
                    <option value="3">Avanzado</option>
                </select>
            </div>
            
            <div class="form-group col-md-3">
                <label for="id_prof">Profesor *</label>
                <select name="id_prof" id="id_prof" class="form-control" required>
                    <option value="1">Juan Pérez</option>
                    <option value="2">Carlos López</option>
                </select>
            </div>
            
            <div class="form-group col-md-3">
                <label for="id_plat">Plataforma *</label>
                <select name="id_plat" id="id_plat" class="form-control" required>
                    <option value="1">Zoom</option>
                    <option value="2">Google Meet</option>
                    <option value="3">Microsoft Teams</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="id_tipo">Tipo de Curso *</label>
            <select name="id_tipo" id="id_tipo" class="form-control" required>
                <option value="1">Programación</option>
                <option value="2">Diseño</option>
                <option value="3">Marketing</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Guardar Curso</button>
        <a href="index.php?page=cursos" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
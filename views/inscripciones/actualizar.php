<?php 
$pageTitle = "Actualizar Inscripción";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>✍️ Actualizar Estado de Inscripción</h1>
    <a href="index.php?page=inscripciones" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Formulario de Actualización</h2>
    <p class="text-muted">Procedimiento: sp_actualizar_inscripcion</p>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="id_ins">ID de Inscripción *</label>
            <input type="number" name="id_ins" id="id_ins" class="form-control" min="1" required>
            <small class="form-text text-muted">Ingrese el ID de la inscripción a actualizar</small>
        </div>
        
        <div class="form-group">
            <label for="estado">Nuevo Estado *</label>
            <select name="estado" id="estado" class="form-control" required onchange="mostrarMensajeEstado()">
                <option value="">-- Seleccione --</option>
                <option value="ACTIVA">Activa</option>
                <option value="PENDIENTE">Pendiente</option>
                <option value="COMPLETADA">Completada</option>
                <option value="CANCELADA">Cancelada</option>
            </select>
        </div>
        
        <div id="mensajeEstado" class="alert alert-info" style="display: none;"></div>
        
        <button type="submit" class="btn btn-warning">Actualizar Inscripción</button>
        <a href="index.php?page=inscripciones" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
function mostrarMensajeEstado() {
    const estado = document.getElementById('estado').value;
    if (!estado) return;
    
    fetch('index.php?page=inscripciones&action=mensaje', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'estado=' + estado
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const div = document.getElementById('mensajeEstado');
            div.innerHTML = '<strong>Info:</strong> ' + data.mensaje;
            div.style.display = 'block';
        }
    });
}
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
<?php 
$pageTitle = "Cancelar Pago";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>💰 Cancelar Pago</h1>
    <a href="index.php?page=pagos" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Formulario de Cancelación</h2>
    <p class="text-muted">Procedimiento: sp_eliminar_pago (eliminación lógica)</p>
    
    <div class="alert alert-warning">
        <strong>⚠️ Advertencia:</strong> Esta acción cancelará el pago, cambiando su estado a CANCELADO.
    </div>
    
    <form method="POST" action="" onsubmit="return confirm('¿Está seguro de cancelar este pago?');">
        <div class="form-group">
            <label for="id_pago">ID del Pago a Cancelar *</label>
            <input type="number" name="id_pago" id="id_pago" class="form-control" min="1" required>
            <small class="form-text text-muted">Ingrese el ID del pago que desea cancelar</small>
        </div>
        
        <button type="submit" class="btn btn-warning">Cancelar Pago</button>
        <a href="index.php?page=pagos" class="btn btn-secondary">Volver</a>
    </form>
</div>

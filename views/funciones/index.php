<?php 
$pageTitle = "Funciones del Sistema";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>📝 Funciones del Sistema</h1>
    <p>Prueba las 4 funciones con condicionales IF y CASE</p>
</div>

<div class="functions-grid">
    <!-- Función 1: Mensaje de Estado de Inscripción -->
    <div class="card">
        <h3>1. Mensaje de Estado de Inscripción</h3>
        <p class="text-muted">Función: fn_mensaje_estado_inscripcion (IF)</p>
        
        <form id="formEstado" onsubmit="return probarFuncion(event, 'estado')">
            <div class="form-group">
                <label>Estado de Inscripción:</label>
                <select name="estado" class="form-control" required>
                    <option value="">-- Seleccione --</option>
                    <option value="ACTIVA">Activa</option>
                    <option value="PENDIENTE">Pendiente</option>
                    <option value="COMPLETADA">Completada</option>
                    <option value="CANCELADA">Cancelada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Obtener Mensaje</button>
        </form>
        
        <div id="resultadoEstado" class="result-box"></div>
    </div>

    <!-- Función 2: Clasificar Nota -->
    <div class="card">
        <h3>2. Clasificar Calificación</h3>
        <p class="text-muted">Función: fn_clasificar_nota (CASE)</p>
        
        <form id="formNota" onsubmit="return probarFuncion(event, 'nota')">
            <div class="form-group">
                <label>Calificación (0-20):</label>
                <input type="number" step="0.01" name="calificacion" class="form-control" 
                       min="0" max="20" placeholder="Ej: 17.5" required>
            </div>
            <button type="submit" class="btn btn-primary">Clasificar</button>
        </form>
        
        <div id="resultadoNota" class="result-box"></div>
    </div>

    <!-- Función 3: Validar Disponibilidad de Curso -->
    <div class="card">
        <h3>3. Validar Disponibilidad de Curso</h3>
        <p class="text-muted">Función: fn_validar_disponibilidad_curso (IF)</p>
        
        <form id="formDisponibilidad" onsubmit="return probarFuncion(event, 'disponibilidad')">
            <div class="form-group">
                <label>ID del Curso:</label>
                <input type="number" name="id_curso" class="form-control" 
                       min="1" placeholder="Ej: 1" required>
            </div>
            <button type="submit" class="btn btn-primary">Validar</button>
        </form>
        
        <div id="resultadoDisponibilidad" class="result-box"></div>
    </div>

    <!-- Función 4: Calcular Descuento por Método de Pago -->
    <div class="card">
        <h3>4. Calcular Descuento</h3>
        <p class="text-muted">Función: fn_calcular_descuento_pago (CASE)</p>
        
        <form id="formDescuento" onsubmit="return probarFuncion(event, 'descuento')">
            <div class="form-group">
                <label>Monto (S/.):</label>
                <input type="number" step="0.01" name="monto" class="form-control" 
                       min="0" placeholder="Ej: 1000" required>
            </div>
            <div class="form-group">
                <label>Método de Pago:</label>
                <select name="metodo" class="form-control" required>
                    <option value="">-- Seleccione --</option>
                    <option value="EFECTIVO">Efectivo (5% desc.)</option>
                    <option value="TRANSFERENCIA">Transferencia (3% desc.)</option>
                    <option value="TARJETA">Tarjeta (sin desc.)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        
        <div id="resultadoDescuento" class="result-box"></div>
    </div>
</div>

<script>
function probarFuncion(event, tipo) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    fetch(`index.php?page=funciones&action=${tipo}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const resultDiv = document.getElementById(`resultado${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`);
        
        if (data.success) {
            let html = '<div class="alert alert-success">';
            
            switch(tipo) {
                case 'estado':
                    html += `<strong>Mensaje:</strong> ${data.mensaje}`;
                    break;
                case 'nota':
                    html += `<strong>Calificación:</strong> ${data.calificacion}<br>`;
                    html += `<strong>Clasificación:</strong> ${data.clasificacion}`;
                    break;
                case 'disponibilidad':
                    html += `<strong>Resultado:</strong> ${data.mensaje}`;
                    break;
                case 'descuento':
                    html += `<strong>Descuento:</strong> S/. ${parseFloat(data.descuento).toFixed(2)}<br>`;
                    html += `<strong>Monto Final:</strong> S/. ${parseFloat(data.monto_final).toFixed(2)}`;
                    break;
            }
            
            html += '</div>';
            resultDiv.innerHTML = html;
        } else {
            resultDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
    return false;
}
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
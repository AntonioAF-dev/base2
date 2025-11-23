<?php 
$pageTitle = "Buscar Notas";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>🔍 Buscar Notas</h1>
    <a href="index.php?page=notas" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Búsqueda Avanzada</h2>
    <p class="text-muted">Procedimiento: sp_buscar_notas (con 2 parámetros)</p>
    
    <form method="POST" action="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="id_curso">ID del Curso (0 = Todos)</label>
                <input type="number" name="id_curso" id="id_curso" class="form-control" 
                       value="<?php echo $_POST['id_curso'] ?? '0'; ?>" min="0">
                <small class="form-text text-muted">Ingrese 0 para ver notas de todos los cursos</small>
            </div>
            
            <div class="form-group col-md-6">
                <label for="calif_min">Calificación Mínima</label>
                <input type="number" step="0.01" name="calif_min" id="calif_min" class="form-control" 
                       value="<?php echo $_POST['calif_min'] ?? '0'; ?>" min="0" max="20">
                <small class="form-text text-muted">Mostrar notas mayores o iguales a este valor</small>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>

<?php if (isset($notas)): ?>
<div class="card mt-4">
    <h2>Resultados de la Búsqueda</h2>
    <p class="text-muted">Notas encontradas: <?php echo count($notas); ?></p>
    
    <?php if (count($notas) > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Calificación</th>
                        <th>Clasificación</th>
                        <th>Fecha</th>
                        <th>Estudiante</th>
                        <th>Curso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notas as $nota): 
                        $colorClase = '';
                        switch($nota['clasificacion']) {
                            case 'EXCELENTE': $colorClase = 'success'; break;
                            case 'BUENO': $colorClase = 'info'; break;
                            case 'REGULAR': $colorClase = 'warning'; break;
                            case 'APROBADO': $colorClase = 'secondary'; break;
                            case 'DESAPROBADO': $colorClase = 'error'; break;
                        }
                    ?>
                        <tr>
                            <td><?php echo $nota['IdNot']; ?></td>
                            <td><strong><?php echo number_format($nota['CalifNot'], 2); ?></strong></td>
                            <td>
                                <span class="badge badge-<?php echo $colorClase; ?>">
                                    <?php echo $nota['clasificacion']; ?>
                                </span>
                            </td>
                            <td><?php echo $nota['FechaCalifNot']; ?></td>
                            <td><?php echo htmlspecialchars($nota['NombreEstudiante']); ?></td>
                            <td><?php echo htmlspecialchars($nota['TituloCur']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="info-section">
            <h3>Estadísticas de Clasificación</h3>
            <?php
            $clasificaciones = array_count_values(array_column($notas, 'clasificacion'));
            foreach ($clasificaciones as $clase => $cantidad):
            ?>
                <div class="badge badge-secondary" style="margin: 5px;">
                    <?php echo $clase; ?>: <?php echo $cantidad; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No se encontraron notas con los criterios especificados.</p>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
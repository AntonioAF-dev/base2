<?php 
$pageTitle = "Consultar Vistas";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>📊 Consultar Vistas del Sistema</h1>
    <p>Selecciona una vista para consultar datos con JOINs</p>
</div>

<div class="card">
    <h2>Seleccionar Vista</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="vista">Vista a consultar:</label>
            <select name="vista" id="vista" class="form-control" required>
                <option value="">-- Seleccione una vista --</option>
                <?php foreach ($vistas as $key => $nombre): ?>
                    <option value="<?php echo $key; ?>" <?php echo (isset($_POST['vista']) && $_POST['vista'] == $key) ? 'selected' : ''; ?>>
                        <?php echo $nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="limite">Límite de registros:</label>
            <input type="number" name="limite" id="limite" class="form-control" value="100" min="1" max="500">
        </div>
        
        <button type="submit" class="btn btn-primary">Consultar Vista</button>
    </form>
</div>

<?php if ($datosVista): ?>
<div class="card mt-4">
    <h2><?php echo $datosVista['nombre']; ?></h2>
    <p class="text-muted">Total de registros: <?php echo $datosVista['total']; ?></p>
    
    <?php if ($datosVista['total'] > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <?php foreach ($datosVista['columnas'] as $columna): ?>
                            <th><?php echo htmlspecialchars($columna); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datosVista['datos'] as $fila): ?>
                        <tr>
                            <?php foreach ($fila as $valor): ?>
                                <td><?php echo htmlspecialchars($valor ?? ''); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No hay datos disponibles en esta vista.</p>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
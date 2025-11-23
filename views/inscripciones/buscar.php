<?php
$pageTitle = "Buscar Inscripciones";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>🔍 Buscar Inscripciones</h1>
    <a href="index.php?page=inscripciones" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Búsqueda por Rango de Fechas</h2>
    <p class="text-muted">Procedimiento: sp_buscar_inscripciones (con 2 parámetros)</p>

    <form method="POST" action="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fecha_inicio">Fecha Inicio *</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                    value="<?php echo $_POST['fecha_inicio'] ?? ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="fecha_fin">Fecha Fin *</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                    value="<?php echo $_POST['fecha_fin'] ?? ''; ?>" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>

<?php if (isset($inscripciones)): ?>
    <div class="card mt-4">
        <h2>Resultados de la Búsqueda</h2>
        <p class="text-muted">Inscripciones encontradas: <?php echo count($inscripciones); ?></p>

        <?php if (count($inscripciones) > 0): ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Estudiante</th>
                            <th>Email</th>
                            <th>Curso</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inscripciones as $ins): ?>
                            <tr>
                                <td><?php echo $ins['IdIns']; ?></td>
                                <td><?php echo $ins['FechaIns']; ?></td>
                                <td><span class="badge badge-<?php
                                                                echo $ins['EstadoIns'] == 'ACTIVA' ? 'success' : ($ins['EstadoIns'] == 'COMPLETADA' ? 'info' : 'warning'); ?>">
                                        <?php echo $ins['EstadoIns']; ?>
                                    </span></td>
                                <td><?php echo htmlspecialchars($ins['NombreEstudiante']); ?></td>
                                <td><?php echo htmlspecialchars($ins['EmailUsu']); ?></td>
                                <td><?php echo htmlspecialchars($ins['TituloCur']); ?></td>
                                <td>S/. <?php echo number_format($ins['PrecioCur'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">No se encontraron inscripciones en el rango de fechas especificado.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
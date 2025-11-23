<?php
$pageTitle = "Buscar Pagos";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>🔍 Buscar Pagos</h1>
    <a href="index.php?page=pagos" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Búsqueda Avanzada</h2>
    <p class="text-muted">Procedimiento: sp_buscar_pagos (con 2 parámetros)</p>

    <form method="POST" action="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="metodo">Método de Pago</label>
                <select name="metodo" id="metodo" class="form-control">
                    <option value="">Todos los métodos</option>
                    <option value="EFECTIVO" <?php echo (isset($_POST['metodo']) && $_POST['metodo'] == 'EFECTIVO') ? 'selected' : ''; ?>>Efectivo</option>
                    <option value="TARJETA" <?php echo (isset($_POST['metodo']) && $_POST['metodo'] == 'TARJETA') ? 'selected' : ''; ?>>Tarjeta</option>
                    <option value="TRANSFERENCIA" <?php echo (isset($_POST['metodo']) && $_POST['metodo'] == 'TRANSFERENCIA') ? 'selected' : ''; ?>>Transferencia</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="estado">Estado del Pago</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="">Todos los estados</option>
                    <option value="COMPLETADO" <?php echo (isset($_POST['estado']) && $_POST['estado'] == 'COMPLETADO') ? 'selected' : ''; ?>>Completado</option>
                    <option value="PENDIENTE" <?php echo (isset($_POST['estado']) && $_POST['estado'] == 'PENDIENTE') ? 'selected' : ''; ?>>Pendiente</option>
                    <option value="CANCELADO" <?php echo (isset($_POST['estado']) && $_POST['estado'] == 'CANCELADO') ? 'selected' : ''; ?>>Cancelado</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>

<?php if (isset($pagos)): ?>
    <div class="card mt-4">
        <h2>Resultados de la Búsqueda</h2>
        <p class="text-muted">Pagos encontrados: <?php echo count($pagos); ?></p>

        <?php if (count($pagos) > 0): ?>
            <div class="alert alert-info">
                <strong>Total Encontrado:</strong> S/. <?php echo number_format($totalPagos, 2); ?>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Método</th>
                            <th>Estado</th>
                            <th>Estudiante</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagos as $pago): ?>
                            <tr>
                                <td><?php echo $pago['IdPag']; ?></td>
                                <td><strong>S/. <?php echo number_format($pago['MontoPag'], 2); ?></strong></td>
                                <td><?php echo $pago['FechaPag']; ?></td>
                                <td><?php echo htmlspecialchars($pago['MetodoPag']); ?></td>
                                <td><span class="badge badge-<?php
                                                                echo $pago['EstadoPag'] == 'COMPLETADO' ? 'success' : ($pago['EstadoPag'] == 'PENDIENTE' ? 'warning' : 'secondary'); ?>">
                                        <?php echo $pago['EstadoPag']; ?>
                                    </span></td>
                                <td><?php echo htmlspecialchars($pago['NombreEstudiante']); ?></td>
                                <td><?php echo htmlspecialchars($pago['TituloCur']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">No se encontraron pagos con los criterios especificados.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
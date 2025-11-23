<?php
$pageTitle = "Pagos";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>💰 Gestión de Pagos</h1>
    <div class="btn-group">
        <a href="index.php?page=pagos&action=eliminar" class="btn btn-warning">Cancelar Pago</a>
        <a href="index.php?page=pagos&action=buscar" class="btn btn-primary">🔍 Buscar Pagos</a>
    </div>
</div>

<div class="card">
    <h2>Todos los Pagos</h2>
    <p class="text-muted">Vista: vista_pagos_completos</p>

    <?php if (count($pagos) > 0):
        $totalGeneral = 0;
        foreach ($pagos as $pago) {
            $totalGeneral += $pago['MontoPag'];
        }
    ?>
        <div class="alert alert-info">
            <strong>Total General:</strong> S/. <?php echo number_format($totalGeneral, 2); ?>
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
                        <th>Email</th>
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
                            <td><?php echo htmlspecialchars($pago['EmailUsu']); ?></td>
                            <td><?php echo htmlspecialchars($pago['TituloCur']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No hay pagos registrados.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
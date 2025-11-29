<?php 
$pageTitle = "Mis Pagos";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>💰 Mis Pagos</h1>
    <a href="index.php?page=dashboard" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Historial de Pagos</h2>
    
    <?php if (count($pagos) > 0): 
        $totalPagado = 0;
        foreach ($pagos as $pago) {
            $totalPagado += $pago['MontoPag'];
        }
    ?>
        <div class="alert alert-info">
            <strong>💵 Total Pagado:</strong> S/. <?php echo number_format($totalPagado, 2); ?>
        </div>
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Curso</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Método</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagos as $pago): ?>
                        <tr>
                            <td><?php echo $pago['IdPag']; ?></td>
                            <td><strong><?php echo htmlspecialchars($pago['TituloCur']); ?></strong></td>
                            <td><strong>S/. <?php echo number_format($pago['MontoPag'], 2); ?></strong></td>
                            <td><?php echo $pago['FechaPag']; ?></td>
                            <td><?php echo htmlspecialchars($pago['MetodoPag']); ?></td>
                            <td>
                                <span class="badge badge-<?php 
                                    echo $pago['EstadoPag'] == 'COMPLETADO' ? 'success' : 
                                         ($pago['EstadoPag'] == 'PENDIENTE' ? 'warning' : 'secondary'); ?>">
                                    <?php echo $pago['EstadoPag']; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <h3>💰 No tienes pagos registrados</h3>
            <p>Los pagos de tus inscripciones aparecerán aquí.</p>
            <a href="index.php?page=inscripciones&action=mis-inscripciones" class="btn btn-primary">Ver Mis Inscripciones</a>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
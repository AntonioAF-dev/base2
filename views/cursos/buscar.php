<?php 
$pageTitle = "Buscar Cursos";
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
?>

<div class="page-header">
    <h1>🔍 Buscar Cursos</h1>
    <a href="index.php?page=cursos" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <h2>Búsqueda Avanzada</h2>
    <p class="text-muted">Procedimiento: sp_buscar_cursos (con 2 parámetros)</p>
    
    <form method="POST" action="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="id_nivel">Nivel (0 = Todos)</label>
                <select name="id_nivel" id="id_nivel" class="form-control">
                    <option value="0">Todos los niveles</option>
                    <option value="1" <?php echo (isset($_POST['id_nivel']) && $_POST['id_nivel'] == 1) ? 'selected' : ''; ?>>Principiante</option>
                    <option value="2" <?php echo (isset($_POST['id_nivel']) && $_POST['id_nivel'] == 2) ? 'selected' : ''; ?>>Intermedio</option>
                    <option value="3" <?php echo (isset($_POST['id_nivel']) && $_POST['id_nivel'] == 3) ? 'selected' : ''; ?>>Avanzado</option>
                </select>
            </div>
            
            <div class="form-group col-md-6">
                <label for="id_tipo">Tipo de Curso (0 = Todos)</label>
                <select name="id_tipo" id="id_tipo" class="form-control">
                    <option value="0">Todos los tipos</option>
                    <option value="1" <?php echo (isset($_POST['id_tipo']) && $_POST['id_tipo'] == 1) ? 'selected' : ''; ?>>Programación</option>
                    <option value="2" <?php echo (isset($_POST['id_tipo']) && $_POST['id_tipo'] == 2) ? 'selected' : ''; ?>>Diseño</option>
                    <option value="3" <?php echo (isset($_POST['id_tipo']) && $_POST['id_tipo'] == 3) ? 'selected' : ''; ?>>Marketing</option>
                </select>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>

<?php if (isset($cursos)): ?>
<div class="card mt-4">
    <h2>Resultados de la Búsqueda</h2>
    <p class="text-muted">Cursos encontrados: <?php echo count($cursos); ?></p>
    
    <?php if (count($cursos) > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Nivel</th>
                        <th>Tipo</th>
                        <th>Profesor</th>
                        <th>Plataforma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $curso): ?>
                        <tr>
                            <td><?php echo $curso['IdCur']; ?></td>
                            <td><?php echo htmlspecialchars($curso['TituloCur']); ?></td>
                            <td><?php echo substr(htmlspecialchars($curso['DescCur']), 0, 50) . '...'; ?></td>
                            <td>S/. <?php echo number_format($curso['PrecioCur'], 2); ?></td>
                            <td><span class="badge badge-<?php echo $curso['EstadoCur'] == 'ACTIVO' ? 'success' : 'secondary'; ?>">
                                <?php echo $curso['EstadoCur']; ?>
                            </span></td>
                            <td><?php echo htmlspecialchars($curso['NomNivel']); ?></td>
                            <td><?php echo htmlspecialchars($curso['NomTipoCur']); ?></td>
                            <td><?php echo htmlspecialchars($curso['NombreProfesor']); ?></td>
                            <td><?php echo htmlspecialchars($curso['NomPlat']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No se encontraron cursos con los criterios especificados.</p>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
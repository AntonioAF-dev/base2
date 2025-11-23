<nav class="navbar">
    <div class="container">
        <div class="nav-brand">
            <h2>🎓 Sistema de Capacitaciones</h2>
        </div>
        <ul class="nav-menu">
            <li><a href="index.php" class="<?php echo (!isset($_GET['page']) ? 'active' : ''); ?>">Inicio</a></li>
            <li><a href="index.php?page=vistas" class="<?php echo ($_GET['page'] ?? '') == 'vistas' ? 'active' : ''; ?>">Vistas</a></li>
            <li><a href="index.php?page=cursos" class="<?php echo ($_GET['page'] ?? '') == 'cursos' ? 'active' : ''; ?>">Cursos</a></li>
            <li><a href="index.php?page=inscripciones" class="<?php echo ($_GET['page'] ?? '') == 'inscripciones' ? 'active' : ''; ?>">Inscripciones</a></li>
            <li><a href="index.php?page=pagos" class="<?php echo ($_GET['page'] ?? '') == 'pagos' ? 'active' : ''; ?>">Pagos</a></li>
            <li><a href="index.php?page=estudiantes" class="<?php echo ($_GET['page'] ?? '') == 'estudiantes' ? 'active' : ''; ?>">Estudiantes</a></li>
            <li><a href="index.php?page=notas" class="<?php echo ($_GET['page'] ?? '') == 'notas' ? 'active' : ''; ?>">Notas</a></li>
            <li><a href="index.php?page=funciones" class="<?php echo ($_GET['page'] ?? '') == 'funciones' ? 'active' : ''; ?>">Funciones</a></li>
        </ul>
    </div>
</nav>

<main class="main-content">
    <div class="container">
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo $_SESSION['tipo_mensaje']; ?>">
                <?php 
                    echo htmlspecialchars($_SESSION['mensaje']); 
                    unset($_SESSION['mensaje']);
                    unset($_SESSION['tipo_mensaje']);
                ?>
            </div>
        <?php endif; ?>
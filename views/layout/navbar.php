<nav class="navbar">
    <div class="container">
        <div class="nav-brand">
            <a href="index.php?page=dashboard" style="color: white; text-decoration: none;">
                <h2>🎓 Sistema de Capacitaciones</h2>
            </a>
        </div>
        <ul class="nav-menu">
            <!-- Dashboard - Todos los usuarios -->
            <li><a href="index.php?page=dashboard" class="<?php echo ($_GET['page'] ?? 'dashboard') == 'dashboard' ? 'active' : ''; ?>">🏠 Dashboard</a></li>
            
            <?php 
            $userRole = $_SESSION['user_role'] ?? '';
            
            // Menú para ADMINISTRADOR
            if ($userRole === 'Administrador'): 
            ?>
                <li><a href="index.php?page=usuarios" class="<?php echo ($_GET['page'] ?? '') == 'usuarios' ? 'active' : ''; ?>">👥 Usuarios</a></li>
                <li><a href="index.php?page=vistas" class="<?php echo ($_GET['page'] ?? '') == 'vistas' ? 'active' : ''; ?>">📊 Vistas</a></li>
                <li><a href="index.php?page=cursos" class="<?php echo ($_GET['page'] ?? '') == 'cursos' ? 'active' : ''; ?>">📚 Cursos</a></li>
                <li><a href="index.php?page=inscripciones" class="<?php echo ($_GET['page'] ?? '') == 'inscripciones' ? 'active' : ''; ?>">✍️ Inscripciones</a></li>
                <li><a href="index.php?page=pagos" class="<?php echo ($_GET['page'] ?? '') == 'pagos' ? 'active' : ''; ?>">💰 Pagos</a></li>
                <li><a href="index.php?page=estudiantes" class="<?php echo ($_GET['page'] ?? '') == 'estudiantes' ? 'active' : ''; ?>">👨‍🎓 Estudiantes</a></li>
                <li><a href="index.php?page=notas" class="<?php echo ($_GET['page'] ?? '') == 'notas' ? 'active' : ''; ?>">📝 Notas</a></li>
                <li><a href="index.php?page=funciones" class="<?php echo ($_GET['page'] ?? '') == 'funciones' ? 'active' : ''; ?>">⚙️ Funciones</a></li>
            
            <?php 
            // Menú para PROFESOR
            elseif ($userRole === 'Profesor'): 
            ?>
                <li><a href="index.php?page=cursos" class="<?php echo ($_GET['page'] ?? '') == 'cursos' ? 'active' : ''; ?>">📚 Mis Cursos</a></li>
                <li><a href="index.php?page=inscripciones" class="<?php echo ($_GET['page'] ?? '') == 'inscripciones' ? 'active' : ''; ?>">✍️ Inscripciones</a></li>
                <li><a href="index.php?page=estudiantes" class="<?php echo ($_GET['page'] ?? '') == 'estudiantes' ? 'active' : ''; ?>">👨‍🎓 Estudiantes</a></li>
                <li><a href="index.php?page=notas" class="<?php echo ($_GET['page'] ?? '') == 'notas' ? 'active' : ''; ?>">📝 Calificaciones</a></li>
                <li><a href="index.php?page=vistas" class="<?php echo ($_GET['page'] ?? '') == 'vistas' ? 'active' : ''; ?>">📊 Reportes</a></li>
            
            <?php 
            // Menú para ESTUDIANTE
            elseif ($userRole === 'Estudiante'): 
            ?>
                <li><a href="index.php?page=cursos" class="<?php echo ($_GET['page'] ?? '') == 'cursos' ? 'active' : ''; ?>">📚 Cursos</a></li>
                <li><a href="index.php?page=inscripciones&action=mis-inscripciones" class="<?php echo ($_GET['page'] ?? '') == 'inscripciones' ? 'active' : ''; ?>">✍️ Mis Inscripciones</a></li>
                <li><a href="index.php?page=notas&action=mis-notas" class="<?php echo ($_GET['page'] ?? '') == 'notas' ? 'active' : ''; ?>">📝 Mis Calificaciones</a></li>
                <li><a href="index.php?page=pagos&action=mis-pagos" class="<?php echo ($_GET['page'] ?? '') == 'pagos' ? 'active' : ''; ?>">💰 Mis Pagos</a></li>
            
            <?php endif; ?>
            
            <!-- Usuario y Logout - Todos -->
            <li style="margin-left: auto;">
                <span style="color: white; padding: 0.5rem;">
                    👤 <?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Usuario'; ?>
                    <small style="display: block; font-size: 0.8em; opacity: 0.8;">
                        <?php echo isset($_SESSION['user_role']) ? htmlspecialchars($_SESSION['user_role']) : ''; ?>
                    </small>
                </span>
            </li>
            <li><a href="index.php?page=logout" style="background: rgba(255,255,255,0.2);">🚪 Salir</a></li>
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

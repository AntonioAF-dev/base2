<?php 
$pageTitle = "Inicio - Sistema de Capacitaciones";
include __DIR__ . '/layout/header.php';
include __DIR__ . '/layout/navbar.php';
?>

<div class="hero-section">
    <h1>🎓 Sistema de Gestión de Capacitaciones en Línea</h1>
    <p class="lead">Plataforma integral para la gestión de cursos, inscripciones, pagos y evaluaciones</p>
</div>

<div class="features-grid">
    <div class="feature-card">
        <h3>📊 Vistas de Datos</h3>
        <p>Consulta 5 vistas con JOINs para análisis completo de información</p>
        <a href="index.php?page=vistas" class="btn btn-primary">Ir a Vistas</a>
    </div>
    
    <div class="feature-card">
        <h3>📚 Gestión de Cursos</h3>
        <p>Crea, busca y administra cursos con procedimientos almacenados</p>
        <a href="index.php?page=cursos" class="btn btn-primary">Gestionar Cursos</a>
    </div>
    
    <div class="feature-card">
        <h3>✍️ Inscripciones</h3>
        <p>Administra inscripciones de estudiantes con búsquedas avanzadas</p>
        <a href="index.php?page=inscripciones" class="btn btn-primary">Ver Inscripciones</a>
    </div>
    
    <div class="feature-card">
        <h3>💰 Pagos</h3>
        <p>Controla pagos, calcula descuentos y genera reportes</p>
        <a href="index.php?page=pagos" class="btn btn-primary">Gestionar Pagos</a>
    </div>
    
    <div class="feature-card">
        <h3>👨‍🎓 Estudiantes</h3>
        <p>Registra y administra información de estudiantes</p>
        <a href="index.php?page=estudiantes" class="btn btn-primary">Ver Estudiantes</a>
    </div>
    
    <div class="feature-card">
        <h3>📝 Notas</h3>
        <p>Consulta calificaciones con clasificación automática</p>
        <a href="index.php?page=notas" class="btn btn-primary">Ver Notas</a>
    </div>
    
    <div class="feature-card">
        <h3>⚙️ Funciones</h3>
        <p>Prueba las 4 funciones con condicionales IF y CASE</p>
        <a href="index.php?page=funciones" class="btn btn-primary">Probar Funciones</a>
    </div>
    
    <div class="feature-card">
        <h3>🔒 Sistema Seguro</h3>
        <p>Triggers y validaciones para protección de datos</p>
        <div class="badge">11 Triggers Activos</div>
    </div>
</div>

<div class="info-section">
    <h2>📋 Características del Sistema</h2>
    <div class="info-grid">
        <div class="info-item">
            <strong>✅ 5 Vistas</strong> con JOINs complejos
        </div>
        <div class="info-item">
            <strong>✅ 7 Procedimientos</strong> almacenados
        </div>
        <div class="info-item">
            <strong>✅ 4 Funciones</strong> con IF y CASE
        </div>
        <div class="info-item">
            <strong>✅ 11 Triggers</strong> para validación
        </div>
        <div class="info-item">
            <strong>✅ 3 Grupos</strong> de usuarios
        </div>
        <div class="info-item">
            <strong>✅ 9 Usuarios</strong> con permisos
        </div>
    </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>

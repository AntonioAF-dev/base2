<?php 
$pageTitle = "Dashboard";
include __DIR__ . '/layout/header.php';
include __DIR__ . '/layout/navbar.php';

$userRole = $_SESSION['user_role'] ?? '';
?>

<div class="page-header">
    <h1>👋 Bienvenido, <?php echo htmlspecialchars($user['name']); ?>!</h1>
    <a href="index.php?page=logout" class="btn btn-secondary">🚪 Cerrar Sesión</a>
</div>

<div class="card">
    <h2>Información de Usuario</h2>
    <div class="form-row">
        <div class="form-group">
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        </div>
        <div class="form-group">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        </div>
        <div class="form-group">
            <p><strong>Rol:</strong> <span class="badge badge-<?php 
                echo $userRole === 'Administrador' ? 'success' : 
                     ($userRole === 'Profesor' ? 'info' : 'secondary'); 
            ?>"><?php echo htmlspecialchars($user['role']); ?></span></p>
        </div>
    </div>
</div>

<?php if ($userRole === 'Administrador'): ?>
<!-- ==================== DASHBOARD ADMINISTRADOR ==================== -->
<div class="info-section">
    <h2>🎛️ Panel de Administración</h2>
    <div class="features-grid">
        <div class="feature-card">
            <h3>👥 Gestión de Usuarios</h3>
            <p>Crear, editar y administrar usuarios del sistema</p>
            <a href="index.php?page=usuarios" class="btn btn-success">Gestionar Usuarios</a>
        </div>
        
        <div class="feature-card">
            <h3>📊 Vistas del Sistema</h3>
            <p>Consulta las 5 vistas con datos relacionados</p>
            <a href="index.php?page=vistas" class="btn btn-primary">Ver Vistas</a>
        </div>
        
        <div class="feature-card">
            <h3>📚 Gestión de Cursos</h3>
            <p>Administra todos los cursos del sistema</p>
            <a href="index.php?page=cursos" class="btn btn-primary">Ver Cursos</a>
        </div>
        
        <div class="feature-card">
            <h3>✍️ Inscripciones</h3>
            <p>Administra inscripciones de estudiantes</p>
            <a href="index.php?page=inscripciones" class="btn btn-primary">Ver Inscripciones</a>
        </div>
        
        <div class="feature-card">
            <h3>💰 Gestión de Pagos</h3>
            <p>Administra pagos y transacciones</p>
            <a href="index.php?page=pagos" class="btn btn-primary">Ver Pagos</a>
        </div>
        
        <div class="feature-card">
            <h3>👨‍🎓 Estudiantes</h3>
            <p>Gestiona información de estudiantes</p>
            <a href="index.php?page=estudiantes" class="btn btn-primary">Ver Estudiantes</a>
        </div>
        
        <div class="feature-card">
            <h3>📝 Calificaciones</h3>
            <p>Administra notas y evaluaciones</p>
            <a href="index.php?page=notas" class="btn btn-primary">Ver Notas</a>
        </div>
        
        <div class="feature-card">
            <h3>⚙️ Funciones del Sistema</h3>
            <p>Prueba las funciones con IF y CASE</p>
            <a href="index.php?page=funciones" class="btn btn-primary">Probar Funciones</a>
        </div>
    </div>
</div>

<?php elseif ($userRole === 'Profesor'): ?>
<!-- ==================== DASHBOARD PROFESOR ==================== -->
<div class="info-section">
    <h2>👨‍🏫 Panel del Profesor</h2>
    <div class="features-grid">
        <div class="feature-card">
            <h3>📚 Mis Cursos</h3>
            <p>Administra tus cursos y contenidos</p>
            <a href="index.php?page=cursos" class="btn btn-primary">Ver Mis Cursos</a>
            <a href="index.php?page=cursos&action=crear" class="btn btn-success" style="margin-top: 10px;">Crear Nuevo Curso</a>
        </div>
        
        <div class="feature-card">
            <h3>✍️ Inscripciones</h3>
            <p>Ver estudiantes inscritos en tus cursos</p>
            <a href="index.php?page=inscripciones" class="btn btn-primary">Ver Inscripciones</a>
        </div>
        
        <div class="feature-card">
            <h3>👨‍🎓 Mis Estudiantes</h3>
            <p>Lista de estudiantes en tus cursos</p>
            <a href="index.php?page=estudiantes" class="btn btn-primary">Ver Estudiantes</a>
        </div>
        
        <div class="feature-card">
            <h3>📝 Calificaciones</h3>
            <p>Registra y administra calificaciones</p>
            <a href="index.php?page=notas" class="btn btn-primary">Gestionar Notas</a>
        </div>
        
        <div class="feature-card">
            <h3>📊 Reportes</h3>
            <p>Consulta reportes y estadísticas</p>
            <a href="index.php?page=vistas" class="btn btn-primary">Ver Reportes</a>
        </div>
        
        <div class="feature-card">
            <h3>🔍 Búsqueda Avanzada</h3>
            <p>Busca estudiantes, inscripciones y notas</p>
            <a href="index.php?page=inscripciones&action=buscar" class="btn btn-primary">Buscar</a>
        </div>
    </div>
</div>

<div class="card">
    <h2>💡 Acciones Rápidas</h2>
    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <a href="index.php?page=cursos&action=crear" class="btn btn-success">+ Crear Curso</a>
        <a href="index.php?page=inscripciones&action=buscar" class="btn btn-primary">🔍 Buscar Inscripciones</a>
        <a href="index.php?page=notas&action=buscar" class="btn btn-primary">🔍 Buscar Notas</a>
    </div>
</div>

<?php elseif ($userRole === 'Estudiante'): ?>
<!-- ==================== DASHBOARD ESTUDIANTE ==================== -->
<div class="info-section">
    <h2>👨‍🎓 Mi Panel de Estudiante</h2>
    <div class="features-grid">
        <div class="feature-card">
            <h3>📚 Cursos Disponibles</h3>
            <p>Explora y busca cursos disponibles</p>
            <a href="index.php?page=cursos" class="btn btn-primary">Ver Catálogo</a>
            <a href="index.php?page=cursos&action=buscar" class="btn btn-secondary" style="margin-top: 10px;">🔍 Buscar Cursos</a>
        </div>
        
        <div class="feature-card">
            <h3>✍️ Mis Inscripciones</h3>
            <p>Cursos en los que estás inscrito</p>
            <a href="index.php?page=inscripciones&action=mis-inscripciones" class="btn btn-primary">Ver Mis Inscripciones</a>
        </div>
        
        <div class="feature-card">
            <h3>📝 Mis Calificaciones</h3>
            <p>Consulta tus notas y evaluaciones</p>
            <a href="index.php?page=notas&action=mis-notas" class="btn btn-primary">Ver Mis Notas</a>
        </div>
        
        <div class="feature-card">
            <h3>💰 Mis Pagos</h3>
            <p>Historial de pagos y transacciones</p>
            <a href="index.php?page=pagos&action=mis-pagos" class="btn btn-primary">Ver Pagos</a>
        </div>
    </div>
</div>

<div class="card">
    <h2>📊 Mi Progreso</h2>
    <p>Aquí podrás ver tu progreso en los cursos inscritos.</p>
    <div class="info-grid">
        <div class="info-item">
            <strong>Cursos Activos</strong><br>
            <span style="font-size: 2em;">-</span>
        </div>
        <div class="info-item">
            <strong>Cursos Completados</strong><br>
            <span style="font-size: 2em;">-</span>
        </div>
        <div class="info-item">
            <strong>Promedio General</strong><br>
            <span style="font-size: 2em;">-</span>
        </div>
    </div>
    <p class="text-muted" style="margin-top: 1rem;">
        <small>📌 Nota: Las estadísticas se actualizarán a medida que completes cursos.</small>
    </p>
</div>

<?php else: ?>
<!-- ==================== DASHBOARD GENÉRICO (Sin rol definido) ==================== -->
<div class="alert alert-warning">
    <h3>⚠️ Rol no Reconocido</h3>
    <p>Tu cuenta no tiene un rol asignado correctamente. Por favor, contacta al administrador.</p>
    <p><strong>Rol actual:</strong> <?php echo htmlspecialchars($userRole); ?></p>
</div>

<?php endif; ?>

<div class="info-section">
    <h2>ℹ️ Información del Sistema</h2>
    <div class="info-grid">
        <div class="info-item">
            <strong>✅ 5 Vistas</strong> con JOINs
        </div>
        <div class="info-item">
            <strong>✅ 7 Procedimientos</strong> almacenados
        </div>
        <div class="info-item">
            <strong>✅ 4 Funciones</strong> con IF y CASE
        </div>
        <div class="info-item">
            <strong>✅ 11 Triggers</strong> activos
        </div>
        <div class="info-item">
            <strong>✅ Sistema de Roles</strong> implementado
        </div>
        <div class="info-item">
            <strong>✅ Autenticación</strong> segura
        </div>
    </div>
</div>

<?php include __DIR__ . '/layout/footer.php';
?>
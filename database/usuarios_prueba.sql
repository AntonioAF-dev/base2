<!-- =======================================================
/*ARCHIVO: database/usuarios_prueba.sql
Datos de usuarios para pruebas
======================================================= -->*/

-- Insertar usuarios de prueba (contraseñas ya hasheadas con PHP)
-- Contraseñas en texto plano: admin123, pass123, pass456

-- Admin
INSERT INTO Usuario
    (NomUsu, ApeUsu, EmailUsu, PassUsu, RolUsu, FechaRegUsu)
VALUES
    ('Administrador', 'del Sistema', 'admin@sistema.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Administrador', CURDATE());

-- Actualizar usuarios existentes con roles correctos
UPDATE Usuario SET RolUsu = 'Profesor' WHERE EmailUsu = 'juan.perez@mail.com';
UPDATE Usuario SET RolUsu = 'Estudiante' WHERE EmailUsu = 'maria.garcia@mail.com';
UPDATE Usuario SET RolUsu = 'Profesor' WHERE EmailUsu = 'carlos.lopez@mail.com';
UPDATE Usuario SET RolUsu = 'Estudiante' WHERE EmailUsu = 'ana.martinez@mail.com';

-- Script PHP para generar hashes de contraseña
-- Ejecutar en un archivo PHP aparte:
/*
<?php
echo password_hash('admin123', PASSWORD_DEFAULT) . "\n";
echo password_hash('pass123', PASSWORD_DEFAULT) . "\n";
echo password_hash('pass456', PASSWORD_DEFAULT) . "\n";
?>
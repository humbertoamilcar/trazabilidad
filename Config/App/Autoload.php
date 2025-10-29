<?php
/**
 * Autoload multi-directorio con soporte básico de namespaces.
 * Ubicación: /pventas/Config/App/Autoload.php
 */
spl_autoload_register(function (string $class) {
    // Raíz del proyecto: /pventas
    $root = dirname(__DIR__, 2);

    // Directorios donde buscar clases (en orden)
    $bases = [
        $root . '/Config/App',   // Conexion, Controller, Query, etc.
        $root . '/Controllers',  // Home, AuthController, etc.
        $root . '/Models',       // UsuariosModel, etc.
        $root . '/Libraries',    // libs propias
        $root . '/Views',        // opcional: helpers en Views
    ];

    // Soporta namespaces: App\Models\User -> App/Models/User.php
    $relative = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    foreach ($bases as $base) {
        // 1) Ruta con subcarpetas (namespaces)
        $file = $base . DIRECTORY_SEPARATOR . $relative;
        if (is_file($file)) {
            require_once $file;
            return true;
        }
        // 2) Ruta “plana” (sin namespaces): Controllers/Home.php -> class Home
        $flat = $base . DIRECTORY_SEPARATOR . $class . '.php';
        if (is_file($flat)) {
            require_once $flat;
            return true;
        }
    }

    // Log en modo DEBUG si no se encontró la clase
    if (defined('DEBUG') && DEBUG) {
        error_log("[AUTOLOAD] Clase no encontrada: {$class}");
    }
    return false;
});

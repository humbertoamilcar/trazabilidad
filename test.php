<?php
/**
 * Autoload simple con soporte para múltiples directorios y namespaces.
 * Colocar en: pventas/Config/App/Autoload.php
 */
spl_autoload_register(function (string $class) {
    // Directorio raíz del proyecto (pventas/)
    $root = dirname(__DIR__, 2);

    // Rutas base donde buscar clases (en orden de prioridad)
    $bases = [
        $root . '/Config/App',  // Conexion, Controller, Query, Views, etc.
        $root . '/Controllers',
        $root . '/Models',
        $root . '/Libraries',
        $root . '/Views',       // opcional: por si tienes helpers/clases aquí
    ];

    // Soporte para namespaces: Foo\Bar\Clase -> Foo/Bar/Clase.php
    $relative = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    foreach ($bases as $base) {
        $file = $base . DIRECTORY_SEPARATOR . $relative;
        if (is_file($file)) {
            require_once $file;
            return true;
        }
        // También intenta sin subcarpetas por si no usas namespaces: Clase.php
        $flat = $base . DIRECTORY_SEPARATOR . $class . '.php';
        if (is_file($flat)) {
            require_once $flat;
            return true;
        }
    }

    // Opcional: loguea en DEBUG si no encontró la clase
    if (defined('DEBUG') && DEBUG) {
        error_log("[AUTOLOAD] No se encontró la clase: {$class}");
    }
    return false;
});

<?php
// index.php (raíz)
declare(strict_types=1);

// Rutas absolutas robustas
define('BASE_PATH', __DIR__);

// Config y Autoload
require_once BASE_PATH . '/Config/Config.php';
require_once BASE_PATH . '/Config/App/Autoload.php'; // OJO: "Autoload.php" con A mayúscula

// Leer y sanear la ruta
$raw = $_GET['url'] ?? 'Home/index';
$path = trim($raw, "/");
$path = filter_var($path, FILTER_SANITIZE_URL);

// Partes: controlador / método / params...
$parts = $path !== '' ? explode('/', $path) : ['Home', 'index'];

$controller = $parts[0] ?? 'Home';
$metodo     = $parts[1] ?? 'index';
$params     = array_slice($parts, 2);

// Archivo del controlador (por si no usas namespaces y autoload no lo encuentra)
$controllerFile = BASE_PATH . "/Controllers/{$controller}.php";
if (is_file($controllerFile)) {
    require_once $controllerFile;
}

// Instanciar
if (!class_exists($controller)) {
    http_response_code(404);
    exit('No existe el controlador');
}

$instance = new $controller();

// Llamar método
if (!method_exists($instance, $metodo)) {
    http_response_code(404);
    exit('No existe el método');
}

// Pasar parámetros como string (compatibilidad con tu firma)
$parametro = implode(',', $params);
$instance->$metodo($parametro);

<?php
declare(strict_types=1);

// Sube un nivel desde /Config/App a /Config
require_once __DIR__ . '/../Config.php';

class Conexion {
    private $conect;

    public function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

        try {
            $this->conect = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            if (defined('DEBUG') && DEBUG) {
                die("Error en la conexión: " . $e->getMessage());
            }
            die("Error en la conexión a la base de datos.");
        }
    }

    public function conect() { return $this->conect; }
    public function ping(): bool {
        try { $this->conect->query('SELECT 1'); return true; }
        catch (Throwable $e) { return false; }
    }
}

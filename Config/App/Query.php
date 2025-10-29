<?php 
class Query extends Conexion {
    private $pdo, $con, $sql, $datos;

    public function __construct() {
        $this->pdo = new Conexion();
        $this->con = $this->pdo->conect();
    }

    // Obtener un solo registro
    public function select(string $sql, array $datos = []) {
        $this->sql = $sql;
        $this->datos = $datos;
        $stmt = $this->con->prepare($this->sql);
        $stmt->execute($this->datos);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    // Obtener múltiples registros
    public function selectAll(string $sql, array $datos = []) {
        $this->sql = $sql;
        $this->datos = $datos;
        $stmt = $this->con->prepare($this->sql);
        $stmt->execute($this->datos);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    // Ejecutar INSERT, UPDATE o DELETE
    public function save(string $sql, array $datos = []) {
        $this->sql = $sql;
        $this->datos = $datos;
        $stmt = $this->con->prepare($this->sql);
        $data = $stmt->execute($this->datos);
        $res = $data ? 1 : 0;
        return $res;
    }

    // Ejecutar consultas que no devuelven datos
    public function execute(string $sql, array $datos = []) {
        $this->sql = $sql;
        $this->datos = $datos;
        $stmt = $this->con->prepare($this->sql);
        $res = $stmt->execute($this->datos);
        return $res;
    }
}
?>

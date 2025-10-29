<?php
class Productos extends Controller
{
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index() {
        if (empty($_SESSION["activo"])) {
            header("location: " . base_url);
            exit;
        }

        // Estos métodos existen en tu modelo actual
 $data['empresa'] = $this->model->getEmpresa();

        $this->views->getView($this, "index", $data);
    }

public function listar() {
    $data = $this->model->ListarProductos();

    for ($i = 0; $i < count($data); $i++) {
        // Mostrar imagen
        $foto = !empty($data[$i]['imagen']) ? $data[$i]['imagen'] : 'default.jpg';
        $data[$i]['imagen'] = '<img class="img-thumbnail" width="50" height="50" src="' 
            . base_url . 'Assets/img/products/' . htmlspecialchars($foto) . '">';

        // Generar acciones según estado
        if ((int)$data[$i]['estado'] === 1) {
            $data[$i]['acciones'] = '
                <div class="d-flex align-items-center justify-content-center">
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical text-primary"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="btnDetalles(' . $data[$i]['id'] . '); return false;">
                                    <i class="fa fa-qrcode text-primary me-2"></i> Detalles
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="btnCambiarPass(' . $data[$i]['id'] . '); return false;">
                                    <i class="fa fa-key text-purple me-2"></i> Ver Datos
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="btnEliminarPro(' . $data[$i]['id'] . '); return false;">
                                    <i class="fa fa-trash text-danger me-2"></i> Poner en Inactivo
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a href="#" onclick="btnEditarPro(' . $data[$i]['id'] . '); return false;" class="btn btn-sm btn-icon ms-1">
                        <i class="ti ti-pencil text-primary"></i>
                    </a>
                </div>';
        } else {
            $data[$i]['acciones'] = '
                <div class="d-flex align-items-center justify-content-center">
 
                    <div class="dropdown ms-1">
                        <a href="javascript:void(0);" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical text-danger"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="btnReingresarPro(' . $data[$i]['id'] . '); return false;">
                                    <i class="fa fa-undo text-primary me-2"></i> Reingresar
                                </a>
                            </li>
                        </ul>
                    </div>
                                <a href="#" onclick="btnDetalles(' . $data[$i]['id'] . '); return false;" class="btn btn-sm btn-icon">
                        <i class="fa fa-eye text-primary"></i>
                    </a>
                </div>';
        }
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}





    public function registrar() {
        // Campos
        $codigo         = trim($_POST['codigo'] ?? '');
        $nombre         = trim($_POST['nombre'] ?? '');
        $precio_compra  = trim($_POST['precio_compra'] ?? '');
        $precio_venta   = trim($_POST['precio_venta'] ?? '');
        $medida         = (int)($_POST['medida'] ?? 0);
        $categoria      = (int)($_POST['categoria'] ?? 0);
        $id             = (int)($_POST['id'] ?? 0);

        // Validaciones básicas
        if ($codigo === '' || $nombre === '' || $precio_compra === '' || $precio_venta === '' || $medida === 0 || $categoria === 0) {
            echo json_encode("Todos los campos son obligatorios", JSON_UNESCAPED_UNICODE); die();
        }
        if (strlen($codigo) > 10) { echo json_encode("Código demasiado largo (máx 10)", JSON_UNESCAPED_UNICODE); die(); }
        if (strlen($nombre) > 50) { echo json_encode("Descripción demasiado larga (máx 50)", JSON_UNESCAPED_UNICODE); die(); }
        if (!is_numeric($precio_compra) || !is_numeric($precio_venta)) { echo json_encode("Precios inválidos", JSON_UNESCAPED_UNICODE); die(); }
        if ($precio_venta < $precio_compra) { echo json_encode("El precio de venta no puede ser menor al de compra", JSON_UNESCAPED_UNICODE); die(); }

        // Archivo
        $img         = $_FILES['imagen'] ?? null;
        $name        = $img['name'] ?? '';
        $tmpname     = $img['tmp_name'] ?? '';
        $foto_actual = $_POST['foto_actual'] ?? '';
        $rutaUpload  = "Assets/img/products/";

        // Asegura carpeta
        if (!is_dir($rutaUpload)) { @mkdir($rutaUpload, 0775, true); }

        // Nombre final
        $imgNombre = "default.jpg";

        // Si hay nueva imagen: valida y genera nombre único
        if (!empty($name) && is_uploaded_file($tmpname)) {
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $permitidas = ['jpg','jpeg','png','webp'];
            if (!in_array($ext, $permitidas, true)) {
                echo json_encode("Formato de imagen no permitido", JSON_UNESCAPED_UNICODE); die();
            }
            $imgNombre = date("YmdHis") . "_" . bin2hex(random_bytes(4)) . "." . $ext;
            $destino = $rutaUpload . $imgNombre;
        } elseif (!empty($foto_actual)) {
            // Si no se sube nueva, conserva la actual
            $imgNombre = $foto_actual;
        }

        // Alta o edición (usa los nombres reales de tu modelo)
        if ($id === 0) {
            // registrarproducto(...)
            $data = $this->model->registrarproducto($codigo, $nombre, $precio_compra, $precio_venta, $medida, $categoria, $imgNombre);

            if ($data == "ok") {
                if (!empty($name) && isset($destino)) { move_uploaded_file($tmpname, $destino); }
                $msg = "si";
            } elseif ($data == "existe") {
                $msg = "El Producto ya existe";
            } else {
                $msg = "Error al registrar el Producto";
            }
        } else {
            // modificarproducto(...)
            // Solo borrar la vieja si llegó una nueva y la anterior no es default
            if (!empty($name) && !empty($foto_actual) && $foto_actual !== 'default.jpg') {
                $old = $rutaUpload . $foto_actual;
                if (file_exists($old)) { @unlink($old); }
            }

            $data = $this->model->modificarproducto($codigo, $nombre, $precio_compra, $precio_venta, $medida, $categoria, $imgNombre, $id);

            if ($data == "modificado") {
                if (!empty($name) && isset($destino)) { move_uploaded_file($tmpname, $destino); }
                $msg = "modificado";
            } elseif ($data == "existe") {
                $msg = "El Producto ya existe";
            } else {
                $msg = "Error al actualizar el Producto";
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

   public function editar($id) {
    $id = (int)$id;           // <- casteo robusto
    $data = $this->model->editarPro($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}

public function eliminar($id) {
    $id = (int)$id;           // <- casteo
    $data = $this->model->accionPro(0, $id);
    $msg  = ($data == 1) ? "ok" : "Error al eliminar el Producto";
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}

public function reingresar($id) {
    $id = (int)$id;           // <- casteo
    $data = $this->model->accionPro(1, $id);
    $msg  = ($data == 1) ? "ok" : "Error al activar el Producto";
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}

    public function salir() {
        session_destroy();
        header("location: " . base_url);
        exit;
    }
}

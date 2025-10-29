<?php
class Usuarios extends Controller {

    public function __construct() {
        parent::__construct();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Tiempo de inactividad permitido (5 minutos = 300 seg)
        $timeout = 300000;

        if (isset($_SESSION['LAST_ACTIVITY'])) {
            $inactivo = time() - $_SESSION['LAST_ACTIVITY'];
            if ($inactivo > $timeout) {
                session_unset();
                session_destroy();
                header("location: ".base_url."Usuarios/login");
                exit;
            }
        }

        $_SESSION['LAST_ACTIVITY'] = time();
    }

    // Vista login
    public function login() {
        $this->views->getView($this, "login");
    }

    // Dashboard
    public function index() {
        if (empty($_SESSION["activo"])) {
            header("location: ".base_url."Usuarios/login");
        }
        $data['usuarios'] = $this->model->getUsuarios();
        $data['rol'] = $this->model->getRol();
        $data['empresa'] = $this->model->getEmpresa();
        $this->views->getView($this, "index", $data);
    }

    // Validación de acceso
    public function validar() {
        if (empty($_POST['correo']) || empty($_POST['password'])) {
            $msg = "Los campos no pueden estar vacíos";
        } else {
            $correo = $_POST['correo'];
            $password = $_POST['password'];
            $hash = hash("SHA256", $password);

            $data = $this->model->getUsuario($correo, $hash);
            if ($data) {
                $_SESSION['id_usuario'] = $data['id_usuario'];
                $_SESSION['nombre'] = $data['nombres'];
                $_SESSION['apellidos'] = $data['apellidos'];
                $_SESSION['correo'] = $data['correo'];
                $_SESSION['rol'] = $data['rol'];
                $_SESSION['fotousuario'] = $data['foto'];
                $_SESSION['id_empresa'] = $data['id_empresa'];
                $_SESSION['empresa'] = $data['razon_social'];
                $_SESSION['activo'] = true;

                $this->model->actualizarIngresos($correo, $hash); // Llamamos a un método para actualizar los ingresos
                $msg = "ok";
            } else {
                $msg = "El correo y la contraseña no coinciden, intente de nuevo";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Listar usuarios
public function listar() {
    $data = $this->model->getUsuarios();

    for ($i = 0; $i < count($data); $i++) {
        // Forzar id a entero (evita error en JS/PHP strict typing)
        $data[$i]['id'] = (int)$data[$i]['id'];

        if ($data[$i]['estado'] == 1) {
            $data[$i]['acciones'] = '
            <div class="d-inline-block">
                <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="text-primary ti ti-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end m-0">
                    <li><a class="dropdown-item text-primary" href="#" onclick="btnDetalles('.$data[$i]['id'].');">
                        <i class="fa fa-star text-primary me-1"></i> Detalles</a>
                    </li>
                    <li><a class="dropdown-item text-primary" href="#" onclick="btnCambiarPass('.$data[$i]['id'].');">
                        <i class="fa fa-key text-primary me-1"></i> Cambiar Contraseña</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" onclick="btnEliminarUser('.$data[$i]['id'].');">
                        <i class="fa fa-eraser text-danger me-1"></i> Eliminar</a>
                    </li>
                </ul>
            </div>
            <a href="#" onclick="btnEditarUser('.$data[$i]['id'].');" class="btn btn-sm btn-icon item-edit">
                <i class="text-primary ti ti-pencil"></i>
            </a>';
        } else {
            $data[$i]['acciones'] = '
            <div class="d-inline-block">
                <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="text-primary ti ti-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end m-0">
                    <li><a class="dropdown-item text-warning" href="#" onclick="btnReingresarUser('.$data[$i]['id'].');">
                        <i class="fa fa-star text-warning me-1"></i> Reingresar Usuario</a>
                    </li>
                </ul>
            </div>';
        }
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}



    // Registrar o modificar
    public function registrar() {
        $id_usuario = $_POST['id_usuario'];
        $id_empresa = $_POST['almacen'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $documento = $_POST['documento'];
        $celular = $_POST['celular'];
        $correo = $_POST['correo'];
        $rol = $_POST['rol'];
        $foto = $_POST['foto'] ?? '';
        $password = $_POST['password'];
        $confirmar = $_POST['confirmar'];

        if (empty($nombres) || empty($apellidos) || empty($correo)) {
            $msg = array('msg' =>'Todos los campos obligatorios', 'icono'=>'warning','titulo'=>'ADVERTENCIA');
        } else {
            if ($id_usuario == "") {
                if ($password != $confirmar) {
                    $msg = array('msg' =>'Las contraseñas no coinciden', 'icono'=>'warning','titulo'=>'ADVERTENCIA');
                } else {
                    $hash = hash("SHA256", $password);
                    $data = $this->model->registrarUsuario($id_empresa, $nombres, $apellidos, $documento, $foto, $celular, $correo, $hash, $rol);
                    if ($data == "ok") {
                        $msg = array('msg'=>'Usuario registrado con éxito', 'icono'=>'success','titulo'=>'ÉXITO');
                    } elseif ($data == "existe") {
                        $msg = array('msg'=>'El correo o documento ya existe', 'icono'=>'warning','titulo'=>'DUPLICADO');
                    } else {
                        $msg = array('msg'=>'Error al registrar usuario', 'icono'=>'error','titulo'=>'ERROR');
                    }
                }
            } else {
                $data = $this->model->modificarUsuario($id_usuario, $id_empresa, $nombres, $apellidos, $documento, $celular, $correo, $rol, $foto);
                if ($data == "modificado") {
                    $msg = array('msg'=>'Usuario modificado correctamente', 'icono'=>'success','titulo'=>'ACTUALIZADO');
                } else {
                    $msg = array('msg'=>'Error al modificar usuario', 'icono'=>'error','titulo'=>'ERROR');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

public function editar($id) {
    $id = (int) $id; // aseguramos que sea número
    $data = $this->model->getUsuarioPorId($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}


public function eliminar($id) {
    $id = (int)$id;
    $data = $this->model->accionUsuario(0, $id);
    if ($data == 1) {
        $msg = array('msg' =>'Usuario dado de Baja' , 'icono'=>'success','titulo'=>'ADVETENCIA ESTADO ACTUALIZADO !!!!');
    } else {
        $msg = array('msg' =>'Error no se puede activar' , 'icono'=>'error','titulo'=>'ERROR !!!!');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}


 public function reingresar($id) {
    $id = (int)$id; // forzamos a entero
    $data = $this->model->accionUsuario(1, $id);

    if ($data == 1) {
        $msg = array('msg' => 'Usuario activado', 'icono' => 'success', 'titulo' => 'USUARIO REINGRESADO !!!!');
    } else {
        $msg = array('msg' => 'Error no se puede activar', 'icono' => 'error', 'titulo' => 'ERROR !!!!');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}


    public function cambiarPass() {
        $actual = $_POST['clave_actual'];
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['confirmar_clave'];

        if (empty($actual) || empty($nueva) || empty($confirmar)) {
            $mensaje = array('msg'=>'Todos los campos son obligatorios','icono'=>'warning','titulo'=>'ADVERTENCIA');
        } elseif ($nueva != $confirmar) {
            $mensaje = array('msg'=>'Las contraseñas no coinciden','icono'=>'warning','titulo'=>'ADVERTENCIA');
        } else {
            $id = $_SESSION['id_usuario'];
            $hash = hash("SHA256", $actual);
            $data = $this->model->getPass($hash, $id);

            if (!empty($data)) {
                $verificar = $this->model->modificarPass(hash("SHA256", $nueva), $id);
                if ($verificar==1) {
                    $mensaje = array('msg'=>'Contraseña modificada con éxito','icono'=>'success','titulo'=>'ÉXITO');
                } else {
                    $mensaje = array('msg'=>'Error al modificar contraseña','icono'=>'error','titulo'=>'ERROR');
                }
            } else {
                $mensaje = array('msg'=>'La contraseña actual es incorrecta','icono'=>'warning','titulo'=>'ADVERTENCIA');
            }
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir() {
        session_destroy();
        header("location: ".base_url);
    }
}

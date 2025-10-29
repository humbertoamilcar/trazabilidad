<?php 
class Clientes extends Controller{
	
	public function __construct(){
		session_start();
		if (empty($_SESSION["activo"])) {
			header("location: ".base_url);
		}
		parent::__construct();
	}

	public function index()
	{
		$this->views->getView($this,"index");
	}

public function listar()
{
    $data = $this->model->getClientes();

    for ($i = 0; $i < count($data); $i++) {
        // Estado activo
        if ($data[$i]['estado'] == 1) {

            // Acciones para usuarios activos
            $data[$i]['acciones'] = '
                <div class="d-inline-block">
                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="text-primary ti ti-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end m-0">
                        <li>
                            <a class="dropdown-item" href="#" onclick="btnDetallesCli('.$data[$i]['id'].');">
                                <i class="fa fa-star text-primary me-1"></i> Detalles
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="btnCambiarPassCli('.$data[$i]['id'].');">
                                <i class="fa fa-key text-primary me-1"></i> Cambiar Contraseña
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" onclick="btnEliminarCli('.$data[$i]['id'].');">
                                <i class="fa fa-eraser text-danger me-1"></i> Eliminar
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="javascript:;" onclick="btnEditarCli('.$data[$i]['id'].');" class="btn btn-sm btn-icon item-edit">
                    <i class="text-primary ti ti-pencil"></i>
                </a>
            ';

        } else {
            // Estado inactivo
            $data[$i]['estado'] = '<div class="demo-inline-spacing">
                                        <span class="badge rounded-pill bg-warning bg-glow">
                                            <i class="ti ti-folder"></i> INACTIVO
                                        </span>
                                    </div>';

            // Acciones para usuarios inactivos
            $data[$i]['acciones'] = '
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown">
                        <i class="ti ti-menu-2 ti-xs me-1"></i> Acciones
                    </button>
                    <ul class="dropdown-menu">
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="btnReingresarCli('.$data[$i]['id'].');">
                                <i class="fa fa-check text-success me-1"></i> Activar
                            </a>
                        </li>
                    </ul>
                </div>
            ';
        }
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}

	
	
		public function registrar(){
		    $dni = $_POST['dni'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $id = $_POST['id'];

    // Ya no validamos si el DNI está vacío
    if (empty($nombres)) {
        $msg = "Todos los campos son obligatorios";
    } else {
        if ($id == "") {
            // Puedes eliminar la referencia al DNI aquí si ya no es relevante
            $data = $this->model->registrarCliente($dni, $nombres, $apellidos, $telefono, $direccion);
            if ($data == "ok") {
                $msg = "si";
          
            } else {
                $msg = "Error al registrar al Cliente";
            }
        } else {
            $data = $this->model->modificarCliente($dni, $nombres, $apellidos, $telefono, $direccion, $id);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "Error al modificar el Cliente";
            }
        }
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
	}



	public function editar(int $id)
	{
		$data=$this->model->editarCli($id);
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die();
	}

	public function eliminar(int $id){
		$data=$this->model->accionCli(0,$id);
		if ($data==1) {
			$msg="ok";
		}else{
			$msg="Error al eliminar el Usuario";
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();

	}

	public function reingresar(int $id){
		$data=$this->model->accionCli(1,$id);
		if ($data==1) {
			$msg="ok";
		}else{
			$msg="Error al activar al Cliente";
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();

	}



}


 ?>

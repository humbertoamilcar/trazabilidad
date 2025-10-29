<?php 
class Categorias extends Controller{
	
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
		$data=$this->model->getCategorias();
		for ($i=0; $i < count($data); $i++) {
			if ($data[$i]['estado'] == 1) {
				$data[$i]['estado']='<div class="demo-inline-spacing">
					                    <span class="badge rounded-pill bg-primary bg-glow">
					                    <i class="ti ti-sun"></i>
					                    ACTIVO</span>
					                </div>';

				$data[$i]['acciones']='
                              <div class="btn-group">
					                      <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light show"
					                        data-bs-toggle="dropdown" aria-expanded="true">
					                        <i class="ti ti-menu-2 ti-xs me-1"> </i>	

					                        Acciones
					                      </button>
					                      <ul class="dropdown-menu">
					                        <li><a class="dropdown-item" href="#" onclick="btnEliminarCat('.$data[$i]['id'].');"> <i class="fa fa-eraser  text-warning me-1"></i> Eliminar</a></li>
					                        <li><a class="dropdown-item" href="#" onclick="btnEditarCat('.$data[$i]['id'].');"> <i class="fa fa-close  text-warning text-success me-1"></i>Editar</a></li>
					                        
					                        <li>
					                          <hr class="dropdown-divider" />
					                        </li>
					                        <li><a class="dropdown-item" href="#" onclick="btnAsignarPass('.$data[$i]['id'].');"><i class="fa fa-key  text-warning text-success me-1"></i> Nueva Contraseña</a></li>
					                      </ul>
					                    </div>';
			}else{
				$data[$i]['estado']='<div class="demo-inline-spacing">
					                    <span class="badge rounded-pill bg-warning bg-glow">
					                    <i class="ti ti-folder"></i>
					                    INACTIVO</span>
					                </div>';
				$data[$i]['acciones']='<div class="btn-group">
                       <button type="button" class="btn btn-danger dropdown-toggle waves-effect waves-light show"
					                        data-bs-toggle="dropdown" aria-expanded="true">
					                        <i class="ti ti-menu-2 ti-xs me-1"> </i>
                        Acciones
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="#" onclick="btnReingresarCat('.$data[$i]['id'].');" > <i class="fa fa-check text-warning text-success me-1 " ></i>Activar</a></li>
                      </ul>
                    </div>
				';
			}
			
			
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die();

	}
	
	
	public function registrar(){
		
		$nombres=$_POST['nombres'];
		$id=$_POST['id'];
		if (empty($nombres)) 
		{
			$msg="El campo es Obligatorio";
		
		}else{
			if ($id=="") {
					$data=$this->model->registrarCategorias($nombres);
					if ($data=="ok") {
					$msg="si";
					}else if($data=="existe"){
						$msg="El Rol a registrar: ". $nombres ." ya existe";
					}else{
						$msg="Error al registrar la Categoria";
					}
			}else{
				$data=$this->model->modificarCategorias( $nombres, $id);
				if ($data=="modificado") {
					$msg="modificado";
				}else{
					$msg="Error al modificar Categorias";
				}	
			}
			
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();
	}



	public function editar(int $id)
	{
		$data=$this->model->editarCategorias($id);
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die();
	}

	public function eliminar(int $id){
		$data=$this->model->accionCategorias(0,$id);
		if ($data==1) {
			$msg="ok";
		}else{
			$msg="Error al eliminar la Categoria";
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();

	}

	public function reingresar(int $id){
		$data=$this->model->accionCategorias(1,$id);
		if ($data==1) {
			$msg="ok";
		}else{
			$msg="Error al activar la Categoria";
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();

	}



}


 ?>

<?php 
class Roles extends Controller{
	
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

	public function arqueo()
	{
		$this->views->getView($this,"arqueo");
	}

	public function listar(){
		$data=$this->model->getCajas('caja');
		

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
					                        <li><a class="dropdown-item" href="#" onclick="btnEliminarCaja('.$data[$i]['id'].');"> <i class="fa fa-eraser  font-size-16 text-danger me-1"></i> Eliminar</a></li>
					                        <li><a class="dropdown-item" href="#" onclick="btnEditarCaja('.$data[$i]['id'].');"> <i class="fa fa-pencil text-warning text-success me-1"></i>Editar</a></li>
					                        
					                        <li>
					                          <hr class="dropdown-divider" />
					                        </li>
					                        <li><a class="dropdown-item" href="#" onclick="btnAsignarPass('.$data[$i]['id'].');"><i class="fa fa-key font-size-16 text-danger me-1"></i> Nueva Contraseña</a></li>
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
                        <li><a class="dropdown-item" href="#" onclick="btnReingresarCaja('.$data[$i]['id'].');" > <i class="fa fa-check text-warning text-success me-1 " ></i>Activar</a></li>
                      </ul>
                    </div>
				';



			
			}
			
			
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die();

	}
	
	
	public function registrar(){
		
		$caja=$_POST['caja'];
		$id=$_POST['id'];
		if (empty($caja)) 
		{
			$msg="El campo es Obligatorio";
		
		}else{
			if ($id=="") {
					$data=$this->model->registrarCaja($caja);
					if ($data=="ok") {
					$msg="si";
					}else if($data=="existe"){
						$msg="El Rol a registrar: ". $caja ." ya existe";
					}else{
						$msg="Error al registrar al Nuevo Usuario";
					}
			}else{
				$data=$this->model->modificarCaja( $caja, $id);
				if ($data=="modificado") {
					$msg="modificado";
				}else{
					$msg="Error al modificar el Rol de Usuario";
				}	
			}
			
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function abrirArqueo(){
		
		$monto_inicial=$_POST['monto_inicial'];
		$fecha_apertura=date('Y-m-d');
		$id_usuario=$_SESSION['id_usuario'];
		$id=$_SESSION['id'];
		if (empty($monto_inicial) ) 
		{
			$msg=array('msg'=>'El Campo es obligatorios','icono'=>'warning','mensaje'=>'MENSAJE');
					
		}else{
					
					if ($id == "") {
						$data=$this->model->registrarArqueo($id_usuario,$monto_inicial,$fecha_apertura);
					if ($data=="ok") {
							$msg=array('msg'=>'Caja abierta con exito','icono'=>'success','mensaje'=>'MENSAJE');
					}else if($data=="existe"){
						
							$msg=array('msg'=>'La Caja ya esta abierta, si desea inicializar de nuevo elimine la caja aperturada','icono'=>'warning','mensaje'=>'MENSAJE');
					}else{
							$msg=array('msg'=>'Error al abrir la caja','icono'=>'error','mensaje'=>'MENSAJE');
					}
					}else{
						$data['monto_total']=$this->model->getVentas($id_usuario);
						$data['total_ventas']=$this->model->getTotalVentas($id_usuario);
						$data['inicial']=$this->model->getMontoInicial($id_usuario);
						$data=$this->model->actualizarArqueo($id_usuario,$monto_inicial,$fecha_apertura);
					if ($data=="ok") {
							$msg=array('msg'=>'Caja abierta con exito','icono'=>'success','mensaje'=>'MENSAJE');
					}else if($data=="existe"){
						
							$msg=array('msg'=>'La Caja ya esta abierta, si desea inicializar de nuevo elimine la caja aperturada','icono'=>'warning','mensaje'=>'MENSAJE');
					}else{
							$msg=array('msg'=>'Error al abrir la caja','icono'=>'error','mensaje'=>'MENSAJE');
					}

					}
			
			}
	
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function listar_arqueo()
	{
		$data=$this->model->getCajas('cierre_caja');
		

		for ($i=0; $i < count($data); $i++) {
			if ($data[$i]['estado'] == 1) {
			$data[$i]['estado']='<div class="demo-inline-spacing">
					                    <span class="badge rounded-pill bg-primary bg-glow">
					                    <i class="ti ti-sun"></i>
					                    CAJA ABIERTA</span>
					                </div>';

				$data[$i]['acciones']='
                              <div class="btn-group">
					                      <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light show"
					                        data-bs-toggle="dropdown" aria-expanded="true">
					                        <i class="ti ti-menu-2 ti-xs me-1"> </i>	

					                        Acciones
					                      </button>
					                      <ul class="dropdown-menu">
					                        <li><a class="dropdown-item" href="#" onclick="btnEliminarCaja('.$data[$i]['id'].');"> <i class="fa fa-eraser  font-size-16 text-danger me-1"></i> Eliminar</a></li>
					                        <li><a class="dropdown-item" href="#" onclick="btnEditarCaja('.$data[$i]['id'].');"> <i class="fa fa-pencil text-warning text-success me-1"></i>Editar</a></li>
					                        
					                        <li>
					                          <hr class="dropdown-divider" />
					                        </li>
					                        <li><a class="dropdown-item" href="#" onclick="btnAsignarPass('.$data[$i]['id'].');"><i class="fa fa-key font-size-16 text-danger me-1"></i> Nueva Contraseña</a></li>
					                      </ul>
					                    </div>';
			}else{
				$data[$i]['estado']='<div class="demo-inline-spacing">
					                    <span class="badge rounded-pill bg-warning bg-glow">
					                    <i class="ti ti-folder"></i>
					                    CAJA CERRADA</span>
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
                        <li><a class="dropdown-item" href="#" onclick="btnReingresarCaja('.$data[$i]['id'].');" > <i class="fa fa-check text-warning text-success me-1 " ></i>Activar</a></li>
                      </ul>
                    </div>
				';



			
			}
			
			
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die();

	}
	

	public function editar(int $id)
	{
		$data=$this->model->editarCaja($id);
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die();
	}

	public function eliminar(int $id){
		$data=$this->model->accionCaja(0,$id);
		if ($data==1) {
			$msg="ok";
		}else{
			$msg="Error al eliminar el Usuario";
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();

	}

	public function reingresar(int $id){
		$data=$this->model->accionCaja(1,$id);
		if ($data==1) {
			$msg="ok";
		}else{
			$msg="Error al activar al Cliente";
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();

	}

	public function getVentas(){
		$id_usuario=$_SESSION['id_usuario'];
		$data['monto_total']=$this->model->getVentas($id_usuario);
		$data['total_ventas']=$this->model->getTotalVentas($id_usuario);
		$data['inicial']=$this->model->getMontoInicial($id_usuario);
		$data['monto_general']=$data['monto_total']['total']+$data['inicial']['monto_inicial'];

		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die();


	}



}


 ?>

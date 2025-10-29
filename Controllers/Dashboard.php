<?php 
class Dashboard extends Controller{
	
	public function __construct(){
		session_start();
		parent::__construct();
	}

	public function index(){
		$data['usuarios']=$this->model->getDatos('usuarios');
		$data['clientes']=$this->model->getDatos('empresas');
		$data['productos']=$this->model->getDatos('productos');
		$data['products'] = $this->model->getTopProductos();
		$data['usuario'] = $this->model->getTopUsuario();
		$data['monto'] = $this->model->getMonto();

	//	$data['usuario'] = $this->model->getTopUsuario();
		$this->views->getView($this,"index", $data);
		
	}

	function reporteStock(){
		$data=$this->model->getStockMinimo();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die();
	}

	function reporteVendidos(){
		$data=$this->model->getStockVendidos();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die();
	}

		function getCusuarios(){
		$data=$this->model->getCusuarios();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die();

	}

	function getLproductos(){
		$data=$this->model->getLproductos();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die();

	}

	function getTopUsuario(){
		$data=$this->model->getTopUsuario();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die();
	}
	
}


 ?>

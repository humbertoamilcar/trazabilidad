<?php 
class CategoriasModel extends Query{
	private $nombres, $estado;
	public function __construct()
	{
		parent::__construct();
	}


	public function getCategorias()
	{
		$sql="SELECT * FROM categorias";

		//$sql="SELECT * FROM usuarios iNNER JOIN caja WHERE usuarios.id_caja=caja.id";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function registrarCategorias(string $nombres)
	{
		$this->nombres=$nombres;
		$verificar="SELECT * FROM categorias WHERE nombres='$this->nombres'";
		$existe=$this->select($verificar);
		if (empty($existe)) {
			$sql="INSERT INTO categorias(nombres) VALUES(?)";
			$datos=array($this->nombres);
			$data=$this->save($sql, $datos);
			if ($data==1) {
				$res="ok";
			}else{
				$res="error";
			}
		}else{
			$res="existe";
		}
		
		return $res;
	}

	public function modificarCategorias(string $nombres, int $id)
	{
		$this->nombres=$nombres;
		$this->id=$id;
		
			$sql="UPDATE categorias SET nombres=? WHERE id=?";
			$datos=array($this->nombres, $this->id);

			$data=$this->save($sql, $datos);
			if ($data==1) {
				$res="modificado";
			}else{
				$res="error";
			}
		
		return $res;
	}

	public function editarCategorias(int $id)
	{
		$sql="SELECT * FROM categorias WHERE id=$id";
		$data=$this->select($sql);
		return $data;
	}

	public function accionCategorias(int $estado, int $id)
	{
		$this->id=$id;
		$this->estado=$estado;
		$sql="UPDATE categorias SET estado=? WHERE id=?";
		$datos=array($this->estado, $this->id);
		$data=$this->save($sql,$datos);
		return $data;
	}
}
?>
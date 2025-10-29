<?php 
class MedidasModel extends Query{
	private $nombres,$nombrecorto, $estado;
	public function __construct()
	{
		parent::__construct();
	}


	public function getMedidas()
	{
		$sql="SELECT * FROM medidas";

		//$sql="SELECT * FROM usuarios iNNER JOIN caja WHERE usuarios.id_caja=caja.id";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function registrarMedidas(string $nombres,string $nombrecorto)
	{
		$this->nombres=$nombres;
		$this->nombrecorto=$nombrecorto;
		$verificar="SELECT * FROM medidas WHERE nombres='$this->nombres'";
		$existe=$this->select($verificar);
		if (empty($existe)) {
			$sql="INSERT INTO medidas(nombres,nombrecorto) VALUES(?,?)";
			$datos=array($this->nombres,$this->nombrecorto);
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

	public function modificarMedidas(string $nombres,string $nombrecorto, int $id)
	{
		$this->nombres=$nombres;
		$this->nombrecorto=$nombrecorto;
		$this->id=$id;
		
			$sql="UPDATE medidas SET nombres=?, nombrecorto=? WHERE id=?";
			$datos=array($this->nombres, $this->id);

			$data=$this->save($sql, $datos);
			if ($data==1) {
				$res="modificado";
			}else{
				$res="error";
			}
		
		return $res;
	}

	public function editarMedidas(int $id)
	{
		$sql="SELECT * FROM medidas WHERE id=$id";
		$data=$this->select($sql);
		return $data;
	}

	public function accionMedidas(int $estado, int $id)
	{
		$this->id=$id;
		$this->estado=$estado;
		$sql="UPDATE medidas SET estado=? WHERE id=?";
		$datos=array($this->estado, $this->id);
		$data=$this->save($sql,$datos);
		return $data;
	}
}
?>
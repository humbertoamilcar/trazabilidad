<?php 
class RolesModel extends Query{
	private $caja, $estado;
	public function __construct()
	{
		parent::__construct();
	}


	public function getCajas(string $table)
	{
		$sql="SELECT * FROM $table";
		//$sql="SELECT * FROM usuarios iNNER JOIN caja WHERE usuarios.id_caja=caja.id";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function registrarCaja(string $caja){
		$this->caja=$caja;
		$verificar="SELECT * FROM caja WHERE caja='$this->caja'";
		$existe=$this->select($verificar);
		if (empty($existe)) {
			$sql="INSERT INTO caja(caja) VALUES(?)";
			$datos=array($this->caja);
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

	public function registrarArqueo(int $id_usuario, string $monto_inicial, string $fecha_apertura){
		
		$verificar="SELECT * FROM cierre_caja WHERE id_usuario='$id_usuario' AND estado=1";
		$existe=$this->select($verificar);
		if (empty($existe)) {
			$sql="INSERT INTO cierre_caja(id_usuario,monto_inicial, fecha_apertura) VALUES(?,?,?)";
			$datos=array($id_usuario, $monto_inicial,$fecha_apertura);
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

	public function getVentas(int $id_user){
		
		$sql="SELECT sum(total) as total FROM ventas WHERE id_usuario=$id_user AND estado=1 AND apertura=1";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function getTotalVentas(int $id_user){
		
		$sql="SELECT count(total) as total FROM ventas WHERE id_usuario=$id_user AND estado=1 AND apertura=1";
		$data=$this->selectAll($sql);
		return $data;
	}



	public function getMontoInicial(int $id_user){
		
		$sql="SELECT id, monto_inicial FROM cierre_caja WHERE id_usuario=$id_user AND estado=1 ";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function modificarCaja(string $caja, int $id)
	{
		$this->caja=$caja;
		$this->id=$id;
		
			$sql="UPDATE caja SET caja=? WHERE id=?";
			$datos=array($this->caja, $this->id);
			$data=$this->save($sql, $datos);
			if ($data==1) {
				$res="modificado";
			}else{
				$res="error";
			}
		
		return $res;
	}

	public function editarCaja(int $id)
	{
		$sql="SELECT * FROM caja WHERE id=$id";
		$data=$this->select($sql);
		return $data;
	}

	public function accionCaja(int $estado, int $id)
	{
		$this->id=$id;
		$this->estado=$estado;
		$sql="UPDATE caja SET estado=? WHERE id=?";
		$datos=array($this->estado, $this->id);
		$data=$this->save($sql,$datos);
		return $data;
	}
}
?>
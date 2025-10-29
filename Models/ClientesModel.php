<?php 
class ClientesModel extends Query{
	private $dni, $nombres, $apellidos, $telefono, $direccion, $id, $estado;
	public function __construct()
	{
		parent::__construct();
	}


	public function getClientes()
	{
		$sql="SELECT * FROM clientes";

		//$sql="SELECT * FROM usuarios iNNER JOIN caja WHERE usuarios.id_caja=caja.id";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function registrarCliente(string $dni, string $nombres,string $apellidos, string $telefono, string $direccion)
	{
		$this->dni=$dni;
		$this->nombres=$nombres;
		$this->apellidos=$apellidos;
		$this->telefono=$telefono;
		$this->direccion=$direccion;
		
			$sql="INSERT INTO clientes(dni, nombres, apellidos, telefono, direccion) VALUES(?,?,?,?,?)";
			$datos=array($this->dni, $this->nombres, $this->apellidos, $this->telefono, $this->direccion);
			$data=$this->save($sql, $datos);
			if ($data==1) {
				$res="ok";
			}else{
				$res="error";
			}
		
		return $res;
	}

	public function modificarCliente(string $dni, string $nombres,string $apellidos, string $telefono, string $direccion, int $id)
	{
		$this->dni=$dni;
		$this->nombres=$nombres;
		$this->apellidos=$apellidos;
		$this->telefono=$telefono;
		$this->direccion=$direccion;
		$this->id=$id;
		
			$sql="UPDATE clientes SET dni=?, nombres=?,apellidos=?, telefono=?, direccion=? WHERE id=?";
			$datos=array($this->dni, $this->nombres, $this->apellidos, $this->telefono, $this->direccion, $this->id);
			$data=$this->save($sql, $datos);
			if ($data==1) {
				$res="modificado";
			}else{
				$res="error";
			}
		
		return $res;
	}

	public function editarCli(int $id)
	{
		$sql="SELECT * FROM clientes WHERE id=$id";
		$data=$this->select($sql);
		return $data;
	}

	public function accionCli(int $estado, int $id)
	{
		$this->id=$id;
		$this->estado=$estado;
		$sql="UPDATE clientes SET estado=? WHERE id=?";
		$datos=array($this->estado, $this->id);
		$data=$this->save($sql,$datos);
		return $data;
	}
}
?>
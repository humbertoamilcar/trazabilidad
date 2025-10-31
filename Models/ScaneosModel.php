<?php 
class ComprasModel extends Query{
	public function __construct()
	{
		parent::__construct();
	}

	public function getClientes(){
		$sql="SELECT * FROM clientes WHERE estado=1";
		$data=$this->selectAll($sql);
		return $data;
	}



	public function getProCod(string $cod)
	{
		$sql="SELECT * FROM productos WHERE codigo='$cod'";
		$data=$this->select($sql);
		return $data;
	}

	public function getCliente(string $codigo)
	{
		$sql="SELECT * FROM clientes WHERE id='$codigo'";
		$data=$this->select($sql);
		return $data;
	}

	

	public function getProductos(int $id){
		$sql="SELECT * FROM productos WHERE id=$id";
		$data=$this->select($sql);
		return $data;
	}

	public function registrarDetalle(string $table, int $id_producto, int $id_usuario,	string $precio, int $cantidad, int $sub_total)
	{
		$sql=" INSERT INTO $table(id_producto, id_usuario, precio, cantidad, sub_total) VALUES(?,?,?,?,?)";
		$datos=array($id_producto,$id_usuario, $precio,	$cantidad, $sub_total );
		$data=$this->save($sql,$datos);
		if ($data==1) {
			$res="ok";
		}else{
			$res="error";
		}
		return $res;

	}
	
	public function getDetalle(string $table,int $id){
		$sql="SELECT d.*, p.id AS id_pro, p.descripcion FROM $table d 
		INNER JOIN productos p ON d.id_producto=p.id WHERE d.id_usuario=$id";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function calcularCompra(string $table,int $id_usuario){
		$sql="SELECT sub_total,sum(sub_total) AS total from 
		$table WHERE id_usuario=$id_usuario";
		$data=$this->select($sql);
		return $data;
	}
	public function deleteDetalle(string $table, int $id){
		$sql="DELETE from $table WHERE id=?";
		$datos=array($id);
		$data=$this->save($sql, $datos);
		if ($data==1) {
			$res="ok";
		}else{
			$res="error";
		}
		return $res;
	}

	public function consultarDetalle(string $table, int $id_producto, int $id_usuario){
		$sql="SELECT * FROM $table WHERE id_producto=$id_producto AND id_usuario=$id_usuario";
		$data=$this->select($sql);
		return $data;

	}
	public function actualizarDetalle(string $table, string $precio, int $cantidad, string $sub_total, int $id_producto, int $id_usuario){
		$sql="UPDATE $table SET precio=?, cantidad=?, sub_total=? WHERE id_producto=? AND id_usuario=?";
		$datos=array($precio,$cantidad, $sub_total, $id_producto, $id_usuario );
		$data=$this->save($sql,$datos);
		if ($data==1) {
			$res="modificado";
		}else{
			$res="error";
		}
		return $res;
	}

	public function registrarCompra(string $total){
		$sql="INSERT INTO compras(total) VALUES(?)";
		$datos=array($total);
		$data=$this->save($sql, $datos);
		if ($data==1) {
			$res="ok";
		}else{
			$res="error";
		}
		return $res;
	}

	public function registrarVenta(int $id_user, int $id_cliente,string $total){
		$sql="INSERT INTO ventas(id_usuario, id_cliente, total) VALUES(?,?,?)";
		$datos=array($id_user, $id_cliente, $total);
		$data=$this->save($sql, $datos);
		if ($data==1) {
			$res="ok";
		}else{
			$res="error";
		}
		return $res;
	}

	public function getId(string $table){
		$sql="SELECT MAX(id) as id FROM $table";
		$data=$this->select($sql);
		return $data;

	}

	public function registrarDetalleCompra(int $id_compra,int $id_pro, int $cantidad,string $precio, string $sub_total){
		$sql="INSERT INTO detalle_compras(id_compra, id_producto, cantidad, precio, sub_total) VALUES(?,?,?,?,?)";
		$datos=array($id_compra,$id_pro,  $cantidad, $precio, $sub_total);
		$data=$this->save($sql, $datos);
		if ($data==1) {
			$res="ok";
		}else{
			$res="error";
		}
		return $res;

	}

	public function registrarDetalleVenta(int $id_venta,int $id_pro, int $cantidad, string $desc, string $precio, string $sub_total){
		$sql="INSERT INTO detalle_ventas(id_venta, id_producto, cantidad, descuento ,precio, sub_total) VALUES(?,?,?,?,?,?)";
		$datos=array($id_venta,$id_pro,$cantidad, $desc, $precio, $sub_total);
		$data=$this->save($sql, $datos);
		if ($data==1) {
			$res="ok";
		}else{
			$res="error";
		}
		return $res;

	}

	public function getEmpresa(){
		$sql="SELECT * FROM configuracion";
		$data=$this->select($sql);
		return $data;

	}

	public function vaciarDetalle(string $table, int $id_usuario){
		$sql="DELETE FROM $table WHERE id_usuario=?";
		$datos=array($id_usuario);
		$data=$this->save($sql, $datos);
		if ($data==1) {
			$res="ok";
		}else{
			$res="error";
		}
		return $res;

	}

	public function getProCompra(int $id_compra){
		$sql="SELECT c.*, d.*, p.id, p.descripcion FROM compras c INNER JOIN detalle_compras d ON c.id=d.id_compra INNER JOIN productos p ON p.id=d.id_producto WHERE c.id= $id_compra";
			$data=$this->selectAll($sql);
			return $data;
	}

	public function getProVenta(int $id_venta){
		$sql="SELECT v.*, d.*, p.id, p.descripcion FROM ventas v INNER JOIN detalle_ventas d ON v.id=d.id_venta INNER JOIN productos p ON p.id=d.id_producto   WHERE v.id= $id_venta";
			$data=$this->selectAll($sql);
			return $data;
	}

	public function getHistorialcompras(){
		$sql="SELECT * FROM compras";
		$data=$this->selectAll($sql);
		return $data;
	}


	public function getHistorialVentas(){
		$sql="SELECT c.id, c.nombres, v.* FROM clientes c INNER JOIN ventas v ON v.id_cliente=c.id ";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function getHistorialV(){
		$sql="SELECT c.id, c.nombres, v.* FROM clientes c INNER JOIN ventas v ON v.id_cliente=c.id WHERE v.estado=1";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function actualizarStock(int $id_pro, int $cantidad){
		$sql="UPDATE productos SET cantidad=? WHERE id=?";
		$datos=array($id_pro, $cantidad);
		$data=$this->save($sql, $datos);
		return $data;
	}

	public function clientesVenta(int $id){
		$sql="SELECT v.id,v.id_cliente, c.* FROM ventas v INNER JOIN clientes c ON c.id=v.id_cliente WHERE v.id=$id";
		$data=$this->select($sql);
		return $data;
	}

	public function verificarDescuento(int $id){
		$sql="SELECT * FROM detalle_temp WHERE id=$id";
		$data=$this->select($sql);
		return $data;
	}	

	public function actualizarDescuento(string $desc,string $sub_total, int $id){
		$sql="UPDATE detalle_temp SET descuento=?, sub_total=? WHERE id=?";
		$datos=array($desc,$sub_total, $id);
		$data=$this->save($sql, $datos);
		if ($data==1) {
			$res="ok";
		}else{
			$res="error";
		}
		return $res;
	}

	public function getDescuento(int $id_venta){
		$sql="SELECT descuento,sum(descuento) AS total from	detalle_ventas WHERE id_venta=$id_venta";
		$data=$this->select($sql);
		return $data;
	}

	public function getAnularCompra(int $id_compra){
		$sql="SELECT c.*, d.* FROM compras c INNER JOIN detalle_compras d ON c.id=d.id_compra WHERE c.id= $id_compra";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function getAnular(int $id_compra){
		$sql="UPDATE compras SET estado=? WHERE id=?";
		$datos=array(0,$id_compra);
		$data=$this->save($sql, $datos);
		if ($data==1) {
			$res="ok";
		}else{
			$res="error";
		}
		return $res;
	}

	public function getAnularVenta(int $id_venta){
		$sql="SELECT v.id, v.total, d.* FROM ventas v INNER JOIN detalle_ventas d ON v.id=d.id_venta WHERE v.id= $id_venta";
		$data=$this->selectAll($sql);
		return $data;
	}

	public function getAnularV(int $id_venta){
		$sql="UPDATE ventas SET estado=? WHERE id=?";
		$datos=array(0,$id_venta);
		$data=$this->save($sql, $datos);
		if ($data==1) {
			$res="ok";
		}else{
			$res="error";
		}
		return $res;
	}

	public function getRangoFechas(string $desde, string $hasta){
		$sql="



			SELECT 
    v.id AS id, 
    p.descripcion AS articulo, 
    dv.precio AS precioU, 
    v.fecha AS fecha, 
    dv.cantidad AS Cantidad, 
    dv.sub_total AS Total, 
    c.apellidos AS apellidos, 
    c.nombres AS nombres
FROM detalle_ventas dv
JOIN productos p ON dv.id_producto = p.id  
JOIN ventas v ON dv.id_venta = v.id 
JOIN clientes c ON v.id_cliente = c.id 
WHERE DATE(v.fecha) BETWEEN '$desde' AND '$hasta'
AND v.estado = 1
ORDER BY v.fecha DESC;
";
				$data=$this->selectAll($sql);
		return $data;
	}


	public function getRangoFechas1(string $desde, string $hasta){
		$sql="
SELECT 
    v.id AS id, 
    p.descripcion AS articulo, 
    dv.precio AS precioU, 
    v.fecha AS fecha, 
    dv.cantidad AS Cantidad, 
    dv.sub_total AS Total, 
    c.apellidos AS apellidos, 
    c.nombres AS nombres
FROM detalle_ventas dv
JOIN productos p ON dv.id_producto = p.id  
JOIN ventas v ON dv.id_venta = v.id 
JOIN clientes c ON v.id_cliente = c.id 
WHERE DATE(v.fecha) = '$desde' AND '$hasta' 
AND v.estado = 1
ORDER BY v.fecha DESC;	";    

	$data=$this->selectAll($sql);
	return $data;
	}


}

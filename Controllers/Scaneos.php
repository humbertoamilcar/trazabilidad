<?php 
class Compras extends Controller {
	public function __construct(){
		session_start();
		parent::__construct();
	}

	public function index(){
		$this->views->getView($this,"index");
	}

	public function ventas(){
		$data=$this->model->getClientes();
		$this->views->getView($this,"ventas", $data);
	}

	public function historial_ventas(){
		
		$this->views->getView($this,"historial_ventas");
	}

	public function buscarCodigo($cod){
		$data=$this->model->getProCod($cod);
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
	
	public function buscarCliente($codigo){
		$data=$this->model->getCliente($codigo);
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
	
	public function ingresar(){
		$id=$_POST['id'];
		$datos=$this->model->getProductos($id);
		$id_producto=$datos['id'];
		$id_usuario=$_SESSION['id_usuario'];
		$precio=$datos['precio_compra'];
		$cantidad=$_POST['cantidad'];
		
		$comprobar=$this->model->consultarDetalle('detalle', $id_producto,$id_usuario);
		if (empty($comprobar)) {
			$sub_total=$precio * $cantidad;
			$data=$this->model->registrarDetalle('detalle',$id_producto,$id_usuario,$precio, $cantidad, $sub_total);
			if ($data=="ok") {
				$msg="ok";
			}else{
				$msg="Error al ingresar el producto";
			}

		}else{
			$total_cantidad=$comprobar['cantidad'] + $cantidad;
			$sub_total=$total_cantidad * $precio;
			$data=$this->model->actualizarDetalle('detalle', $precio, $total_cantidad, $sub_total,$id_producto,$id_usuario);
			if ($data=="modificado") {
				$msg="modificado";
			}else{
				$msg="Error al modificar el producto";
			}
		}
		
		echo json_encode($msg,JSON_UNESCAPED_UNICODE);
		die();
	}

	public function ingresarVenta(){
		$id=$_POST['id'];
		$datos=$this->model->getProductos($id);
		$id_producto=$datos['id'];
		$id_usuario=$_SESSION['id_usuario'];
		$precio=$datos['precio_venta'];
		$cantidad=$_POST['cantidad'];
		$comprobar=$this->model->consultarDetalle('detalle_temp',$id_producto,$id_usuario);
		if (empty($comprobar)) {
			$sub_total=$precio * $cantidad;
			$data=$this->model->registrarDetalle('detalle_temp',$id_producto,$id_usuario,$precio, $cantidad, $sub_total);
			if ($data=="ok") {
				$msg="ok";
			}else{
				$msg="Error al ingresar el producto";
			}
		}else{
			$total_cantidad=$comprobar['cantidad'] + $cantidad;
			$sub_total=$total_cantidad * $precio;
			$data=$this->model->actualizarDetalle('detalle_temp', $precio, $total_cantidad, $sub_total,$id_producto,$id_usuario);
			if ($data=="modificado") {
				$msg="modificado";
			}else{
				$msg="Error al modificar el producto";
			}
		}
		
		echo json_encode($msg,JSON_UNESCAPED_UNICODE);
		die();
	}

	public function listar($table){
		$id_usuario=$_SESSION['id_usuario'];
		$data['detalle']=$this->model->getDetalle($table,$id_usuario);
		$data['total_pagar']=$this->model->calcularCompra($table,$id_usuario);
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die();
	}

	public function delete($id){
		$data=$this->model->deleteDetalle('detalle' ,$id);
		if ($data=='ok') {
			$msg='ok';
		}else{
			$msg='error';
		}
		echo json_encode($msg);
		die();
	}

	public function deleteVenta($id){
		$data=$this->model->deleteDetalle('detalle_temp',$id);
		if ($data=='ok') {
			$msg='ok';
		}else{
			$msg='error';
		}
		echo json_encode($msg);
		die();
	}

	public function registrarCompra(){
		$id_usuario=$_SESSION['id_usuario'];
		$total=$this->model->calcularCompra('detalle',$id_usuario);
		$data=$this->model->registrarCompra($total['total']);

		if ($data=='ok') {
			$detalle=$this->model->getDetalle('detalle',$id_usuario);
			$id_compra=$this->model->getId('compras');
			foreach ($detalle as $row) {
				$cantidad=$row['cantidad'];
				$precio=$row['precio'];
				$id_pro=$row['id_producto'];
				$sub_total=$cantidad * $precio;
				$this->model->registrarDetalleCompra($id_compra['id'], $id_pro, $cantidad, $precio, $sub_total);
				$stock_actual=$this->model->getProductos($id_pro);
				$stock=$stock_actual['cantidad']+$cantidad;
				$this->model->actualizarStock($stock, $id_pro);

			}
			$vaciar=$this->model->vaciarDetalle('detalle',$id_usuario);
			if ($vaciar=='ok') {
				$msg = array('msg'=>'ok','id_compra'=> $id_compra['id']);
			}
			
		}else{
			
			$msg='error';
		}
		echo json_encode($msg);
		die();
	}

	public function registrarVenta($id_cliente){
		$id_usuario=$_SESSION['id_usuario'];
		$total=$this->model->calcularCompra('detalle_temp',$id_usuario);
		$data=$this->model->registrarVenta($id_usuario, $id_cliente,$total['total']);
		if ($data=='ok') {
			$detalle=$this->model->getDetalle('detalle_temp',$id_usuario);
			$id_venta=$this->model->getId('ventas');
			foreach ($detalle as $row) {
				$cantidad=$row['cantidad'];
				$desc=$row['descuento'];
				$precio=$row['precio'];
				$id_pro=$row['id_producto'];
				$sub_total=($cantidad * $precio)-$desc;
				$this->model->registrarDetalleVenta($id_venta['id'], $id_pro, $cantidad, $desc, $precio, $sub_total);
				$stock_actual=$this->model->getProductos($id_pro);
				$stock=$stock_actual['cantidad']-$cantidad;
				$this->model->actualizarStock($stock, $id_pro);
			}
			$vaciar=$this->model->vaciarDetalle('detalle_temp',$id_usuario);
			if ($vaciar=='ok') {
				$msg = array('msg'=>'ok','id_venta'=> $id_venta['id']);
			}
			
		}else{
			
			$msg='error';
		}
		echo json_encode($msg);
		die();
	}

	/* public function generarPdf($id_compra){
		$empresa=$this->model->getEmpresa();
		$productos=$this->model->getProCompra($id_compra);

		require('Libraries/fpdf/fpdf.php');


		$pdf = new FPDF('P','mm',array(80,200));
		$pdf->AddPage();
		$pdf->setMargins(2,0,0);
		$pdf->setTitle('Reporte de Compra');

		$pdf->Image(base_url.'Assets/img/logo/COBAZ_GDH.png', 55, 5, 18,4);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(5,5,('-----------------------------------------------------------------------------------------------------------------------------------------------------------------'),0, 1, 'C');

		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(65,5,($empresa['nombre']),0, 1, 'C');
		$pdf->Cell(5,5,('----------------------------------------------------------------------------------------------------------------------------------------------------------------'),0, 1, 'C');

		$pdf->SetFont('Arial','B',5);
		$pdf->Cell(15,5,'RUC: ',0, 0, 'L');
		$pdf->SetFont('Arial','',5);
		$pdf->Cell(20,5,($empresa['ruc']),0, 1, 'L');
		$pdf->SetFont('Arial','B',5);

		$pdf->Cell(15,5,('TELÉFONO: '),0, 0, 'L');
		$pdf->SetFont('Arial','',5);
		$pdf->Cell(20,5,($empresa['telefono']),0, 1, 'L');

		$pdf->SetFont('Arial','B',5);
		$pdf->Cell(15,5,('DIRECCIÓN: '),0, 0, 'L');
		$pdf->SetFont('Arial','',5);
		$pdf->Cell(20,5,($empresa['direccion']),0, 1, 'L');

		$pdf->SetFont('Arial','B',5);
		$pdf->Cell(15,5,('FOLIO: '),0, 0, 'L');
		$pdf->SetFont('Arial','',5);
		$pdf->Cell(20,5,($id_compra),0, 1, 'L');

		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(5,5,('-----------------------------------------------------------------------------------------------------------------------------------------------------------------'),0, 1, 'C');
		//salto de linea $pdf->Ln();

		// ENCABEZADO DE DOCUMENTO
		$pdf->setFillColor(0,0,0);
		$pdf->setTextColor(255,255,255);
		$pdf->SetFont('Arial','B',8);
		$pdf-> Cell(10,5,'Cant',0,0,'L', true );
		$pdf-> Cell(40,5,('Descripción'),0,0,'L' , true);
		$pdf-> Cell(10,5,'Precio',0,0,'L' , true);
		$pdf-> Cell(17,5,'Sub Total',0,1,'L' , true);
		$total=0.00;
		$pdf->setTextColor(0,0,0);
		foreach($productos as $row){
			$total=$total+$row['sub_total'];
			$pdf->SetFont('Arial','',7);
			$pdf-> Cell(10,5,$row['cantidad'],0,0,'L' );
			$pdf-> Cell(40,5,($row['descripcion']),0,0,'L' );
			$pdf-> Cell(10,5,$row['precio'],0,0,'L' );
			$pdf->Cell(75,5, number_format($row['sub_total'],2,'.',','),0,1,'L');
		}
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(5,5,('-----------------------------------------------------------------------------------------------------------------------------------------------------------------'),0, 0, 'C');
		$pdf->Ln();
		$pdf->Cell(70,5, 'Total a Pagar', 0,1,'R');
		$pdf->Cell(70,5, number_format($total,2,'.',','),0,1,'R');
		$pdf->Output();
	}*/


public function generarPdf($id_compra){
    $empresa = $this->model->getEmpresa();
    $productos = $this->model->getProCompra($id_compra);

    require_once('Libraries/tcpdf/tcpdf.php');

    // Crear una nueva instancia de TCPDF
	$pdf = new TCPDF();
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

	// Establecer márgenes y título
	$pdf->SetMargins(5, 10, 5); // Márgenes izquierdo, superior y derecho
	$pdf->SetTitle('Reporte de Compra');

	// Configurar el tamaño de la página (70mm x 200mm para formato voucher)
	$pdf->AddPage('P', array(70, 200)); // P es para orientación vertical (Portrait)

	// Aquí puedes agregar el logo o cualquier otra imagen
	$pdf->Image(base_url.'Assets/img/logo/COBAZ_GDH.png', 3, 13, 9, 13); // Ajusta las coordenadas y tamaño del logo según sea necesario

	// Establecer fuente
	$pdf->SetFont('helvetica', 'B', 9);

	// Agregar el encabezado de la factura
	$pdf->Cell(70, 2, '--------------------------------------------------------------------------------------', 0, 1, 'C');

	$pdf->SetFont('helvetica', 'B', 7);
	// título centrado
	$pdf->Cell(0, 5, 'RECIBO DE INGRESO AL ALMACEN', 0, 1, 'C');

	$pdf->SetFont('helvetica', 'B', 8);
	// nombre de la empresa centrado
	$pdf->Cell(0, 5, $empresa['nombre'], 0, 1, 'C');

	$id_venta_formateado = str_pad($id_compra, 4, '0', STR_PAD_LEFT);
	//$pdf->Cell(13, 5, ($id_venta_formateado), 0, 1, 'T');
	//$pdf->SetFont('helvetica', '', 8);

	// Línea de separación
	$pdf->Cell(0, 5, '----------------------------------------------------------------------------------------', 0, 1, 'C');

	// Información de la empresa
	$pdf->setCellHeightRatio(0);

	// definimos una variable para la altura de célula
	$h = 2.5; // en lugar de 5

	// Información de la empresa
	$pdf->SetFont('helvetica', 'B', 5);
	$pdf->Cell(15, $h, 'RUC:', 0, 0, 'L');
	$pdf->SetFont('helvetica', '', 5);
	$pdf->Cell(0, $h, $empresa['ruc'], 0, 1, 'L');

	$pdf->SetFont('helvetica', 'B', 5);
	$pdf->Cell(15, $h, 'TELÉFONO:', 0, 0, 'L');
	$pdf->SetFont('helvetica', '', 5);
	$pdf->Cell(0, $h, $empresa['telefono'], 0, 1, 'L');

	$pdf->SetFont('helvetica', 'B', 5);
	$pdf->Cell(15, $h, 'DIRECCIÓN:', 0, 0, 'L');
	$pdf->SetFont('helvetica', '', 5);
	$pdf->Cell(0, $h, $empresa['direccion'], 0, 1, 'L');

	$pdf->SetFont('helvetica', 'B', 5);
	$pdf->Cell(15, $h, 'CODIGO:', 0, 0, 'L');
	$pdf->SetFont('helvetica', '', 5);
	$pdf->Cell(0, $h, $id_compra, 0, 1, 'L');

	// Línea de separación
	$pdf->SetFont('helvetica', 'B', 8);
	$pdf->Cell(0, 5, '---------------------------------------------------------------------------------------', 0, 1, 'C');

	// ENCABEZADO DE LA FACTURA (Celdas de la tabla)
	//$pdf->SetFillColor(0, 0, 0); COLOR DE FONDO NEGRO
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('helvetica', 'B', 6.5);

	// sin relleno (fill = false)
	$pdf->Cell(6, 4, 'Cant',       1, 0, 'C', false);
	$pdf->Cell(39, 4, 'Descripción',1, 0, 'C', false);
	$pdf->Cell(8, 4, 'Precio',     1, 0, 'C', false);
	$pdf->Cell(11, 4, 'Sub Total',  1, 1, 'C', false);

	// Inicializar la variable $total
	$total = 0.00;

	// Volver al color de texto normal
	$pdf->SetTextColor(0, 0, 0);

	// Imprimir los productos
	foreach ($productos as $row) {
	    $total += $row['sub_total'];

	    // Establecer la fuente para cada fila de productos
	    $pdf->SetFont('helvetica', '', 5);

	    // Imprimir la cantidad
	    $pdf->Cell(6, 5, $row['cantidad'], 1, 0, 'C');
	    
	    // Descripción ajustada usando Cell y ajustando el texto automáticamente
	    $descripcion = ($row['descripcion']);
	    $max_width = 35; // Ancho máximo de la celda para la descripción

	    // Calcular el ancho del texto
	    $text_width = $pdf->GetStringWidth($descripcion);

	    // Si el texto es demasiado largo, reducir el tamaño de la fuente
	    if ($text_width > $max_width) {
	        // Reducir el tamaño de la fuente en pasos
	        $font_size = 7;
	        while ($text_width > $max_width && $font_size > 4) {
	            $font_size--;
	            $pdf->SetFont('helvetica', '', $font_size);  // Establecer el nuevo tamaño de fuente
	            $text_width = $pdf->GetStringWidth($descripcion);  // Volver a calcular el ancho del texto
	        }
	    }
	    // Imprimir la descripción ajustada
	    $pdf->Cell(39, 5, $descripcion, 1, 0, 'L');
	    // Imprimir el precio
	    $pdf->Cell(8, 5, $row['precio'], 1, 0, 'C');
	    // Imprimir el sub total
	    $pdf->Cell(11, 5, number_format($row['sub_total'], 2, '.', ','), 1, 1, 'R');
	}

	// Línea de separación
	$pdf->SetFont('helvetica', 'B', 6);
	$pdf->Cell(0, 5, '----------------------------------------------------------------------------------------------------', 0, 1, 'C');

	// Total a pagar
	$pdf->Cell(65, 5, 'Total a Compra', 0, 1, 'R');
	$pdf->Cell(65, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

		$qrData = $id_venta_formateado;

	// Estilo del QR
	$style = [
	    'border'        => 0,
	    'vpadding'      => 'auto',
	    'hpadding'      => 'auto',
	    'fgcolor'       => [0,0,0],
	    'bgcolor'       => [255,255,255],
	    'module_width'  => 1,
	    'module_height' => 1
	];

	// Calcular la altura actual y la cantidad de ítems
	$currentY = $pdf->GetY();  // Obtiene la posición actual del cursor Y

	// Ajustar la posición del QR para que no se sobreponga con el contenido
	$adjustedY = $currentY - 12;  // Añadir -6 mm a la posición actual para evitar superposiciones

	// Dibujar el QR en la posición ajustada
	$pdf->write2DBarcode(
	    $qrData,
	    'QRCODE,M',
	    2, $adjustedY,  // Usar la nueva posición calculada
	    15, 15,
	    $style,
	    'N'
	);
	$pdf->Ln(-2);
		// Fecha y Hora de Registro
	$pdf->SetFont('helvetica', '', 6);
	$pdf->Cell(42, 5, 'Cajero: ', 0, 0, 'R');
	$user = $_SESSION['nombre'];
	$pdf->Cell(23, 5, $user, 0, 0, 'R');
	// Salto de línea
	$pdf->Ln(4);

	// Información del Cajero
	date_default_timezone_set('America/Lima');
	$pdf->SetFont('helvetica', '', 6);
	$pdf->Cell(45, 4, 'Fecha y Hora de Impresión: ', 0, 0, 'R');
	$pdf->Cell(20, 4, date('d/m/Y H:i:s'), 0, 1, 'R');
	

	$pdf->SetFont('helvetica', 'B', 6);
	// Mueva el cursor sólo si lo necesita:
	$pdf->Ln(-1);
	// ancho 0 = hasta el margen derecho, ln=1 para bajar de línea automáticamente
	$pdf->Cell(65, 5, 'ADMINISTRACIÓN', 0, 1, 'R');

	// Salida del PDF
	$pdf->Output();
}


public function generarPdfVenta($id_venta){
    $empresa     = $this->model->getEmpresa();
    $descuento   = $this->model->getDescuento($id_venta);
    $productos   = $this->model->getProVenta($id_venta);

    require_once('Libraries/tcpdf/tcpdf.php');
    $pdf = new TCPDF();
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Márgenes y título
    $pdf->SetMargins(5, 10, 5);
    $pdf->SetTitle('Reporte de Venta');

    // Página tamaño 70×200 mm
    $pdf->AddPage('P', [70, 200]);

    // Colocar el logotipo a la izquierda
	$pdf->Image(base_url . 'Assets/img/logo/COBAZ_GDH.png', 8, 10, 9, 13); // Ajusta las coordenadas y tamaño del logo según sea necesario

	// Crear una celda para el nombre de la empresa a la derecha
	$pdf->SetFont('helvetica', 'B', 9);
	$pdf->Cell(55); // Mover el cursor 45mm a la derecha para dejar espacio al logotipo
	$pdf->Cell(5, 3, ($empresa['nombre']), 0, 1, 'R'); // Texto alineado a la derecha
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(42);
	$pdf->Cell(5, 3, ($empresa['direccion']), 0, 1, 'R'); // Texto alineado a la derecha
	$pdf->Cell(24);
	$pdf->Cell(10, 5, ($empresa['telefono']), 0, 1, 'R'); // Texto alineado a la derecha

	$pdf->Cell(70, 2, ('----------------------------------------------------------------------------------'), 0, 1, 'C');

	$pdf->SetFont('helvetica', 'B', 12);
	// Obtener el año actual
	$fecha = new DateTime();
	$pdf->Cell(10, 5, $fecha->format("Y"), 0, 0, 'T');
	$pdf->Cell(15, 5, ('- RECIBO DE INGRESOS'), 0, 1, 'T');
	$pdf->SetFont('helvetica', '', 13);
	$pdf->Cell(12, 5, 'Nro :', 0, 0, 'T');

	// Aumentar ceros a la izquierda en $id_venta (longitud de 4 dígitos)
	$id_venta_formateado = str_pad($id_venta, 4, '0', STR_PAD_LEFT);
	$pdf->Cell(13, 5, ($id_venta_formateado), 0, 1, 'T');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(60, 2, ('----------------------------------------------------------------------------------'), 0, 1, 'C');
	$pdf->SetFont('helvetica','B',7);

	// ENCABEZADO DE CLIENTE
	$pdf->SetFont('helvetica','B',7);
	$pdf->Cell(10,5,'Cliente:',0,0,'L', false);  
	$clientes = $this->model->clientesVenta($id_venta);
	$pdf->SetFont('helvetica','',6);
	$clientes=$clientes['nombres']." ".$clientes['apellidos'];
	$pdf->Cell(27,5,$clientes,0,1,'L');

	// ENCABEZADO DE DOCUMENTO
	$pdf->SetFillColor(255, 255, 255); // Fondo blanco
	$pdf->SetTextColor(0, 0, 0); // Texto negro
	$pdf->SetFont('helvetica', 'B', 7);

	// Encabezado de la tabla
	$pdf->Cell(6, 5, 'Cant', 1, 0, 'C', true);
	$pdf->Cell(39, 5, 'Descripción', 1, 0, 'C', true); // Descripción en una sola celda
	$pdf->Cell(8, 5, 'Precio', 1, 0, 'C', true);
	$pdf->Cell(11, 5, 'Sub Total', 1, 1, 'C', true);

	// Inicializar el total
	$total = 0.00;

	// Volver al color de texto normal
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('helvetica', '', 7);

	// Imprimir los productos
	foreach ($productos as $row) {
	    $total += $row['sub_total'];

	    // Establecer la fuente para cada fila de productos
	    $pdf->SetFont('helvetica', '', 7);

	    // Imprimir la cantidad
	    $pdf->Cell(6, 5, $row['cantidad'], 1, 0, 'C');
	    
	    // Descripción ajustada usando Cell y ajustando el texto automáticamente
	    $descripcion = ($row['descripcion']);
	    $max_width = 35; // Ancho máximo de la celda para la descripción

	    // Calcular el ancho del texto
	    $text_width = $pdf->GetStringWidth($descripcion);

	    // Si el texto es demasiado largo, reducir el tamaño de la fuente
	    if ($text_width > $max_width) {
	        // Reducir el tamaño de la fuente en pasos
	        $font_size = 7;
	        while ($text_width > $max_width && $font_size > 4) {
	            $font_size--;
	            $pdf->SetFont('helvetica', '', $font_size);  // Establecer el nuevo tamaño de fuente
	            $text_width = $pdf->GetStringWidth($descripcion);  // Volver a calcular el ancho del texto
	        }
	    }
	    // Imprimir la descripción ajustada
	    $pdf->Cell(39, 5, $descripcion, 1, 0, 'L');
	    // Imprimir el precio
	    $pdf->Cell(8, 5, $row['precio'], 1, 0, 'C');
	    // Imprimir el sub total
	    $pdf->Cell(11, 5, number_format($row['sub_total'], 2, '.', ','), 1, 1, 'R');
	}

	// Línea de separación
	$pdf->SetFont('helvetica', 'B', 8);
	$pdf->Cell(0, 5, '--------------------------------------------------------------------------', 0, 1, 'C');

	if (!isset($date)) {
	    $date = date('Y-m-d H:i:s'); // Definir la fecha y hora actual si no está definida
	}

	// Ahora, la variable $date ya está definida y puede usarse en la plantilla TCPDF.
	$pdf->SetFont('helvetica', 'B', 8);

	// Total a pagar
	$pdf->Cell(50, 5, 'Total a Pagar:', 0, 0, 'R');
	$pdf->Cell(15, 5, number_format($total, 2, '.', ','), 0, 1, 'R');


	// ——— Inserción del código QR con el número de ticket ———
	$qrData = $id_venta_formateado;

	// Estilo del QR
	$style = [
	    'border'        => 0,
	    'vpadding'      => 'auto',
	    'hpadding'      => 'auto',
	    'fgcolor'       => [0,0,0],
	    'bgcolor'       => [255,255,255],
	    'module_width'  => 1,
	    'module_height' => 1
	];

	// Calcular la altura actual y la cantidad de ítems
	$currentY = $pdf->GetY();  // Obtiene la posición actual del cursor Y

	// Ajustar la posición del QR para que no se sobreponga con el contenido
	$adjustedY = $currentY - 6;  // Añadir -6 mm a la posición actual para evitar superposiciones

	// Dibujar el QR en la posición ajustada
	$pdf->write2DBarcode(
	    $qrData,
	    'QRCODE,M',
	    4, $adjustedY,  // Usar la nueva posición calculada
	    15, 15,
	    $style,
	    'N'
	);

	// Fecha y Hora de Registro
	$pdf->SetFont('helvetica', 'B', 6);
	$pdf->Cell(30, 4, 'Fecha y Hora de Registro: ', 0, 0, 'L');
	$pdf->Cell(40, 4, $date, 0, 1, 'L');

	// Salto de línea
	$pdf->Ln();

	// Información del Cajero
	$pdf->SetFont('helvetica', 'B', 6);
	$pdf->Cell(10, 5, 'Cajero: ', 0, 0, 'R');
	$user = $_SESSION['nombre'] . " " . $_SESSION['apellidos'];
	$pdf->Cell(40, 5, $user, 0, 0, 'R');

	$pdf->SetFont('helvetica', 'B', 6);
	// Mueva el cursor sólo si lo necesita:
	$pdf->Ln(4);
	// ancho 0 = hasta el margen derecho, ln=1 para bajar de línea automáticamente
	$pdf->Cell(0, 5, 'ADMINISTRACIÓN', 0, 1, 'R');

	// Salto de línea adicional
	$pdf->Ln();
	$pdf->Ln();

// Información adicional




// Agregar la segunda página

	// Agregar la primera página
	$pdf->AddPage('P', array(70, 200)); // P es para orientación vertical (Portrait)

	// Colocar el logotipo a la izquierda
	$pdf->Image(base_url . 'Assets/img/logo/COBAZ_GDH.png', 8, 10, 9, 13); // Ajusta las coordenadas y tamaño del logo según sea necesario

	// Crear una celda para el nombre de la empresa a la derecha
	$pdf->SetFont('helvetica', 'B', 9);
	$pdf->Cell(55); // Mover el cursor 45mm a la derecha para dejar espacio al logotipo
	$pdf->Cell(5, 3, ($empresa['nombre']), 0, 1, 'R'); // Texto alineado a la derecha
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(42);
	$pdf->Cell(5, 3, ($empresa['direccion']), 0, 1, 'R'); // Texto alineado a la derecha
	$pdf->Cell(24);
	$pdf->Cell(10, 5, ($empresa['telefono']), 0, 1, 'R'); // Texto alineado a la derecha

	$pdf->Cell(70, 2, ('----------------------------------------------------------------------------------'), 0, 1, 'C');

	$pdf->SetFont('helvetica', 'B', 12);
	// Obtener el año actual
	$fecha = new DateTime();
	$pdf->Cell(10, 5, $fecha->format("Y"), 0, 0, 'T');
	$pdf->Cell(15, 5, ('- RECIBO DE INGRESOS'), 0, 1, 'T');
	$pdf->SetFont('helvetica', '', 13);
	$pdf->Cell(12, 5, 'Nro :', 0, 0, 'T');

	// Aumentar ceros a la izquierda en $id_venta (longitud de 4 dígitos)
	$id_venta_formateado = str_pad($id_venta, 4, '0', STR_PAD_LEFT);
	$pdf->Cell(13, 5, ($id_venta_formateado), 0, 1, 'T');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(60, 2, ('----------------------------------------------------------------------------------'), 0, 1, 'C');
	$pdf->SetFont('helvetica','B',7);

	// ENCABEZADO DE CLIENTE
	$pdf->SetFont('helvetica','B',7);
	$pdf->Cell(12,5,'Usuario:',0,0,'L', false);  
	$clientes = $this->model->clientesVenta($id_venta);
	$pdf->SetFont('helvetica','',6);
	$clientes=$clientes['nombres']." ".$clientes['apellidos'];
	$pdf->Cell(27,5,$clientes,0,1,'L');

	// ENCABEZADO DE DOCUMENTO
	$pdf->SetFillColor(255, 255, 255); // Fondo blanco
	$pdf->SetTextColor(0, 0, 0); // Texto negro
	$pdf->SetFont('helvetica', 'B', 7);

	// Encabezado de la tabla
	$pdf->Cell(6, 5, 'Cant', 1, 0, 'C', true);
	$pdf->Cell(39, 5, 'Descripción', 1, 0, 'C', true); // Descripción en una sola celda
	$pdf->Cell(8, 5, 'Precio', 1, 0, 'C', true);
	$pdf->Cell(11, 5, 'Sub Total', 1, 1, 'C', true);

	// Inicializar el total
	$total = 0.00;

	// Volver al color de texto normal
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('helvetica', '', 7);

	// Imprimir los productos
	foreach ($productos as $row) {
	    $total += $row['sub_total'];

	    // Establecer la fuente para cada fila de productos
	    $pdf->SetFont('helvetica', '', 7);

	    // Imprimir la cantidad
	    $pdf->Cell(6, 5, $row['cantidad'], 1, 0, 'C');
	    
	    // Descripción ajustada usando Cell y ajustando el texto automáticamente
	    $descripcion = ($row['descripcion']);
	    $max_width = 35; // Ancho máximo de la celda para la descripción

	    // Calcular el ancho del texto
	    $text_width = $pdf->GetStringWidth($descripcion);

	    // Si el texto es demasiado largo, reducir el tamaño de la fuente
	    if ($text_width > $max_width) {
	        // Reducir el tamaño de la fuente en pasos
	        $font_size = 7;
	        while ($text_width > $max_width && $font_size > 4) {
	            $font_size--;
	            $pdf->SetFont('helvetica', '', $font_size);  // Establecer el nuevo tamaño de fuente
	            $text_width = $pdf->GetStringWidth($descripcion);  // Volver a calcular el ancho del texto
	        }
	    }

	    // Imprimir la descripción ajustada
	    $pdf->Cell(39, 5, $descripcion, 1, 0, 'L');

	    // Imprimir el precio
	    $pdf->Cell(8, 5, $row['precio'], 1, 0, 'C');
	    
	    // Imprimir el sub total
	    $pdf->Cell(11, 5, number_format($row['sub_total'], 2, '.', ','), 1, 1, 'R');
	}

	// Línea de separación
	$pdf->SetFont('helvetica', 'B', 8);
	$pdf->Cell(0, 5, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'C');

	// Total a pagar
	if (!isset($date)) {
	    $date = date('Y-m-d H:i:s'); // Definir la fecha y hora actual si no está definida
	}

	// Ahora, la variable $date ya está definida y puede usarse en la plantilla TCPDF.
	$pdf->SetFont('helvetica', 'B', 8);

	// Total a pagar
	$pdf->Cell(50, 5, 'Total a Pagar:', 0, 0, 'R');
	$pdf->Cell(15, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

	// ——— Inserción del código QR con el número de ticket ———
// Estilo del QR
	$style = [
	    'border'        => 0,
	    'vpadding'      => 'auto',
	    'hpadding'      => 'auto',
	    'fgcolor'       => [0,0,0],
	    'bgcolor'       => [255,255,255],
	    'module_width'  => 1,
	    'module_height' => 1
	];

	// Calcular la altura actual y la cantidad de ítems
	$currentY = $pdf->GetY();  // Obtiene la posición actual del cursor Y

	// Ajustar la posición del QR para que no se sobreponga con el contenido
	$adjustedY = $currentY - 6;  // Añadir 10 mm a la posición actual para evitar superposiciones

	// Dibujar el QR en la posición ajustada
	$pdf->write2DBarcode(
	    $qrData,
	    'QRCODE,M',
	    4, $adjustedY,  // Usar la nueva posición calculada
	    15, 15,
	    $style,
	    'N'
	);

	// Fecha y Hora de Registro
	$pdf->SetFont('helvetica', 'B', 6);
	$pdf->Cell(30, 4, 'Fecha y Hora de Registro: ', 0, 0, 'L');
	$pdf->Cell(60, 4, $date, 0, 1, 'L');

	// Salto de línea
	$pdf->Ln();

	// Información del Cajero
	$pdf->SetFont('helvetica', 'B', 6);
	$pdf->Cell(10, 5, 'Cajero: ', 0, 0, 'R');
	$user = $_SESSION['nombre'] . " " . $_SESSION['apellidos'];
	$pdf->Cell(46, 5, $user, 0, 0, 'R');

	// Salto de línea adicional


	$pdf->SetFont('helvetica', 'B', 6);
	// Mueva el cursor sólo si lo necesita:
	$pdf->Ln(4);
	// ancho 0 = hasta el margen derecho, ln=1 para bajar de línea automáticamente
	$pdf->Cell(0, 5, 'USUARIO', 0, 1, 'R');

	// Salto de línea antes de la salida del PDF
	//$pdf->Ln();
	//$pdf->Ln();

// Agregar la tercera página
	// Establecer márgenes y título
	$pdf->SetMargins(5, 10, 5); // Márgenes izquierdo, superior y derecho
	$pdf->SetTitle('Reporte de Venta');

	// Agregar la primera página
	$pdf->AddPage('P', array(70, 200)); // P es para orientación vertical (Portrait)

	// Colocar el logotipo a la izquierda
	$pdf->Image(base_url . 'Assets/img/logo/COBAZ_GDH.png', 8, 10, 9, 13); // Ajusta las coordenadas y tamaño del logo según sea necesario

	// Crear una celda para el nombre de la empresa a la derecha
	$pdf->SetFont('helvetica', 'B', 9);
	$pdf->Cell(55); // Mover el cursor 45mm a la derecha para dejar espacio al logotipo
	$pdf->Cell(5, 3, ($empresa['nombre']), 0, 1, 'R'); // Texto alineado a la derecha
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(42);
	$pdf->Cell(5, 3, ($empresa['direccion']), 0, 1, 'R'); // Texto alineado a la derecha
	$pdf->Cell(24);
	$pdf->Cell(10, 5, ($empresa['telefono']), 0, 1, 'R'); // Texto alineado a la derecha

	$pdf->Cell(70, 2, ('----------------------------------------------------------------------------------'), 0, 1, 'C');

	$pdf->SetFont('helvetica', 'B', 12);
	// Obtener el año actual
	$fecha = new DateTime();
	$pdf->Cell(10, 5, $fecha->format("Y"), 0, 0, 'T');
	$pdf->Cell(15, 5, ('- RECIBO DE INGRESOS'), 0, 1, 'T');
	$pdf->SetFont('helvetica', '', 13);
	$pdf->Cell(12, 5, 'Nro :', 0, 0, 'T');

	// Aumentar ceros a la izquierda en $id_venta (longitud de 4 dígitos)
	$id_venta_formateado = str_pad($id_venta, 4, '0', STR_PAD_LEFT);
	$pdf->Cell(13, 5, ($id_venta_formateado), 0, 1, 'T');
	$pdf->SetFont('helvetica', '', 8);
	$pdf->Cell(60, 2, ('----------------------------------------------------------------------------------'), 0, 1, 'C');
	$pdf->SetFont('helvetica','B',7);

	// ENCABEZADO DE CLIENTE
	$pdf->SetFont('helvetica','B',7);
	$pdf->Cell(12,5,'Usuario:',0,0,'L', false);  
	$clientes = $this->model->clientesVenta($id_venta);
	$pdf->SetFont('helvetica','',6);
	$clientes=$clientes['nombres']." ".$clientes['apellidos'];
	$pdf->Cell(27,5,$clientes,0,1,'L');

	// ENCABEZADO DE DOCUMENTO
	$pdf->SetFillColor(255, 255, 255); // Fondo blanco
	$pdf->SetTextColor(0, 0, 0); // Texto negro
	$pdf->SetFont('helvetica', 'B', 7);

	// Encabezado de la tabla
	$pdf->Cell(6, 5, 'Cant', 1, 0, 'C', true);
	$pdf->Cell(39, 5, 'Descripción', 1, 0, 'C', true); // Descripción en una sola celda
	$pdf->Cell(8, 5, 'Precio', 1, 0, 'C', true);
	$pdf->Cell(11, 5, 'Sub Total', 1, 1, 'C', true);

	// Inicializar el total
	$total = 0.00;

	// Volver al color de texto normal
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('helvetica', '', 7);

	// Imprimir los productos
	foreach ($productos as $row) {
	    $total += $row['sub_total'];

	    // Establecer la fuente para cada fila de productos
	    $pdf->SetFont('helvetica', '', 7);

	    // Imprimir la cantidad
	    $pdf->Cell(6, 5, $row['cantidad'], 1, 0, 'C');
	    
	    // Descripción ajustada usando Cell y ajustando el texto automáticamente
	    $descripcion = ($row['descripcion']);
	    $max_width = 35; // Ancho máximo de la celda para la descripción

	    // Calcular el ancho del texto
	    $text_width = $pdf->GetStringWidth($descripcion);

	    // Si el texto es demasiado largo, reducir el tamaño de la fuente
	    if ($text_width > $max_width) {
	        // Reducir el tamaño de la fuente en pasos
	        $font_size = 7;
	        while ($text_width > $max_width && $font_size > 4) {
	            $font_size--;
	            $pdf->SetFont('helvetica', '', $font_size);  // Establecer el nuevo tamaño de fuente
	            $text_width = $pdf->GetStringWidth($descripcion);  // Volver a calcular el ancho del texto
	        }
	    }

	    // Imprimir la descripción ajustada
	    $pdf->Cell(39, 5, $descripcion, 1, 0, 'L');

	    // Imprimir el precio
	    $pdf->Cell(8, 5, $row['precio'], 1, 0, 'C');
	    
	    // Imprimir el sub total
	    $pdf->Cell(11, 5, number_format($row['sub_total'], 2, '.', ','), 1, 1, 'R');
	}

	// Línea de separación
	$pdf->SetFont('helvetica', 'B', 8);
	$pdf->Cell(0, 5, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'C');

	// Total a pagar
	if (!isset($date)) {
	    $date = date('Y-m-d H:i:s'); // Definir la fecha y hora actual si no está definida
	}

	// Ahora, la variable $date ya está definida y puede usarse en la plantilla TCPDF.
	$pdf->SetFont('helvetica', 'B', 8);

	// Total a pagar
	$pdf->Cell(50, 5, 'Total a Pagar:', 0, 0, 'R');
	$pdf->Cell(15, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

	        // ——— Inserción del código QR con el número de ticket ———
    // Datos para el QR: sólo el número formateado
    $qrData = $id_venta_formateado;

	 // Estilo del QR
	$style = [
	    'border'        => 0,
	    'vpadding'      => 'auto',
	    'hpadding'      => 'auto',
	    'fgcolor'       => [0,0,0],
	    'bgcolor'       => [255,255,255],
	    'module_width'  => 1,
	    'module_height' => 1
	];

	// Calcular la altura actual y la cantidad de ítems
	$currentY = $pdf->GetY();  // Obtiene la posición actual del cursor Y

	// Ajustar la posición del QR para que no se sobreponga con el contenido
	$adjustedY = $currentY - 6;  // Añadir 10 mm a la posición actual para evitar superposiciones

	// Dibujar el QR en la posición ajustada
	$pdf->write2DBarcode(
	    $qrData,
	    'QRCODE,M',
	    4, $adjustedY,  // Usar la nueva posición calculada
	    15, 15,
	    $style,
	    'N'
	);

	// Fecha y Hora de Registro
	$pdf->SetFont('helvetica', 'B', 6);
	$pdf->Cell(30, 4, 'Fecha y Hora de Registro: ', 0, 0, 'L');
	$pdf->Cell(60, 4, $date, 0, 1, 'L');

	// Salto de línea
	$pdf->Ln();

	$pdf->SetFont('helvetica', 'B', 6);
	$pdf->Cell(10, 5, 'Cajero: ', 0, 0, 'R');
	$user = $_SESSION['nombre'] . " " . $_SESSION['apellidos'];
	$pdf->Cell(46, 5, $user, 0, 0, 'R');

	// Salto de línea adicional
	

	$pdf->SetFont('helvetica', 'B', 6);
	// Mueva el cursor sólo si lo necesita:
	$pdf->Ln(4);
	// ancho 0 = hasta el margen derecho, ln=1 para bajar de línea automáticamente
	$pdf->Cell(0, 5, 'TRÁMITE', 0, 1, 'R');

	// Salto de línea antes de la salida del PDF
	//$pdf->Ln();
	//$pdf->Ln();

// Repetir el contenido de la primera página aquí (ajustado a TCPDF) para la tercera página
// (Puedes copiar el bloque de código de la primera página aquí si necesitas que sea igual)

// Salida final del PDF
$pdf->Output();

}

	public function historial(){
		$this->views->getView($this,"historial");
	}

	public function listar_historial(){
		$data=$this->model->getHistorialcompras();
		for ($i=0; $i < count($data); $i++) {
			if ($data[$i]['estado'] == 1) {
				$data[$i]['estado']='<div class="demo-inline-spacing"><span class="badge rounded-pill bg-success bg-glow"><i class="ti ti-sun"></i>COMPLETADO</span></div>';
				$data[$i]['acciones']='
                              <div class="btn-group">
					                      <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light show"
					                        data-bs-toggle="dropdown" aria-expanded="true">
					                        <i class="ti ti-menu-2 ti-xs me-1"> </i>	

					                        Acciones
					                      </button>
					                      <ul class="dropdown-menu">
					                        <li><a class="dropdown-item" href="#" onclick="btnAnularC('.$data[$i]['id'].');"> <i class="fa fa-ban  text-warning text-success me-1"></i>Anular Compra</a></li>
					                         <li><a class="dropdown-item" href="'.base_url."Compras/generarPdf/".$data[$i]['id'].'" target="_blank"> <i class="fa fa-file-pdf  text-warning me-1"></i> Imprimir</a></li>

					                          <hr class="dropdown-divider" />
					                        </li>
					                        <li></li>
					                      </ul>
					                    </div>';
			}else{
				$data[$i]['estado']='<div class="demo-inline-spacing"><span class="badge rounded-pill bg-danger bg-glow"><i class="ti ti-trash"></i>ANULADO</span></div>';

				$data[$i]['acciones']='      <div class="btn-group">
					                      <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light show"
					                        data-bs-toggle="dropdown" aria-expanded="true">
					                        <i class="ti ti-menu-2 ti-xs me-1"> </i>	

					                        Acciones
					                      </button>
					                      <ul class="dropdown-menu">
					                        <li><a class="dropdown-item" href="'.base_url."Compras/generarPdf/".$data[$i]['id'].'" target="_blank"> <i class="fa fa-file-pdf  text-warning me-1"></i> Imprimir</a></li>
					                        
					                        
					                        <li>
					                          <hr class="dropdown-divider" />
					                        </li>
					                       
					                      </ul>
					                    </div>';
			}

		}
	
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die();
	}


	public function listar_historial_venta(){
		$data=$this->model->getHistorialVentas();
		for ($i=0; $i < count($data); $i++) {
				if ($data[$i]['estado'] == 1) {
					$data[$i]['estado']='<div class="demo-inline-spacing"><span class="badge rounded-pill bg-success 	bg-glow"><i class="ti ti-sun"></i>VENDIDO</span></div>';

				$data[$i]['acciones']='<div class="btn-group">
					                      <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light show"
					                        data-bs-toggle="dropdown" aria-expanded="true">
					                        <i class="ti ti-menu-2 ti-xs me-1"> </i>	

					                        Acciones
					                      </button>
					                      <ul class="dropdown-menu">
					                        <li><a class="dropdown-item" href="'.base_url."Compras/generarPdfVenta/".$data[$i]['id'].'" target="_blank"> <i class="fa fa-file-pdf  text-warning me-1"></i> Imprimir Ticket</a></li>

					                        <li><a class="dropdown-item" href="#" onclick="btnAnularV('.$data[$i]['id'].');"> <i class="fa fa-trash   text-warning text-success me-1"></i>Eliminar Venta</a></li>
					                        <li>
					                          <hr class="dropdown-divider" />
					                        </li>
					                        <li></li>
					                      </ul>
					                    </div>';
		
	
			}else{
				$data[$i]['estado']='<div class="demo-inline-spacing"><span class="badge rounded-pill bg-danger bg-glow"><i class="ti ti-trash"></i>ELIMINADO</span></div>';

				$data[$i]['acciones']='      <div class="btn-group">
					                      <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light show"
					                        data-bs-toggle="dropdown" aria-expanded="true">
					                        <i class="ti ti-menu-2 ti-xs me-1"> </i>	

					                        Acciones
					                      </button>
					                      <ul class="dropdown-menu">
					                        <li><a class="dropdown-item" href="'.base_url."Compras/generarPdfVenta/".$data[$i]['id'].'" target="_blank"> <i class="fa fa-file-pdf  text-warning me-1"></i> Imprimir Ticket</a></li>
					                       
					                      </ul>
					                    </div>';
		
	
			}}
		
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die();
	}



	public function calcularDescuento($datos){
		$array=explode(",", $datos);
		
		$id=$array[0];
		$desc=$array[1];
		if (empty($id) || empty($desc)) {
			$msg=array('msg'=>'Error','icono'=>'error');
		}else{
			$descuento_actual=$this->model->verificarDescuento($id);
			$descuento_total=$descuento_actual['descuento']+$desc;
			$sub_total=($descuento_actual['cantidad'] * $descuento_actual['precio'])-$descuento_total;
			$data=$this->model->actualizarDescuento($descuento_total,$sub_total,$id);
			if ($data=='ok') {
				$msg=array('msg'=>'Descuento Aplicado','icono'=>'success','mensaje'=>'MENSAJE');
			}else{
				$msg=array('msg'=>'Error al Aplicar el Descuento','icono'=>'error','mensaje'=>'MENSAJE');
			}
		}
		echo json_encode($msg);
		die();
	}

	function anularCompra($id_compra){
		$data=$this->model->getAnularCompra($id_compra);
		$anular=$this->model->getAnular($id_compra);
		foreach ($data as $row) {
			$stock_actual=$this->model->getProductos($row['id_producto']);
			$stock=$stock_actual['cantidad'] - $row['cantidad'];
			$this->model->actualizarStock($stock,$row['id_producto']);
		}
		if ($anular=="ok") {
			$msg = array('msg'=>'Compra Anulada','icono'=>'success');
		}else{
			$msg = array('msg'=>'Error al Anular','icono'=>'error');
		}

		echo json_encode($msg);
		die();
	}

	function anularVenta($id_venta){
		$data=$this->model->getAnularVenta($id_venta);
		$anular=$this->model->getAnularV($id_venta);
		foreach ($data as $row) {
			$stock_actual=$this->model->getProductos($row['id_producto']);
			$stock=$stock_actual['cantidad'] + $row['cantidad'];
			$this->model->actualizarStock($stock,$row['id_producto']);
		}
		if ($anular=="ok") {
			$msg = array('msg'=>'Venta Anulada','icono'=>'success');
		}else{
			$msg = array('msg'=>'Error al Anular','icono'=>'error');
		}

		echo json_encode($msg);
		die();
	}

	
public function Pdf() {
	$d = $_POST['desde'];
    $h = $_POST['hasta'];
    $desde = $_POST['desde']." ".'00:00:00';
    $hasta = $_POST['hasta']." ".'23:59:59';

    // Si solo se proporciona una fecha en 'desde' o 'hasta'
    if (!empty($desde) && empty($hasta)) {
        $hasta = $desde; // Asumimos que quiere el reporte de un solo día
    }
    if (empty($desde) && !empty($hasta)) {
        $desde = $hasta; // Asumimos que quiere el reporte de un solo día
    }

    // Lógica para generar el reporte
    if (empty($desde) || empty($hasta)) {
        // Si no se proporcionan fechas, reporte general
        $data = $this->model->getHistorialV();
        $titulo = "Reporte general (Todas las fechas)";
    } else {
        // Si se proporcionan fechas o una sola fecha
        $data = $this->model->getRangoFechas($desde, $hasta);
        $titulo = "REPORTE DE VENTAS DESDE $d HASTA $h";
    }

    require('Libraries/fpdf/fpdf.php');

    // Creación del PDF
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->setMargins(10, 10, 10);
    $pdf->SetTitle('Reporte de Compra');

    // Encabezado del reporte con las fechas
    $pdf->SetFont('Arial', 'B', 14);

    $pdf->Cell(0, 10, ("INSTITUCION EDUCATIVA SECUNDARIA MARIA AUXILIADORA PUNO"), 0, 1, 'C'); 
    $pdf->Cell(0, 10, $titulo, 0, 1, 'C');
    $pdf->Ln(5); // Salto de línea

    // Definir el color de fondo del encabezado (Azul)
    $pdf->SetFillColor(0, 102, 204); // RGB para color azul

    // Definir los encabezados de la tabla con color de fondo
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 10, 'Id', 1, 0, 'C', false); // 'true' para rellenar el fondo
    $pdf->Cell(38, 10, 'FECHA Y HORA', 1, 0, 'C', false);
    $pdf->Cell(75, 10, 'NOMBRE DEL CLIENTE', 1, 0, 'C', false);
    $pdf->Cell(75, 10, ('DESCRIPCIÓN'), 1, 0, 'C', false);
    $pdf->Cell(20, 10, 'PRECIO', 1, 0, 'C', false);
    
    $pdf->Cell(25, 10, 'CANTIDAD', 1, 0, 'C', false);
    $pdf->Cell(30, 10, 'SUB TOTAL', 1, 1, 'C', false);

    // Contenido de la tabla
    $pdf->SetFont('Arial', '', 8);

  $totalVentas = 0; // Inicializa el total

foreach ($data as $row) {
    $pdf->Cell(10, 10, $row['id'], 1, 0, 'C');
    $pdf->Cell(38, 10, $row['fecha'], 1, 0, 'L');
    $cliente= $row['nombres']." ".$row['apellidos'];
    $pdf->Cell(75, 10, $cliente, 1, 0, 'L');
    $pdf->Cell(75, 10, ($row['articulo']), 1, 0, 'L');
    $numerof = number_format($row['precioU'], 2);
    $pdf->Cell(20, 10, $numerof, 1, 0, 'C');
    $pdf->Cell(25, 10, $row['Cantidad'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['Total'], 1, 1, 'R');

    // Acumular el total de ventas
    $totalVentas += $row['Total'];
}

$pdf->SetFont('Arial', '', 10);
// Luego, imprime el total acumulado en el PDF
	$pdf->Cell(243, 10, 'TOTAL VENTAS', 1, 0, 'R');
	$pdf->Cell(30, 10, number_format($totalVentas, 2), 1, 1, 'R');
    // Nombre del usuario que genera el reporte
    $USER = $_SESSION['nombre']." ".$_SESSION['apellidos'];

    $pdf->Ln(10); // Salto de línea
    $pdf->SetFont('Arial', 'B', 12);
   // $pdf->Cell(0, 10, 'Reporte Generado por: ' . $USER, 0, 1, 'R');
    $fechaActual=date("d-m-Y h:i:s");
    //$pdf->Cell(0, 5, 'Fecha: ' . $fechaActual, 0, 1, 'R');


    // Salida del PDF
    $pdf->Output();
	}


public function Pdf1() {
    $d = $_POST['desde'];
    $h = $_POST['hasta'];
    $desde = $_POST['desde'] . " " . '00:00:00';
    $hasta = $_POST['hasta'] . " " . '23:59:59';

    // Si solo se proporciona una fecha en 'desde' o 'hasta'
    if (!empty($desde) && empty($hasta)) {
        $hasta = $desde; // Asumimos que quiere el reporte de un solo día
    }
    if (empty($desde) && !empty($hasta)) {
        $desde = $hasta; // Asumimos que quiere el reporte de un solo día
    }

    // Lógica para generar el reporte
    if (empty($desde) || empty($hasta)) {
        // Si no se proporcionan fechas, reporte general
        $data = $this->model->getHistorialV();
        $titulo = "Reporte general (Todas las fechas)";
    } else {
        // Si se proporcionan fechas o una sola fecha
        $data = $this->model->getRangoFechas1($desde, $hasta);
        $titulo = "REPORTE DE INGRESOS DIRECTAMENTE RECAUDADOS DESDE $d HASTA $h";
    }

    require('Libraries/fpdf/fpdf.php');

    // Creación del PDF
    $pdf = new FPDF('p', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->setMargins(10, 10, 10);
    $pdf->SetTitle('Reporte de Compra');

    // Encabezado del reporte con las fechas
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, "  INSTITUCION EDUCATIVA SECUNDARIA MARIA AUXILIADORA PUNO", 0, 1, 'C');
    $pdf->Cell(0, 10, $titulo, 0, 1, 'C');
    $pdf->Ln(5); // Salto de línea

    // Definir el color de fondo del encabezado (Azul)
    $pdf->SetFillColor(0, 102, 204); // RGB para color azul

    // Definir los encabezados de la tabla con color de fondo
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, 10, 'NRO', 1, 0, 'C', false);
    //$pdf->Cell(38, 10, 'FECHA Y HORA', 1, 0, 'C', false);
    $pdf->Cell(110, 10, 'ARTICULO', 1, 0, 'C', false);
    $pdf->Cell(25, 10, 'CANTIDAD', 1, 0, 'C', false);
    $pdf->Cell(20, 10, 'PRECIO', 1, 0, 'C', false);
    $pdf->Cell(28, 10, 'SUB TOTAL', 1, 1, 'C', false);

    // Contenido de la tabla
    $pdf->SetFont('Arial', '', 10);

    $totalVentas = 0; // Inicializa el total
    $cont = 1;

    foreach ($data as $row) {
        $pdf->Cell(10, 10, $cont, 1, 0, 'C');
        //$pdf->Cell(38, 10, $row['fecha'], 1, 0, 'L');
        $pdf->Cell(110, 10, ($row['articulo']), 1, 0, 'L');
        $pdf->Cell(25, 10, $row['Cantidad'], 1, 0, 'C');
        $numero_formateado = number_format($row['precioU'], 2);
        $pdf->Cell(20, 10, $numero_formateado, 1, 0, 'C');
        $pdf->Cell(28, 10, $row['Total'], 1, 1, 'R');

        // Acumular el total de ventas
        $totalVentas += $row['Total'];
        $cont = $cont + 1;
    }
    
    // Luego, imprime el total acumulado en el PDF
    $pdf->Cell(165, 10, 'TOTAL VENTAS', 1, 0, 'R');
    $pdf->Cell(28, 10, number_format($totalVentas, 2), 1, 1, 'R');

    // Nombre del usuario que genera el reporte
    $USER = $_SESSION['nombre'];

    $pdf->Ln(10); // Salto de línea
    $pdf->SetFont('Arial', 'B', 12);
    //$pdf->Cell(0, 10, 'Reporte Generado por: ' . $USER, 0, 1, 'R');

    // Salida del PDF
    $pdf->Output();
}
	
}


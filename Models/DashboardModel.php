<?php 
class DashboardModel extends Query{
	public function __construct()
	{
		parent::__construct();
	}

	public function getDatos($table){
    // Obtener el rol del usuario en sesión y la empresa del usuario
    
    $empresa = $_SESSION['empresa']; // Empresa del usuario logueado

    // Verificar si el usuario es ADMINISTRADOR (CEO)
    if ($empresa == 'CEO-ADMINISTRADOR') {
        // Si es ADMINISTRADOR, contar todos los registros de la tabla
        $sql = "SELECT count(*) AS total FROM $table";
    } else {
        // Si no es ADMINISTRADOR, filtrar por la empresa del usuario
        if ($table == 'usuarios') {
            $sql = "SELECT count(*) AS total FROM $table u INNER JOIN empresas e ON u.id_empresa = e.id_empresa WHERE e.razon_social = '$empresa'";
        } else if ($table == 'productos') {
            $sql = "SELECT count(*) AS total FROM $table p INNER JOIN empresas e ON p.id_empresa = e.id_empresa WHERE e.razon_social = '$empresa'";
        } else if ($table == 'empresas') {
            // Si es la tabla empresas, no filtrar ya que solo cuenta las empresas
            $sql = "SELECT count(*) AS total FROM $table";
        }
    }

    // Ejecutar la consulta
    $data = $this->select($sql);
    return $data;
}


public function getMonto(){
	    // Obtener la empresa desde la sesión
	    $empresa = $_SESSION['empresa'];

	    // Verificar si el usuario es CEO-ADMINISTRADOR
	    if ($empresa == 'CEO-ADMINISTRADOR') {
	        // ✅ Si es administrador global, mostrar todos los registros
	        $sql = "
	            SELECT COUNT(*) AS suma_total_ventas
	            FROM escaneos_publicos;
	        ";
	    } else {
	        // ✅ Si es de una empresa específica, filtrar los registros por su empresa
	        $empresa = trim($empresa);
	        $sql = "
	            SELECT COUNT(*) AS suma_total_ventas
	            FROM escaneos_publicos e
	            INNER JOIN lotes l ON e.codigo_lote = l.codigo_lote
	            INNER JOIN productos p ON l.id_producto = p.id_producto
	            INNER JOIN empresas em ON p.id_empresa = em.id_empresa
	            WHERE em.razon_social = '$empresa';
	        ";
	    }

	    // Ejecutar la consulta
	    $data = $this->select($sql);
	    return $data;
	}




	public function getStockMinimo(){
	    // Obtener el rol del usuario en sesión y la empresa del usuario
	    $usuarioRol = $_SESSION['empresa'];  // rol está en la sesión
	    $empresa = $_SESSION['empresa']; // Empresa del usuario logueado

	    // Verificar si el usuario es ADMINISTRADOR (CEO)
	    if ($usuarioRol == 'CEO-ADMINISTRADOR') {
	        // Si es ADMINISTRADOR, ejecutar la consulta sin filtros
	        $sql = "
	            SELECT 
	                e.pais,
	                COUNT(e.id_escaneo) AS total_vistas
	            FROM escaneos_publicos e
	            INNER JOIN lotes l ON e.codigo_lote = l.codigo_lote
	            GROUP BY e.pais
	            ORDER BY total_vistas DESC
	            LIMIT 6";
	    } else {
	        // Si no es ADMINISTRADOR, filtrar por la empresa del usuario logueado
	        $sql = "
	            SELECT 
	                e.pais,
	                COUNT(e.id_escaneo) AS total_vistas
	            FROM escaneos_publicos e
	            INNER JOIN lotes l ON e.codigo_lote = l.codigo_lote
	            INNER JOIN productos p ON l.id_producto = p.id_producto
	            INNER JOIN empresas emp ON p.id_empresa = emp.id_empresa
	            WHERE emp.razon_social = '$empresa'
	            GROUP BY e.pais
	            ORDER BY total_vistas DESC
	            LIMIT 6";
	    }

	    // Ejecutar la consulta
	    $data = $this->selectAll($sql);
	    return $data;
	}

	
	public function getStockVendidos(){
	    // Obtener el rol del usuario en sesión y la empresa del usuario
	    
	    $empresa = $_SESSION['empresa']; // Empresa del usuario logueado

	    // Verificar si el usuario es ADMINISTRADOR (CEO)
	    if (trim($empresa) == 'CEO-ADMINISTRADOR') {
	        // Si es ADMINISTRADOR, ejecutar la consulta sin filtros
	        $sql = "
	            SELECT 
	                p.descripcion,
	                COUNT(e.id_escaneo) AS cantidad,
	                ROUND(
	                    (COUNT(e.id_escaneo) * 100.0 / (
	                        SELECT COUNT(*) FROM escaneos_publicos
	                    )), 2
	                ) AS porcentaje
	            FROM productos p
	            INNER JOIN lotes l 
	                ON p.id_producto = l.id_producto
	            INNER JOIN escaneos_publicos e 
	                ON l.codigo_lote = e.codigo_lote
	            GROUP BY p.descripcion
	            ORDER BY cantidad DESC
	            LIMIT 10";
	    } else {
	        // Si no es ADMINISTRADOR, filtrar por la empresa del usuario logueado
	        $empresa = trim($empresa);
	        $sql = "
	            SELECT 
	                p.descripcion,
	                COUNT(e.id_escaneo) AS cantidad,
	                ROUND(
	                    (COUNT(e.id_escaneo) * 100.0 / (
	                        SELECT COUNT(*) FROM escaneos_publicos
	                    )), 2
	                ) AS porcentaje
	            FROM productos p
	            INNER JOIN lotes l 
	                ON p.id_producto = l.id_producto
	            INNER JOIN escaneos_publicos e 
	                ON l.codigo_lote = e.codigo_lote
	            WHERE p.id_empresa = (
	                SELECT id_empresa FROM empresas WHERE razon_social = $empresa
	            )
	            GROUP BY p.descripcion
	            ORDER BY cantidad DESC
	            LIMIT 10";
	    }

	    // Ejecutar la consulta
	    $data = $this->selectAll($sql);
	    return $data;
	}


	public function getTopProductos() {
	    // Obtener el rol del usuario en sesión y la empresa del usuario
	   
	    $empresa = $_SESSION['empresa']; // Empresa del usuario logueado

	    // Verificar si el usuario es ADMINISTRADOR (CEO)
	    if ($empresa == 'CEO-ADMINISTRADOR') {
	        // Si es ADMINISTRADOR, ejecutar la consulta sin filtros
	        $sql = "
	            SELECT 
	                p.descripcion,
	                COUNT(e.id_escaneo) AS cantidad,
	                ROUND(
	                    (COUNT(e.id_escaneo) * 100.0 / (
	                        SELECT COUNT(*) FROM escaneos_publicos
	                    )), 2
	                ) AS porcentaje
	            FROM productos p
	            INNER JOIN lotes l 
	                ON p.id_producto = l.id_producto
	            INNER JOIN escaneos_publicos e 
	                ON l.codigo_lote = e.codigo_lote
	            GROUP BY p.descripcion
	            ORDER BY cantidad DESC
	            LIMIT 10";
	    } else {
	        $empresa = trim($empresa);
	        $sql = "
	            SELECT 
	                p.descripcion,
	                COUNT(e.id_escaneo) AS cantidad,
	                ROUND(
	                    (COUNT(e.id_escaneo) * 100.0 / (
	                        SELECT COUNT(*) FROM escaneos_publicos
	                    )), 2
	                ) AS porcentaje
	            FROM productos p
	            INNER JOIN lotes l 
	                ON p.id_producto = l.id_producto
	            INNER JOIN escaneos_publicos e 
	                ON l.codigo_lote = e.codigo_lote
	            WHERE p.id_empresa = (
	                SELECT id_empresa FROM empresas WHERE razon_social = '$empresa'
	            )
	            GROUP BY p.descripcion
	            ORDER BY cantidad DESC
	            LIMIT 10";
	    }

	    // Ejecutar la consulta
	    $data = $this->selectAll($sql);
	    return $data;
	}


public function getTopUsuario()
{
    // Obtener la empresa desde la sesión
    $empresa = $_SESSION['empresa'];

    // Verificar si el usuario es CEO-ADMINISTRADOR
    if ($empresa == 'CEO-ADMINISTRADOR') {
        // Si es ADMINISTRADOR, mostrar todos los usuarios sin filtro
        $sql = "
            SELECT 
                u.id_usuario AS id,
                CONCAT(u.nombres, ' ', u.apellidos) AS nombre,
                r.descripcion AS rol,
                u.ingresos,
                u.foto AS fotousuario,
                r.descripcion AS logo,
                e.razon_social AS empresa, -- ✅ Nombre de la empresa
                CONCAT(ROUND(u.ingresos * 100 / 1000, 0), '%') AS status,
                CONCAT(ROUND(u.ingresos * 100 / 1000, 0), '/100') AS number,
                (u.id_usuario * 2) AS note,
                (u.id_usuario % 3) AS anulados,
                CONCAT(
                    TIME_FORMAT(
                        TIMEDIFF(NOW(), COALESCE(u.creado_en, NOW())), '%H:%i:%s'
                    ), '.000'
                ) AS time
            FROM usuarios u
            INNER JOIN rol r 
                ON u.rol = r.id_rol
            INNER JOIN empresas e 
                ON u.id_empresa = e.id_empresa
            ORDER BY ingresos DESC  ";
    } else {
        // Si NO es CEO, filtrar por su empresa
        $empresa = trim($empresa);
        $sql = "
            SELECT 
                u.id_usuario AS id,
                CONCAT(u.nombres, ' ', u.apellidos) AS nombre,
                r.descripcion AS rol,
                u.ingresos,
                u.foto AS fotousuario,
                r.descripcion AS logo,
                e.razon_social AS empresa, -- ✅ Nombre de la empresa
                CONCAT(ROUND(u.ingresos * 100 / 1000, 0), '%') AS status,
                CONCAT(ROUND(u.ingresos), '/1000') AS number,
                (u.id_usuario * 2) AS note,
                (u.id_usuario % 3) AS anulados,
                CONCAT(
                    TIME_FORMAT(
                        TIMEDIFF(NOW(), COALESCE(u.creado_en, NOW())), '%H:%i:%s'
                    ), '.000'
                ) AS time
            FROM usuarios u
            INNER JOIN rol r 
                ON u.rol = r.id_rol
            INNER JOIN empresas e 
                ON u.id_empresa = e.id_empresa
            WHERE e.razon_social = '$empresa'
            ORDER BY ingresos DESC
            ";
    }

    // Ejecutar la consulta y retornar los datos
    $data = $this->selectAll($sql);
    return $data;
}

}


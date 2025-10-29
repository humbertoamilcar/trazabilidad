<?php 
class productosModel extends Query{
    private $codigo, $precio_compra,$precio_venta, $id,$estado,
     $id_medida,$id_categoria, $img;
    public function __construct()
    {
        parent::__construct();
    }
    public function getMedidas()
    {
        $sql="SELECT * FROM medidas";
        $data=$this->selectAll($sql);
        return $data;
    }
    
public function getEmpresa(){
        $sql="SELECT * FROM empresas where id_empresa!=11";
        $data=$this->selectAll($sql);
        return $data;
    }

public function ListarProductos(){
    $empresa = isset($_SESSION['empresa']) ? $_SESSION['empresa'] : null;
    // Si no hay sesión, evita fallos
    if (!$empresa) {
        $sql = "SELECT p.id_producto AS id_producto, p.id_empresa,  p.sku, p.nombre, p.descripcion, p.imagen, p.activo AS activo FROM productos p";
        return $this->selectAll($sql);
    }

        if ($empresa === 'CEO-ADMINISTRADOR') {
            $sql = "
                SELECT 
                    p.id_producto AS id, 
                    p.id_empresa, 
                    e.razon_social ,  
              
                    P.descripcion,
                    p.sku, 
                    p.nombre, 
                    p.imagen, 
                    p.activo AS estado
                FROM productos p
                INNER JOIN empresas e ON p.id_empresa = e.id_empresa
            ";
        } else {
            $empresa = trim($empresa);
            $sql = "
                SELECT 
                    p.id_producto AS id, 
                    p.id_empresa, 
                    e.razon_social,
                   
                    P.descripcion,
                    p.sku, 
                    p.nombre, 
                    p.imagen, 
                    p.activo AS estado
                FROM productos p
                INNER JOIN empresas e ON p.id_empresa = e.id_empresa
                WHERE e.razon_social = '{$this->escape($empresa)}'
            ";
        }

    $data = $this->selectAll($sql);
    return $data;
}



    public function registrarproducto(string $codigo, string $nombre,
        string $precio_compra, string $precio_venta, int $id_medida, 
        int $id_categoria, string $img){
        $this->codigo=$codigo;
        $this->nombre=$nombre;
        $this->precio_compra=$precio_compra;
        $this->precio_venta=$precio_venta;
        $this->id_medida=$id_medida;
        $this->id_categoria=$id_categoria;
        $this->img=$img;
        $verificar="SELECT * FROM productos WHERE descripcion=
        '$this->nombre'";
        $existe=$this->select($verificar);
        if (empty($existe)) {
            $sql="INSERT INTO productos(codigo, descripcion,
                precio_compra,precio_venta, id_medida,id_categoria,
                foto) VALUES(?,?,?,?,?,?,?)";
            $datos=array($this->codigo, $this->nombre, 
                $this->precio_compra, $this->precio_venta, 
                $this->id_medida,$this->id_categoria,$this->img);
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

    public function modificarproducto(string $codigo, 
        string $nombre,string $precio_compra, string $precio_venta, 
        int $id_medida, int $id_categoria, string $img, int $id)
    {
        $this->codigo=$codigo;
        $this->nombre=$nombre;
        $this->precio_compra=$precio_compra;
        $this->precio_venta=$precio_venta;
        $this->id_medida=$id_medida;
        $this->id_categoria=$id_categoria;
        $this->img=$img;
        $this->id=$id;
        $sql="UPDATE productos SET codigo=?, descripcion=?,
        precio_compra=?,precio_venta=?, id_medida=?, 
        id_categoria=?, foto=? WHERE id=?";
        $datos=array($this->codigo, $this->nombre, $this->precio_compra,
         $this->precio_venta, $this->id_medida,$this->id_categoria,
          $this->img, $this->id);
        $data=$this->save($sql, $datos);
            if ($data==1) {
                $res="modificado";
            }else{
                $res="error";
            }
        return $res;
    }

    public function editarPro(int $id)
    {
        $sql="SELECT * FROM productos WHERE id_producto=$id";
        $data=$this->select($sql);
        return $data;
    }

    public function accionPro(int $estado, int $id)
    {
        $this->id=$id;
        $this->estado=$estado;
        $sql="UPDATE productos SET estado=? WHERE id_producto=?";
        $datos=array($this->estado, $this->id);
        $data=$this->save($sql,$datos);
        return $data;
    }
}
?>
<?php

class UsuariosModel extends Query {
    private $id_usuario, $id_empresa, $nombres, $apellidos, $documento, $foto, $celular, $correo, $password, $rol, $activo;

    public function __construct() {
        parent::__construct();
    }

    // Obtener usuario para login
    public function getUsuario(string $correo, string $password) {
        $sql = "SELECT u.*, e.razon_social, r.descripcion AS rol
                FROM usuarios u
                INNER JOIN empresas e ON u.id_empresa = e.id_empresa
                INNER JOIN rol r ON u.rol = r.id_rol
                WHERE u.correo = ? AND u.password = ? AND u.activo = 1
                LIMIT 1";
        $datos = array($correo, $password);
        return $this->select($sql, $datos);
    }

public function actualizarIngresos(string $correo, string $password){
    // 1️⃣ Buscar al usuario por correo y contraseña (seguro)
    $sqlSelect = "SELECT ingresos FROM usuarios WHERE correo = ? AND password = ?";
    $usuario = $this->select($sqlSelect, [$correo, $password]);

    // 2️⃣ Verificar si el usuario existe
    if (empty($usuario)) {
        return ['status' => false, 'message' => 'Usuario no encontrado'];
    }

    // 3️⃣ Calcular los nuevos ingresos
    $nuevosIngresos = intval($usuario['ingresos']) + 1;

    // 4️⃣ Actualizar el valor de ingresos
    $sqlUpdate = "UPDATE usuarios SET ingresos = ? WHERE correo = ? AND password = ?";
    $params = [$nuevosIngresos, $correo, $password];
    $actualizado = $this->save($sqlUpdate, $params);

    // 5️⃣ Retornar respuesta controlada
    return [
        'status' => $actualizado ? true : false,
        'ingresos' => $nuevosIngresos
    ];
}




    public function getUsuarioPorId(int $id) {
        $sql = "SELECT u.*, e.razon_social 
        FROM usuarios u
        INNER JOIN empresas e ON u.id_empresa = e.id_empresa
        WHERE u.id_usuario = ? AND u.activo = 1
        LIMIT 1";
        $datos = array($id);
        return $this->select($sql, $datos);
    }

    public function getRol(){
        $sql="SELECT * FROM rol";
        $data=$this->selectAll($sql);
        return $data;
    }

public function getEmpresa(){
        $sql="SELECT * FROM empresas where id_empresa!=11";
        $data=$this->selectAll($sql);
        return $data;
    }

public function getUsuarios() {
 
    $usuarioRol = $_SESSION['rol']; 
    $empresa = $_SESSION['empresa'];

 
    if ($usuarioRol == "ADMINISTRADOR") {
            $sql = "SELECT 
                        u.id_usuario AS id, 
                        u.id_empresa, 
                        u.nombres, 
                        u.apellidos,
                        u.rol,
                        r.descripcion AS rol,
                        u.foto AS fotousuario,
                        u.creado_en AS fecharegistro, 
                        u.documento AS dni, 
                        u.activo AS estado, 
                        e.razon_social AS empresa
                    FROM usuarios u
                    INNER JOIN empresas e ON u.id_empresa = e.id_empresa
                    INNER JOIN rol r ON u.rol = r.id_rol";
    } else {
        $empresa = trim($empresa);
        $sql = "SELECT 
                    u.id_usuario AS id, 
                    u.id_empresa, 
                    u.nombres, 
                    u.apellidos,
                    u.rol,
                    r.descripcion AS rol,
                    u.foto AS fotousuario,
                    u.creado_en AS fecharegistro, 
                    u.documento AS dni, 
                    u.activo AS estado, 
                    e.razon_social AS empresa
                FROM usuarios u
                INNER JOIN empresas e ON u.id_empresa = e.id_empresa
                INNER JOIN rol r ON u.rol = r.id_rol
                WHERE e.razon_social = '$empresa'"; 
    }

    // Ejecutar la consulta
    $data = $this->selectAll($sql);
    return $data;
}



    // ✅ Registrar usuario
    public function registrarUsuario(int $id_empresa, string $nombres, string $apellidos,
                                     string $documento, string $foto, string $celular, string $correo,
                                     string $password, string $rol) 
    {
        $this->id_empresa=$id_empresa;
        $this->nombres=$nombres;
        $this->apellidos=$apellidos;
        $this->documento=$documento;
        $this->foto=$foto;
        $this->celular=$celular;
        $this->correo=$correo;
        $this->password=$password;
        $this->rol=$rol;

        $verificar = "SELECT * FROM usuarios WHERE correo=? OR documento=?";
        $existe = $this->select($verificar, array($correo, $documento));

        if (empty($existe)) {
            $sql = "INSERT INTO usuarios 
                        (id_empresa, nombres, apellidos, documento, celular, correo, password, rol, foto) 
                    VALUES (?,?,?,?,?,?,?,?,?)";
            $datos = array($id_empresa, $nombres, $apellidos, $documento, $celular, $correo, $password, $rol, $foto);
            $data = $this->save($sql, $datos);
            return ($data == 1) ? "ok" : "error";
        } else {
            return "existe";
        }
    }

    // ✅ Editar usuario por ID
    public function editarUsuario(int $id_usuario) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario=?";
        return $this->select($sql, array($id_usuario));
    }

    // ✅ Modificar usuario
    public function modificarUsuario(int $id_usuario, int $id_empresa, string $nombres, string $apellidos,
                                     string $documento, string $celular, string $correo,
                                     string $rol, string $foto = '') 
    {
        if ($foto !== '') {
            $sql = "UPDATE usuarios 
                    SET id_empresa=?, nombres=?, apellidos=?, documento=?, celular=?, correo=?, rol=?, foto=? 
                    WHERE id_usuario=?";
            $datos = array($id_empresa, $nombres, $apellidos, $documento, $celular, $correo, $rol, $foto, $id_usuario);
        } else {
            $sql = "UPDATE usuarios 
                    SET id_empresa=?, nombres=?, apellidos=?, documento=?, celular=?, correo=?, rol=? 
                    WHERE id_usuario=?";
            $datos = array($id_empresa, $nombres, $apellidos, $documento, $celular, $correo, $rol, $id_usuario);
        }
        $data = $this->save($sql, $datos);
        return ($data == 1) ? "modificado" : "error";
    }

    // ✅ Cambiar estado (activar/desactivar)
    public function accionUsuario(int $activo, int $id_usuario) {
        $sql = "UPDATE usuarios SET activo=? WHERE id_usuario=?";
        $datos = array($activo, $id_usuario);
        
        return $this->save($sql, $datos);
    }

    // ✅ Verificar contraseña
    public function getPass(string $password, int $id_usuario) {
        $sql = "SELECT id_usuario FROM usuarios WHERE password=? AND id_usuario=?";
        return $this->select($sql, array($password, $id_usuario));
    }

    // ✅ Modificar contraseña
    public function modificarPass(string $password, int $id_usuario) {
        $sql = "UPDATE usuarios SET password=? WHERE id_usuario=?";
        return $this->save($sql, array($password, $id_usuario));
    }
}

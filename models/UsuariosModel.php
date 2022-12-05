<?php
class UsuariosModel extends Query{

    public function __construct() {
        parent::__construct();
    }

    public function getUsuarios($estado)
    {
        $sql = "SELECT id_usuario, CONCAT (nombre, ' ' ,apellido) as nombres ,correo,telefono,direccion,rol FROM usuarios WHERE estado = $estado";
        //trae todos los registros
        return $this->selectAll($sql);

    }
    public function registrar($nombres,$apellidos,$correo,$telefono
    ,$direccion,$clave,$rol)
    {
       $sql = "INSERT INTO usuarios (nombre,apellido,correo,telefono,direccion,clave,rol) VALUES (?,?,?,?,?,?,?)";
       $array = array($nombres,$apellidos,$correo,$telefono,$direccion,$clave,$rol);
        return $this->insertar($sql,$array);
    }
    public function getValidar($campo,$valor,$accion,$id_usuario)
    {
        if($accion == 'registrar' && $id_usuario == 0){
            $sql = "SELECT id_usuario,correo,telefono FROM usuarios WHERE $campo = '$valor'";
            return $this->select($sql);
        }else{
            $sql = "SELECT id_usuario,correo,telefono FROM usuarios WHERE $campo = '$valor' and id_usuario != $id_usuario";
            return $this->select($sql);
        }
    
    }
    public function eliminar($estado,$id_usuario)
    {
        $sql = "UPDATE usuarios SET estado = ? WHERE id_usuario = ?";
        $array = array($estado,$id_usuario);
        return $this->save($sql,$array);
    }
    public function editar($id_usuario)
    {
        $sql = "SELECT id_usuario,nombre,apellido,correo,telefono,direccion,rol FROM usuarios WHERE id_usuario = $id_usuario";
        return $this->select($sql);
    }
    public function actualizar($nombres,$apellidos,$correo,$telefono
    ,$direccion,$rol,$id_usuario)
    {
       $sql = "UPDATE usuarios SET nombre=?, apellido=?, correo=?, telefono=?, direccion=?, rol=? WHERE id_usuario = ? ";
       $array = array($nombres,$apellidos,$correo,$telefono,$direccion,$rol,$id_usuario);
        return $this->save($sql,$array);
    }
 
}
?>
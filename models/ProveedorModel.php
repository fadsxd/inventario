<?php 
class ProveedorModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getProveedores($estado){
        $sql = "SELECT * FROM proveedor WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    public function registrar($nombre,$nit,$telefono,$direccion){
        $sql = "INSERT INTO proveedor (nit,nombre,telefono,direccion) VALUES (?,?,?,?)";
        $array = array($nit,$nombre,$telefono,$direccion);
        return $this->insertar($sql,$array);
    }
    public function getValidar($campo,$valor,$accion,$id){
        if($accion == 'registrar' && $id == 0){
            $sql = "SELECT id_proveedor FROM proveedor WHERE $campo = '$valor'";
        }else{
            $sql = "SELECT id_proveedor FROM proveedor WHERE $campo = '$valor' AND id_proveedor != $id";
        }
        return $this->select($sql);
    }
    public function eliminar($estado, $idProveedor){
        $sql = "UPDATE proveedor SET estado =? WHERE id_proveedor = ?";
        $array = array($estado, $idProveedor);
        return $this->save($sql,$array);
    }
    public function editar($idProveedor){
        $sql = "SELECT * FROM proveedor WHERE id_proveedor = $idProveedor";
        return $this->select($sql);
    }
    public function actualizar($nombre,$nit,$telefono,$direccion,$id){
        $sql = "UPDATE proveedor SET nit=?, nombre=?, telefono =? ,direccion =? WHERE id_proveedor = ?";
        $array = array($nit,$nombre,$telefono,$direccion,$id);
        return $this->save($sql,$array);
    }
    public function buscarNombre($valor){
        $sql = "SELECT id_proveedor, nombre, telefono, direccion FROM proveedor WHERE nombre LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
        return $this->selectAll($sql);
    }
    
}

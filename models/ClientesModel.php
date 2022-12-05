<?php  
class ClientesModel extends Query {
    public function __construct() {
        parent::__construct();
    }
    public function getClientes($estado){
        $sql = "SELECT * FROM clientes WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    public function registrar($documento,$numero,$nombre
    ,$telefono,$correo,$direccion)
    {
       $sql = "INSERT INTO clientes (tipo_documento,numero_identidad,nombre
       ,telefono,correo,direccion) VALUES (?,?,?,?,?,?)";
       $array = array($documento,$numero,$nombre
       ,$telefono,$correo,$direccion);
       return $this->insertar($sql,$array);
    }
    public function getValidar($campo,$valor,$accion,$id){
        if($accion == 'registrar' && $id == 0){
            $sql = "SELECT id_cliente FROM clientes WHERE $campo = '$valor'";
        }else{
            $sql = "SELECT id_cliente FROM clientes WHERE $campo = '$valor' AND id_cliente != $id";
        }
        return $this->select($sql);
    }
    public function eliminar($estado,$idCliente)
    {
        $sql = "UPDATE clientes SET estado = ? WHERE id_cliente = ?";
        $array = array($estado,$idCliente);
        return  $this->save($sql,$array);
    }
    public function editar($idCliente){
        
        $sql = "SELECT * FROM clientes WHERE id_cliente = $idCliente";
        return $this->select($sql);
    }
    public function actualizar($documento,$numero,$nombre
    ,$telefono,$correo,$direccion,$id)
    {
       $sql = "UPDATE clientes SET  tipo_documento=?,numero_identidad=?,nombre=?
       ,telefono=?,correo=?,direccion=? WHERE id_cliente =?";
       $array = array($documento,$numero,$nombre
       ,$telefono,$correo,$direccion,$id);
       return $this->save($sql,$array);
    }
}
?>

 
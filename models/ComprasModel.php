<?php  
class ComprasModel extends Query{
    public function __construct() {
        parent::__construct();

    }
    public function getProducto($idProducto){
        $sql = "SELECT * FROM productos WHERE id_producto = $idProducto";
        return $this->select($sql);
    }
    public function registrarCompra($productos,$total,$fecha,$hora,$serie,$idProveedor,$id_usuario)
    {
       $sql = "INSERT INTO compras (producto,total,fecha,hora,serie,id_proveedor,id_usuario) VALUES (?,?,?,?,?,?,?)";
       $array = array($productos,$total,$fecha,$hora,$serie,$idProveedor,$id_usuario);
       return $this->insertar($sql,$array);
    }   
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        return $this->select($sql);
    }
    public function getCompra($idCompra)
    {
        $sql = "SELECT c.*,p.nombre,p.nit,p.telefono,p.direccion FROM compras c 
        INNER JOIN proveedor p ON c.id_proveedor = p.id_proveedor
        WHERE id_compra = $idCompra";
        return $this->select($sql);
    }
    //actualizar stock
    
    public function actualizarStock($cantidad,$idProducto)
    {
        $sql = "UPDATE productos SET cantidad = ? WHERE id_producto = ?";
        $array = array($cantidad,$idProducto);
        return $this->save($sql,$array);
    }
    public function getCompras()
    {
        $sql = "SELECT c.*,p.nombre FROM compras c 
        INNER JOIN proveedor p ON c.id_proveedor = p.id_proveedor";
        return $this->selectAll($sql);
    }
    public function anular($idCompra)
    {
        $sql = "UPDATE compras SET estado = ? WHERE id_compra = ?";
        $array = array(0,$idCompra);
        return $this->save($sql,$array);
    }
}
?>
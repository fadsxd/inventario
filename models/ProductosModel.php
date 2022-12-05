<?php 
class ProductosModel extends Query{
    public function __construct() {
       parent::__construct();
    }
    public function getProductos($estado){
        $sql = "SELECT p.id_producto ,p.codigo ,p.descripcion , p.precio_compra ,p.precio_venta ,p.cantidad ,p.foto, p.estado 
        ,p.fecha ,p.ventas ,p.id_categoria ,c.nom_categoria,m.medida 
        from productos p
        inner join categorias c on c.id_categoria = p.id_categoria
        inner join medidas m on m.id_medida = p.id_medida
        where p.estado = $estado ";
         return $this->selectAll($sql);
    }

    public function getDatos($table){
        $sql = "SELECT * FROM $table WHERE estado = 1";
        return $this->selectAll($sql);
    }
    public function registrar($codigo,$nombre,$compra,$venta
    ,$id_medida,$id_categoria,$foto){
        $sql = "INSERT INTO productos (codigo,descripcion,precio_compra,precio_venta
        ,id_medida,id_categoria,foto) VALUES (?,?,?,?,?,?,?)";
        $array = array($codigo,$nombre,$compra,$venta
        ,$id_medida,$id_categoria,$foto);
        return $this->insertar($sql,$array);
    }
    public function getValidar($campo,$valor,$accion,$id){
        if($accion == 'registrar' && $id == 0){
            $sql = "SELECT id_producto FROM productos WHERE $campo = '$valor'";
        }else{
            $sql = "SELECT id_producto FROM productos WHERE $campo = '$valor' AND id_producto != $id";
        }
        return $this->select($sql);
    }
    public function eliminar($estado, $idProducto)
    {
        $sql = "UPDATE productos SET estado = ? WHERE id_producto = ? ";
        $array = array($estado,$idProducto);
        return $this->save($sql,$array);
    }
    public function editar($idProducto)
    {
        $sql = "SELECT * FROM productos WHERE id_producto = $idProducto";
        return $this->select($sql); 
    }
    public function actualizar($codigo,$nombre,$compra,$venta
    ,$id_medida,$id_categoria,$foto,$id){
        $sql = "UPDATE productos SET  codigo=?,descripcion=?,precio_compra=?,precio_venta=?
        ,id_medida=?,id_categoria=?,foto=? WHERE id_producto =?";
        $array = array($codigo,$nombre,$compra,$venta
        ,$id_medida,$id_categoria,$foto,$id);
        return $this->save($sql,$array);
    }
    public function buscarCodigo($valor){
        $sql = "SELECT id_producto FROM productos WHERE codigo = '$valor'";
        return $this->select($sql);
    }
    public function buscarNombre($valor){
        $sql = "SELECT id_producto,descripcion FROM productos WHERE descripcion LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
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
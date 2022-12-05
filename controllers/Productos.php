<?php
class Productos extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        $data['title'] = 'Productos';
        $data['script'] = 'productos.js';
        $data['medidas'] =  $this->model->getDatos('medidas');
        $data['categorias'] =  $this->model->getDatos('categorias');
        $this->views->getView('productos', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getProductos(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . $data[$i]['foto'] . '"  width="100">';
            $data[$i]['acciones'] = ' <div>
            <button class="btn btn-danger" onclick="eliminarProducto(' . $data[$i]['id_producto'] . ')" type="button"><i class="fas fa-trash"></i></button>
            <button class="btn btn-info" onclick="editarProducto(' . $data[$i]['id_producto'] . ')" type="button"><i class="fas fa-edit"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        if (isset($_POST['codigo']) && isset($_POST['nombre'])) {
            $codigo = strClean($_POST['codigo']);

            $id = strClean($_POST['id_usuario']);
            $nombre = strClean($_POST['nombre']);
            $compra = strClean($_POST['compra']);
            $venta = strClean($_POST['venta']);
            $id_medida = strClean($_POST['id_medida']);
            $id_categoria = strClean($_POST['id_categoria']);
            $foto = $_FILES['foto'];
            $name = $foto['name'];
            $tmp = $foto['tmp_name'];

            $fotoActual = $_POST['foto_actual'];

            $destino = null;
            if (!empty($name)) {
                $fecha = date('YmdHis');
                $destino = 'assets/images/productos/' . $fecha . '.jpg';
            } else if (!empty($fotoActual) && empty($name)) {
                $destino = $fotoActual;
            }

            if (empty($codigo)) {
                $res = array('msg' => 'EL CODIGO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($nombre)) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($compra)) {
                $res = array('msg' => 'EL PRECIO COMPRA ES REQUERIDO', 'type' => 'warning');
            } else if (empty($venta)) {
                $res = array('msg' => 'EL PRECIO VENTA ES REQUERIDO', 'type' => 'warning');
            } else if (empty($id_medida)) {
                $res = array('msg' => 'SELECCIONE UNA MEDIDA', 'type' => 'warning');
            } else if (empty($id_categoria)) {
                $res = array('msg' => 'SELECCIONE UNA CATEGORIA', 'type' => 'warning');
            } else {
                if ($id == '') {
                    $verificar = $this->model->getValidar('codigo', $codigo, 'registrar', 0);
                    if (empty($verificar)) {
                        $data = $this->model->registrar(
                            $codigo,
                            $nombre,
                            $compra,
                            $venta,
                            $id_medida,
                            $id_categoria,
                            $destino
                        );
                        if ($data > 0) {
                            if (!empty($name)) {
                                move_uploaded_file($tmp, $destino);
                            }
                            $res = array('msg' => 'PRODUCTO REGISTRADO', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR REGISTRADO', 'type' => 'success');
                        }
                    } else {
                        $res = array('msg' => 'EL CODIGO DEBE SER UNICO!!', 'type' => 'warning');
                    }
                } else {
                    $verificar = $this->model->getValidar('codigo', $codigo, 'actualizar', $id);
                    if (empty($verificar)) {
                        $data = $this->model->actualizar(
                            $codigo,
                            $nombre,
                            $compra,
                            $venta,
                            $id_medida,
                            $id_categoria,
                            $destino,
                            $id
                        );

                        if ($data > 0) {
                            if (!empty($name)) {
                                move_uploaded_file($tmp, $destino);
                            }
                            $res = array('msg' => 'PRODUCTO MODIFICADO', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL MODIFICAR', 'type' => 'success');
                        }
                    } else {
                        $res = array('msg' => 'EL CODIGO DEBE SER UNICO!!', 'type' => 'warning');
                    }
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO!!', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($idProducto)
    {
        if (isset($_GET) && is_numeric($idProducto)) {
            $data = $this->model->eliminar(0, $idProducto);
            if ($data == 1) {
                $res = array('msg' => 'PRODUCTO DADO DE BAJA', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'success');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($idProducto)
    {
        $data = $this->model->editar($idProducto);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function inactivos()
    {
        $data['title'] = 'Productos Inactivos';
        $data['script'] = 'productos-inactivos.js';
        $this->views->getView('productos', 'inactivos', $data);
    }
    public function listarInactivos()
    {
        $data = $this->model->getProductos(0);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . $data[$i]['foto'] . '"  width="100">';
            $data[$i]['acciones'] = ' <div>
            <button class="btn btn-danger" onclick="restaurarProducto(' . $data[$i]['id_producto'] . ')" type="button"><i class="fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function restaurar($idProducto)
    {
        if (isset($_GET) && is_numeric($idProducto)) {
            $data = $this->model->eliminar(1, $idProducto);
            if ($data == 1) {
                $res = array('msg' => 'PRODUCTO RESTAURADO', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL RESTAURAR', 'type' => 'success');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    //BUSCAR PRODUCTOS POR CODIGO
    public function buscarCodigo($valor){
        $data = $this->model->buscarCodigo($valor);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    //BUSCAR PRODUCTOS POR NOMBRE
    public function buscarNombre(){
        $array = array();
        $valor  = $_GET['term'];
        $data = $this->model->buscarNombre($valor);
        foreach ($data as $row) {
          $result['id'] = $row['id_producto'];
          $result['label'] = $row['descripcion'];
          array_push($array,$result);
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
    //mostrar productos desde localstorage
    public function mostrarDatos(){
        $json = file_get_contents('php://input');
        $datos = json_decode($json,true);
        $array['productos'] = array();
        $total = 0;
       // print_r($datos);
        if(!empty($datos)){
            foreach ($datos as $producto) {
                $result = $this->model->editar($producto['id']);
                $data['id'] = $result['id_producto'];
                $data['nombre'] = $result['descripcion'];
                $data['precio_compra'] = $result['precio_compra'];
                $data['cantidad'] = $producto['cantidad'];
                $subTotal = $data['precio_compra'] * $producto['cantidad'];
                $data['subTotal'] = number_format($subTotal,2);
                array_push($array['productos'],$data);
                $total += $subTotal;
            }
           
        }
        $array['total'] = number_format($total,2);
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
}

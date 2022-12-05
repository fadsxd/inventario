<?php
class Proveedor extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        $data['title'] = 'Proveedores';
        $data['script'] = 'proveedor.js';
        $this->views->getView('proveedor', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getProveedores(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" onclick="eliminarProveedor(' . $data[$i]['id_proveedor'] . ')" type="button"><i class="fas fa-trash"></i></button>
            <button class="btn btn-info" onclick="editarProveedor(' . $data[$i]['id_proveedor'] . ')" type="button"><i class="fas fa-edit"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {

        if (isset($_POST['nit']) && isset($_POST['nombre'])) {
            $id = $_POST['id_usuario'];
            $nombre = strClean($_POST['nombre']);
            $nit = strClean($_POST['nit']);
            $telefono = strClean($_POST['telefono']);
            $direccion = strClean($_POST['direccion']);

            if (empty($nombre)) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($nit)) {
                $res = array('msg' => 'EL NIT ES REQUERIDO', 'type' => 'warning');
            } else if (empty($telefono)) {
                $res = array('msg' => 'EL TELEFONO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($direccion)) {
                $res = array('msg' => 'LA DIRECCIÓN ES REQUERIDO', 'type' => 'warning');
            } else {

                if ($id == '') {
                    $verificar = $this->model->getValidar('nit', $nit, 'registrar', 0);
                    if (empty($verificar)) {
                        $data = $this->model->registrar(
                            $nombre,
                            $nit,
                            $telefono,
                            $direccion



                        );
                        if ($data > 0) {
                            $res = array('msg' => 'PROVEEDOR REGISTRADO', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'EL NIT DEBE SER UNICO', 'type' => 'warning');
                    }
                } else {
                    $verificar = $this->model->getValidar('nit', $nit, 'actualizar', $id);
                    if (empty($verificar)) {
                        $data = $this->model->actualizar(
                            $nombre,
                            $nit,
                            $telefono,
                            $direccion,
                            $id
                        );
                        if ($data > 0) {
                            $res = array('msg' => 'PROVEEDOR MODIFICADO', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL MODIFICAR', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'EL NIT DEBE SER UNICO', 'type' => 'warning');
                    }
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($idProveedor)
    {
        if (isset($_GET) && is_numeric($idProveedor)) {
            $data = $this->model->eliminar(0, $idProveedor);
            if ($data == 1) {
                $res = array('msg' => 'PROVEEDOR DADO DE BAJA', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($idProveedor)
    {
        $data = $this->model->editar($idProveedor);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function inactivos()
    {
        $data['title'] = 'Proveedores Inactivos';
        $data['script'] = 'proveedor-inactivos.js';
        $this->views->getView('proveedor', 'inactivos', $data);
    }
    public function listarInactivos()
    {
        $data = $this->model->getProveedores(0);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" onclick="restaurarProveedor(' . $data[$i]['id_proveedor'] . ')" type="button"><i class="fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function restaurar($idProveedor)
    {
        if (isset($_GET) && is_numeric($idProveedor)) {
            $data = $this->model->eliminar(1, $idProveedor);
            if ($data == 1) {
                $res = array('msg' => 'PROVEEDOR RESTAURADO', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL RESTAURAR', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscar(){
        $array = array();
        $valor  = $_GET['term'];
        $data = $this->model->buscarNombre($valor);
        foreach ($data as $row) {
          $result['id'] = $row['id_proveedor'];
          $result['label'] = $row['nombre'];
          $result['telefono'] = $row['telefono'];
          $result['direccion'] = $row['direccion'];
          array_push($array,$result);
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
    
}

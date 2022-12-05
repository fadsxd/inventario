<?php
class Clientes extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        $data['title'] = 'Clientes';
        $data['script'] = 'clientes.js';
        //Llamamos a una vista  RUTA      ARCHIVO  DATOS
        $this->views->getView('clientes', 'index', $data);
    }
    public function listar()
    {
        $data =  $this->model->getClientes(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" onclick="eliminarCliente(' . $data[$i]['id_cliente'] . ')" type="button"><i class="fas fa-trash"></i></button>
            <button class="btn btn-info" onclick="editarCliente(' . $data[$i]['id_cliente'] . ')" type="button"><i class="fas fa-edit"></i></button>
            </div>';
        }


        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {

        if (isset($_POST['documento']) && isset($_POST['numero'])) {
            $id = $_POST['id_usuario'];
            $documento = strClean($_POST['documento']);
            $numero = strClean($_POST['numero']);
            $nombre = strClean($_POST['nombre']);
            $telefono = strClean($_POST['telefono']);
            $correo = strClean($_POST['correo']);
            $direccion = strClean($_POST['direccion']);

            if (empty($nombre)) {
                $res = array('msg' => 'NOMBRE REQUERIDO', 'type' => 'warning');
            } else if (empty($telefono)) {
                $res = array('msg' => 'TELEFONO REQUERIDO', 'type' => 'warning');
            } else if (empty($direccion)) {
                $res = array('msg' => 'DIRECCIÓN REQUERIDO', 'type' => 'warning');
            } else if (empty($documento)) {
                $res = array('msg' => 'TIPO DE DOCUMENTO REQUERIDO', 'type' => 'warning');
            } else if (empty($numero)) {
                $res = array('msg' => 'N° IDENTIDAD REQUERIDO', 'type' => 'warning');
            } else {

                if ($id == '') {
                    $verificar = $this->model->getValidar('numero_identidad', $numero, 'registrar', 0);
                    if (empty($verificar)) {
                        $data = $this->model->registrar(
                            $documento,
                            $numero,
                            $nombre,
                            $telefono,
                            $correo,
                            $direccion
                        );
                        if ($data > 0) {
                            $res = array('msg' => 'CLIENTE REGISTRADO', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'EL N° DE INTENTIDAD DEBE SER UNICO', 'type' => 'warning');
                    }
                } else {
                    $verificar = $this->model->getValidar('numero_identidad', $numero, 'actualizar', $id);
                    if (empty($verificar)) {
                        $data = $this->model->actualizar(
                            $documento,
                            $numero,
                            $nombre,
                            $telefono,
                            $correo,
                            $direccion,
                            $id
                        );
                        if ($data > 0) {
                            $res = array('msg' => 'CLIENTE MODIFICADO', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL MODIFICAR', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'EL N° DE INTENTIDAD DEBE SER UNICO', 'type' => 'warning');
                    }
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'warning');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($idCliente)
    {
        if (isset($_GET) && is_numeric($idCliente)) {
            $data = $this->model->eliminar(0, $idCliente);
            if ($data > 0) {
                $res = array('msg' => 'CLIENTE DADO DE BAJA', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($idCliente)
    {
        $data = $this->model->editar($idCliente);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function inactivos()
    {
        $data['title'] = 'Clientes Inactivos';
        $data['script'] = 'clientes-inactivos.js';
        //Llamamos a una vista  RUTA      ARCHIVO  DATOS
        $this->views->getView('clientes', 'inactivos', $data);
    }
    public function listarInactivos()
    {
        $data =  $this->model->getClientes(0);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" onclick="restaurarCliente(' . $data[$i]['id_cliente'] . ')" type="button"><i class="fas fa-check-circle"></i></button>
            </div>';
        }


        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function restaurar($idCliente)
    {
        if (isset($_GET) && is_numeric($idCliente)) {
            $data = $this->model->eliminar(1, $idCliente);
            if ($data > 0) {
                $res = array('msg' => 'CLIENTE RESTAURADO', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL RESTAURAR', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}

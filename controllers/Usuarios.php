
<?php
class Usuarios extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {

        $data['title'] = 'Usuarios';
        $data['script'] = 'usuarios.js';
        $this->views->getView('usuarios', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getUsuarios(1);
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['rol'] == 1) {
                $data[$i]['rol'] = '<span class="badge bg-success">ADMINISTRADOR</span>';
            } else {
                $data[$i]['rol'] = '<span class="badge bg-info">VENDEDOR</span>';
            }
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="eliminarUsuario(' . $data[$i]['id_usuario'] . ')"><i class="fas fa-times-circle"></i></button>
            <button class="btn btn-info" type="button" onclick="editarUsuario(' . $data[$i]['id_usuario'] . ')"><i class="fas fa-edit"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    //metodo para registrar y modificar
    public function registrar()
    {
        if (isset($_POST)) {

            if (empty($_POST['nombres'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['apellidos'])) {
                $res = array('msg' => 'EL APELLIDO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['correo'])) {
                $res = array('msg' => 'EL CORREO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['telefono'])) {
                $res = array('msg' => 'EL TELEFONO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['direccion'])) {
                $res = array('msg' => 'LA DIRECCION ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['clave'])) {
                $res = array('msg' => 'LA CLAVE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['rol'])) {
                $res = array('msg' => 'EL ROL ES REQUERIDO', 'type' => 'warning');
            } else {
                // name = "nombres"
                $nombres = strClean($_POST['nombres']);
                $apellidos = strClean($_POST['apellidos']);
                $correo = strClean($_POST['correo']);
                $telefono = strClean($_POST['telefono']);
                $direccion = strClean($_POST['direccion']);
                $clave = strClean($_POST['clave']);
                //$hash = password_hash($clave, PASSWORD_DEFAULT);
                $rol = strClean($_POST['rol']);
                $id_usuario = strClean($_POST['id_usuario']);

                if ($id_usuario == '') {
                    $hash = password_hash($clave, PASSWORD_DEFAULT);
                    $verificarCorreo = $this->model->getValidar('correo', $correo,'registrar',0);
                    if (empty($verificarCorreo)) {
                        $data = $this->model->registrar(
                            $nombres,
                            $apellidos,
                            $correo,
                            $telefono,
                            $direccion,
                            $hash,
                            $rol
                        );
                        if ($data > 0) {
                            $res = array('msg' => 'USUARIO REGISTRADO', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'EL CORREO YA EXISTE', 'type' => 'warning');
                    }
                } else {
                    $verificarCorreo = $this->model->getValidar('correo', $correo,'modificar',$id_usuario);
                    if (empty($verificarCorreo)) {
                        $data = $this->model->actualizar(
                            $nombres,
                            $apellidos,
                            $correo,
                            $telefono,
                            $direccion,
                            $rol,
                            $id_usuario
                        );
                        if ($data > 0) {
                            $res = array('msg' => 'USUARIO ACTUALIZADO', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL ACTUALIZAR', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'EL CORREO YA EXISTE', 'type' => 'warning');
                    }
                }




            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    //funcion eliminar usuario
    public function eliminar($id_usuario)
    {
        if (isset($_GET)) {
            if (is_numeric($id_usuario)) {
                $data =  $this->model->eliminar(0, $id_usuario);
                if ($data == 1) {
                    $res = array('msg' => 'USUARIO ELIMINADO', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'error');
                }
            } else {
                $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar($id_usuario)
    {
        $data =  $this->model->editar($id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    //vista inactivos
    public function inactivos()
    {
        $data['title'] = 'Usuarios Inactivos';
        $data['script'] = 'usuarios-inactivos.js';
        $this->views->getView('usuarios', 'inactivos', $data);
    }
    public function listarInactivos()
    {
        $data = $this->model->getUsuarios(0);
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['rol'] == 1) {
                $data[$i]['rol'] = '<span class="badge bg-success">ADMINISTRADOR</span>';
            } else {
                $data[$i]['rol'] = '<span class="badge bg-info">VENDEDOR</span>';
            }
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="restaurarUsuario(' . $data[$i]['id_usuario'] . ')"><i class="fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function restaurar($id_usuario)
    {
        if (isset($_GET)) {
            if (is_numeric($id_usuario)) {
                $data =  $this->model->eliminar(1, $id_usuario);
                if ($data == 1) {
                    $res = array('msg' => 'USUARIO RESTAURADO', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL RESTAURAR', 'type' => 'error');
                }
            } else {
                $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
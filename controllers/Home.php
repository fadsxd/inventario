
<?php 
class Home extends Controller{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index(){
        $data['title'] = 'Iniciar Sesion';
        //$data['script'] = 'index.js';
       $this->views->getView('principal','login',$data);
        //echo $this->model->getDatos($parametro);
        //echo 'Mensaje desde el controlador'. $parametro;
    }
    //validar formulario de login
    public function validar()
    {
        //accedemos por el name de html
       if (isset($_POST['correo']) && isset($_POST['clave'])) {
            if (empty($_POST['correo'])) {
                $res = array('msg' => 'EL CORREO ES REQUERIDO', 'type' => 'warning');
            }else if (empty($_POST['clave'])){
                $res = array('msg' => 'LA CONTRASEÑA ES REQUERIDA', 'type' => 'warning');
            }else{
                $correo = strClean($_POST['correo']);
                $clave = strClean($_POST['clave']);
                $data = $this->model->getDatos($correo);
                if(empty($data)){
                    $res = array('msg' => 'EL CORREO NO EXISTE', 'type' => 'warning');
                }else{
                    //verifica clave
                    if(password_verify($clave,$data['clave'])){
                        $_SESSION['id_usuario'] = $data['id_usuario'];
                        $_SESSION['nombre_usuario'] = $data['nombre'];
                        $_SESSION['correo_usuario'] = $data['correo'];
                        $res = array('msg' => 'DATOS CORRECTOS', 'type' => 'success');
                    }else{
                        $res = array('msg' => 'CONTRASEÑA INCORRECTA', 'type' => 'warning');
                    }
                }
            }
            //codifica a un json
       }else{
        $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
       }
       echo json_encode($res,JSON_UNESCAPED_UNICODE);
       die();
    }
}
?>
<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;


class Compras extends Controller
{
    private $id_usuario;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->id_usuario = $_SESSION['id_usuario'];
    }
    public function index()
    {
        $data['title'] = 'Compras';
        $data['script'] = 'compras.js';
        $this->views->getView('compras', 'index', $data);
    }
    public function registrarCompra()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        //print_r($datos);
        $array['productos'] = array();
        $total = 0;
        //print_r($datos);
        if (!empty($datos['productos'])) {
            $indice = $datos['serie'];
            $numberSerie = $this->generate_number($indice, 1, 5);
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $serie = $numberSerie[0];
            $idProveedor = $datos['idProveedor'];

            if (empty($idProveedor)) {
                $res = array('msg' => 'EL PROVEEDOR ES REQUERIDO', 'type' => 'warning');
            } else if (empty($serie)) {
                $res = array('msg' => 'LA SERIE ES REQUERIDO', 'type' => 'warning');
            } else {
                foreach ($datos['productos'] as $producto) {
                    $result = $this->model->getProducto($producto['id']);
                    $data['id'] = $result['id_producto'];
                    $data['nombre'] = $result['descripcion'];
                    $data['precio_compra'] = $result['precio_compra'];
                    $data['cantidad'] = $producto['cantidad'];
                    $subTotal = $data['precio_compra'] * $producto['cantidad'];
                    array_push($array['productos'], $data);
                    $total += $subTotal;
                    //actualizar stocl
                    $nuevaCantidad = $result['cantidad'] + $producto['cantidad'];
                    $this->model->actualizarStock($nuevaCantidad, $result['id_producto']);
                }
                $datosProductos = json_encode($array['productos']);
                $compra = $this->model->registrarCompra($datosProductos, $total, $fecha, $hora, $serie, $idProveedor, $this->id_usuario);
                if ($compra > 0) {
                    $res = array('msg' => 'COMPRA GENERADA', 'type' => 'success', 'idCompra' => $compra);
                } else {
                    $res = array('msg' => 'ERROR AL GUARDAR LA COMPRA', 'type' => 'error');
                }
            }
        } else {
            $res = array('msg' => 'CARRITO VACIO', 'type' => 'warning');
        }
        echo json_encode($res);
        die();
    }
    public function generate_number($start, $count, $digits)
    {
        $result = array();
        for ($n = $start; $n < $start + $count; $n++) {
            $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
        }
        return $result;
    }
    public function reporte($datos)
    {
        $array = explode(',', $datos);
        $tipo = $array[0];
        $idCompra = $array[1];

        $data['title'] = 'Reporte';
        $data['empresa'] = $this->model->getEmpresa();
        $data['compra'] = $this->model->getCompra($idCompra);
        if (empty($data['compra'])) {
            echo 'PAGINA NO ENCONTRADA';
            exit;
        }
        $this->views->getView('compras', $tipo, $data);
        $html = ob_get_clean();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $options = $dompdf->getOptions();
        $options->set('isJavascriptEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        if ($tipo == 'ticked') {
            $dompdf->setPaper(array(0, 0, 222, 841), 'portrait');
        } else {
            $dompdf->setPaper('A4', 'vertical');
        }

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('ticket.pdf', array('Attachment' => false));
    }
    public function listar()
    {
        $data = $this->model->getCompras();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-warning" href="#" onclick="anularCompra(' . $data[$i]['id_compra'] . ')"><i class="fas fa-trash"></i></a>
                <a class="btn btn-primary" href="#" onclick="verReporte(' . $data[$i]['id_compra'] . ')"><i class="fas fa-file-pdf"></i></a>
                </div>';
            }else{
                $data[$i]['acciones'] = '<div>
                <span class="badge bg-info">Anulado</span>
                <a class="btn btn-primary" href="#" onclick="verReporte(' . $data[$i]['id_compra'] . ')"><i class="fas fa-file-pdf"></i></a>
                </div>';
            }
           
        }
        echo json_encode($data);
        die();
    }
    public function anular($idCompra)
    {
        if (isset($_GET) && is_numeric($idCompra)) {
            $data = $this->model->anular($idCompra);
            if ($data == 1) {
                $resultCompra = $this->model->getCompra($idCompra);
                $compraProducto = json_decode($resultCompra['producto'], true);
                foreach ($compraProducto as $producto) {
                    $result = $this->model->getProducto($producto['id']);
                    $nuevaCantidad = $result['cantidad'] - $producto['cantidad'];
                    $this->model->actualizarStock($nuevaCantidad, $producto['id']);
                }
                $res = array('msg' => 'COMPRA ANULADO', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ANULAR', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR AL ANULAR', 'type' => 'error');
        }
        echo json_encode($res);
        die();
    }
    
}

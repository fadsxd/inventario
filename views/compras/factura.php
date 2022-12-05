<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/factura.css'; ?>">
</head>

<body>
    <table id="datos-empresa">
        <tr>
            <td class="logo">
                <img src="<?php echo BASE_URL . 'assets/images/logo.png'; ?>" alt="">
            </td>
            <td class="info-empresa">
                <p><?php echo $data['empresa']['nombre']; ?></p>
                <p>Nit: <?php echo $data['empresa']['nit']; ?></p>
                <p>Telefono: <?php echo $data['empresa']['telefono']; ?></p>
                <p>Dirección: <?php echo $data['empresa']['direccion']; ?></p>
            </td>
            <td class="info-compra">
                <div class="container-factura">
                    <span class="factura">FACTURA</span>
                    <p>N°: <strong><?php echo $data['compra']['serie']; ?></strong></p>
                    <p>Fecha: <strong><?php echo $data['compra']['fecha']; ?></strong> </p>
                    <p>Hora: <strong><?php echo $data['compra']['hora']; ?></strong> </p>

                </div>
            </td>
        </tr>
    </table>



    <h5 class="title">DATOS DEL PROVEEDOR</h5>
    <table id="container-info">
        <tr>
            <td>
                <strong>Nit: </strong>
                <p><?php echo $data['compra']['nit']; ?></p>
            </td>
            <td>
                <strong>Nombre: </strong>
                <p><?php echo $data['compra']['nombre']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Telefono: </strong>
                <p><?php echo $data['compra']['telefono']; ?></p>
            </td>
            <td>
                <strong>Dirección: </strong>
                <p><?php echo $data['compra']['direccion']; ?></p>
            </td>
        </tr>
    </table>
   
    <h5 class="title">Detalle de los Productos</h5>
    <table id="container-producto">
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $productos = json_decode($data['compra']['producto'], true);

            //IGV INCLUIDO
             $subTotal = $data['compra']['total'] / 1.18;
             $igv = $data['compra']['total'] - $subTotal;
             $total = $data['compra']['total'];

             //IGV NO INCLUIDO
            //  $subTotal = $data['compra']['total'];
            //  $igv = $subTotal * 0.18;
            //  $total = $subTotal + $igv;


            foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo number_format($producto['precio_compra'], 2); ?></td>
                    <td><?php echo number_format($producto['cantidad'] * $producto['precio_compra'], 2); ?></td>
                </tr>
            <?php  } ?>
            <tr class="total">
                <td class="text-right" colspan="3"><b>SubTotal: </b></td>
                <td class="text-left"><b><?php echo number_format($subTotal, 2); ?></b></td>
            </tr>
            <tr class="total">
                <td class="text-right" colspan="3"><b>Igv 18%: </b></td>
                <td class="text-left"><b><?php echo number_format($igv, 2); ?></b></td>
            </tr>
            <tr class="total">
                <td class="text-right" colspan="3"><b>Total: </b></td>
                <td class="text-left"><b><?php echo number_format($total, 2); ?></b></td>
            </tr>
        </tbody>
    </table>
    <br>
    <hr>
    <div class="mensaje">
        <?php echo $data['empresa']['mensaje']; ?>
        <?php if($data['compra']['estado'] == 0) { ?>
            <h1 style="color:red;">Compra Anulado</h1>
        <?php } ?>
    </div>

</body>

</html>
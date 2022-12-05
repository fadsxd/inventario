<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/ticked.css'; ?>">
</head>

<body>
    <img src="<?php echo BASE_URL . 'assets/images/logo.png'; ?>" alt="">

    <div class="datos-empresa">
        <p><?php echo $data['empresa']['nombre']; ?></p>
        <p><?php echo $data['empresa']['telefono']; ?></p>
        <p><?php echo $data['empresa']['direccion']; ?></p>
    </div>
    <h5 class="title">DATOS DEL PROVEEDOR</h5>
    <div class="datos-info">
        <p><b>Nit: </b><?php echo $data['compra']['nit']; ?></p>
        <p><b>Nombre: </b><?php echo $data['compra']['nombre']; ?></p>
        <p><b>Telefono: </b><?php echo $data['compra']['telefono']; ?></p>
    </div>
    <h5 class="title">Detalle de los Productos</h5>
    <table>
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
            foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo number_format($producto['precio_compra'], 2); ?></td>
                    <td><?php echo number_format($producto['cantidad'] * $producto['precio_compra'], 2); ?></td>
                </tr>
            <?php  } ?>
            <tr>
                <td class="text-right" colspan="3"><b>Total: </b></td>
                <td class="text-left"><b><?php echo number_format($data['compra']['total'], 2); ?></b></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div class="mensaje">
        <?php echo $data['empresa']['mensaje']; ?>
        <?php if($data['compra']['estado'] == 0) { ?>
            <h1 style="color:red;">Compra Anulado</h1>
        <?php } ?>
    </div>
   

</body>

</html>
<?php include_once 'views/templates/header.php' ?>

<div class="card">
    <div class="card-body">
        <nav class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="compras-tab" data-bs-toggle="tab" data-bs-target="#nav-compras" type="button" role="tab" aria-controls="nav-compras" aria-selected="true">Compras</button>
            <button class="nav-link" id="historial-tab" data-bs-toggle="tab" data-bs-target="#nav-historial" type="button" role="tab" aria-controls="nav-historial" aria-selected="false">Historial</button>
        </nav>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active p-3" id="nav-compras" role="tabpanel" aria-labelledby="compras-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fa-solid fa-cart-arrow-down"></i> Nueva Compra</h5>
                <hr>
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="radio" id="qr" checked name="buscarProducto"><i class="fas fa-qrcode"></i> CÓDIGO
                    </label>
                    <label class="btn btn-info">
                        <input type="radio" id="nombre" name="buscarProducto"><i class="fas fa-list"></i> NOMBRE
                    </label>
                </div>
                <!-- input para buscar por codigo-->
                <div class="input-group mb-2" id="containerCodigo">
                    <span class="input-group-text" style="color:#229afe;"><i class=" fas fa-search"></i>BUSCAR</span>
                    <input class="form-control" type="text" id="buscarProductoCodigo" placeholder="Buscar Codigo - Enter">
                </div>

                <!-- input para buscar por nombre-->
                <div class="input-group d-none mb-2" id="containerNombre">
                    <span class="input-group-text" style="color:#229afe;"><i class=" fas fa-search"></i>BUSCAR</span>
                    <input class="form-control" type="text" id="buscarProductoNombre" placeholder="Buscar Producto">
                </div>
                <!-- tabla de productos-->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" id="tblNuevaCompra" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="col-md-4">
                        <label>Buscar Proveedor</label>
                        <div class="input-group mb-2">
                            <input type="hidden" id="idProveedor">
                            <span class="input-group-text"><i class=" fas fa-search"></i></span>
                            <input class="form-control" type="text" id="buscarProveedor" placeholder="Buscar Proveedor">
                        </div>
                        <label>Telefono</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input class="form-control" type="text" id="telefonoProveedor" placeholder="Telefono" disabled>
                        </div>

                        <label>Dirección</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                            <input class="form-control" type="text" id="direccionProveedor" placeholder="Dirección" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Comprador</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text" "><i class=" fas fa-user"></i></span>
                            <input class="form-control" type="text" value="<?php echo $_SESSION['nombre_usuario']; ?>" placeholder="Comprador" disabled>
                        </div>
                        <label>Total a Pagar</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text" "><i class=" fas fa-dollar-sign"></i></span>
                            <input class="form-control" type="text" id="totalPagar" placeholder="Total Pagar" disabled>
                        </div>

                        <label>Serie</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text" "><i class=" fas fa-spinner"></i></span>
                            <input class="form-control" type="text" id="serie" placeholder="Serie Compra">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" id="btnAccion" type="button">Completar</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade p-3" id="nav-historial" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="d-flex justify-content-center mb-3">
                    <div class="form-group">
                        <label for="desde"><b>Desde</b></label>
                        <input id="desde" class="form-control" type="date" name="">
                    </div>
                    <div class="form-group">
                        <label for="hasta"><b>Hasta</b></label>
                        <input id="hasta" class="form-control" type="date" name="">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover nowrap" id="tblHistorial" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Total</th>
                                <th>Proveedor</th>
                                <th>Serie</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include_once 'views/templates/footer.php' ?>
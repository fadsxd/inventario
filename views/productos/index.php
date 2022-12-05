<?php include_once 'views/templates/header.php' ?>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div></div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'productos/inactivos'; ?>"><i class="fas fa-trash text-danger"></i> Inactivos</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="productos-tab" data-bs-toggle="tab" data-bs-target="#nav-productos" type="button" role="tab" aria-controls="nav-productos" aria-selected="true">Productos</button>
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo</button>
        </nav>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-2" id="nav-productos" role="tabpanel" aria-labelledby="productos-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-list"></i>Listado de Productos</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover nowrap" id="tblProductos" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Descripción</th>
                                <th>P. Compra</th>
                                <th>P. Venta C</th>
                                <th>Stock</th>
                                <th>Medida</th>
                                <th>Categoria</th>
                                <th>Foto</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade p-3" id="nav-nuevo" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <form id="formulario" autocomplete="off">
                    <input type="hidden" id="id_usuario" name="id_usuario">
                    <input type="hidden" id="foto_actual" name="foto_actual">
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Codigo</span>
                                <input class="form-control" type="text" name="codigo" id="codigo" placeholder="Ingrese Codigo">
                            </div>
                            <span id="errorCodigo" class="text-danger"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Nombre</span>
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese Producto">
                            </div>
                            <span id="errorNombre" class="text-danger"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Compra</span>
                                <input class="form-control" type="number" step="0.01" min="0.01" name="compra" id="compra" placeholder="Precio Compra">
                            </div>
                            <span id="errorCompra" class="text-danger"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Venta</span>
                                <input class="form-control" type="number" step="0.01" min="0.01" name="venta" id="venta" placeholder="Precio Compra">
                            </div>
                            <span id="errorVenta" class="text-danger"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="id_medida">Medida</label>
                                <select id="id_medida" class="form-control" name="id_medida">
                                    <option value="">Seleccionar</option>
                                    <!-- -->
                                    <?php foreach ($data['medidas'] as $medida) { ?>
                                        <option value="<?php echo $medida['id_medida'] ?>"><?php echo $medida['medida'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                            <span id="errorMedida" class="text-danger"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="id_categoria">Categoria</label>
                                <select id="id_categoria" class="form-control" name="id_categoria">
                                    <option value="">Seleccionar</option>
                                    <!-- -->
                                    <?php foreach ($data['categorias'] as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['nom_categoria'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                            <span id="errorCategoria" class="text-danger"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="foto">Foto (Opcional)</label>
                                <input id="foto" class="form-control" type="file" name="foto">
                            </div>
                            <div id=containerPreview>

                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-danger" type="button" id="btnNuevo">Nuevo</button>
                        <button class="btn btn-primary" id="btnAccion" type="submit">Registrar</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php' ?>
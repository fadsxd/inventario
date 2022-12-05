<?php include_once 'views/templates/header.php' ?>



<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div></div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'proveedor/inactivos'; ?>"><i class="fas fa-trash text-danger"></i> Inactivos</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="proveedores-tab" data-bs-toggle="tab" data-bs-target="#nav-proveedores" type="button" role="tab" aria-controls="nav-proveedores" aria-selected="true">Proveedores</button>
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo</button>
        </nav>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-2" id="nav-proveedores" role="tabpanel" aria-labelledby="proveedores-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-users"></i>Listado de Proveedores</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover nowrap" id="tblProveedores" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>NIT</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Dirección</th>
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

                    <div class="row mb-3">

                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Nombre</span>
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre">
                            </div>
                            <span id="errorNombre" class="text-danger"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Nit</span>
                                <input class="form-control" type="text" name="nit" id="nit" placeholder="Ingrese Nit">
                            </div>
                            <span id="errorNit" class="text-danger"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Telefono</span>
                                <input class="form-control" type="number" name="telefono" id="telefono" placeholder="Ingrese Telefono">
                            </div>
                            <span id="errorTelefono" class="text-danger"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Dirección</span>
                                <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Ingrese Dirección">
                            </div>
                            <span id="errorDireccion" class="text-danger"></span>
                        </div>

                    </div>
                    <div class="text-end">
                        <button class="btn btn-danger" id="btnNuevo" type="button">Nuevo</button>
                        <button class="btn btn-primary" id="btnAccion" type="submit">Registrar</button>

                    </div>
                </form>
            </div>

        </div>

    </div>
</div>



<?php include_once 'views/templates/footer.php' ?>
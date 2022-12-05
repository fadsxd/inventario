<?php include_once 'views/templates/header.php' ?>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div></div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'clientes/inactivos'; ?>"><i class="fas fa-trash text-danger"></i> Inactivos</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="clientes-tab" data-bs-toggle="tab" data-bs-target="#nav-clientes" type="button" role="tab" aria-controls="nav-clientes" aria-selected="true">Clientes</button>
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo</button>
        </nav>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-2" id="nav-clientes" role="tabpanel" aria-labelledby="clientes-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-users"></i>Listado de Clientes</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover nowrap" id="tblClientes" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Nro. Documento</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Correo</th>
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
                                <span class="input-group-text" style="color:#229afe;">Telefono</span>
                                <input class="form-control" type="number" name="telefono" id="telefono" placeholder="Ingrese Telefono">
                            </div>
                            <span id="errorTelefono" class="text-danger"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Correo</span>
                                <input class="form-control" type="email" name="correo" id="correo" placeholder="Ingrese Correo">
                            </div>
                            <span id="errorCorreo" class="text-danger"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Dirección</span>
                                <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Ingrese Dirección">
                            </div>
                            <span id="errorDireccion" class="text-danger"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="documento">TIPO DOCUMENTO</label>
                                <select id="documento" class="form-control" name="documento">
                                    <option value="">SELECCIONE</option>
                                    <option value="C.I.">CEDULA IDENTIDAD</option>
                                    <option value="PASAPORTE">PASAPORTE</option>
                                </select>
                            </div>
                            <span id="errorDocumento" class="text-danger"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">N° Documento</span>
                                <input class="form-control" type="text" name="numero" id="numero" placeholder="Ingrese Número">
                            </div>
                            <span id="errorNumero" class="text-danger"></span>
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
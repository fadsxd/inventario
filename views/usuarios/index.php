<?php include_once 'views/templates/header.php' ?>

<div class="card">

    <div class="card-body ">
        <div class="d-flex align-items-center">
            <div></div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php  echo BASE_URL.'usuarios/inactivos';?>"><i class="fas fa-trash text-danger"></i> Inactivos</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#nav-usuarios" type="button" role="tab" aria-controls="nav-usuarios" aria-selected="true">Usuarios</button>
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo</button>
        </nav>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-2" id="nav-usuarios" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-users"></i>Listado de Usuarios</h5>
                <hr>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover nowrap" id="tblUsuarios" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Dirección</th>
                            <th>Rol</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>
                </table>
                </div>
                
            </div>
            <div class="tab-pane fade" id="nav-nuevo" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <form class="p-4" id="formulario" autocomplete="off">
                    <input type="hidden" id="id_usuario" name="id_usuario">
                    <div class="row ">
                        
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Nombres</span>
                                <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Ingrese Nombres">
                            </div>
                            <span id="errorNombres" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Apellidos</span>
                                <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Ingrese Apellidos">
                            </div>
                            <span id="errorApellidos" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Correo</span>
                                <input type="email" id="correo" name="correo" class="form-control" placeholder="Ingrese Correo">
                            </div>
                            <span id="errorCorreo" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Teléfono</span>
                                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese Teléfono">
                            </div>
                            <span id="errorTelefono" class="text-danger"></span>
                        </div>
                        <div class="col-lg-8 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Dirección</span>
                                <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese Dirección">
                            </div>
                            <span id="errorDireccion" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Contraseña</span>
                                <input type="password" id="clave" name="clave" class="form-control" placeholder="Ingrese Contraseña">
                            </div>
                            <span id="errorClave" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <label class="input-group-text" style="color:#229afe;" for="rol">Rol</label>
                                <select class="form-select" id="rol" name="rol">
                                    <option value="" selected>Seleccionar</option>
                                    <option value="1">ADMINISTRADOR</option>
                                    <option value="2">VENDEDOR</option>

                                </select>
                            </div>
                            <span id="errorRol" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-danger" type="button" id="btnNuevo">Nuevo</button>
                        <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                    </div>
                </form>
            </div>

        </div>



    </div>
</div>

<?php include_once 'views/templates/footer.php' ?>
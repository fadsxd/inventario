<?php include_once 'views/templates/header.php' ?>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div></div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'medidas/inactivos'; ?>"><i class="fas fa-trash text-danger"></i> Inactivos</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="medidas-tab" data-bs-toggle="tab" data-bs-target="#nav-medidas" type="button" role="tab" aria-controls="nav-medidas" aria-selected="true">Medidas</button>
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo</button>
        </nav>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-2" id="nav-medidas" role="tabpanel" aria-labelledby="medidas-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-list"></i>Listado de Medidas</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover nowrap" id="tblMedidas" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Simbolo</th>
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
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">Nombre</span>
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre">
                            </div>
                            <span id="errorNombre" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" id="my-addon">Simbolo</span>
                                <input class="form-control" type="text" name="nombre_corto" id="nombre_corto" placeholder="Simbolo">
                            </div>
                            <span id="errorNombreCorto" class="text-danger"></span>
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
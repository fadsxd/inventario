<?php include_once 'views/templates/header.php'?>

<?php  
//print_r($data['empresa']);
?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center">Datos de la Empresa</h5>
        <hr>
        <form class="p-4" id="formulario" autocomplete="off">
                    <input type="hidden" id="id" name="id" value="<?php echo $data['empresa']['id'];  ?>">
                    <div class="row ">
                        
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;">NIT</span>
                                <input type="text" id="nit" name="nit" class="form-control" value="<?php echo $data['empresa']['nit'];  ?>" placeholder="Ingrese Ruc">
                            </div>
                            <span id="errorNit" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Nombre</span>
                                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $data['empresa']['nombre'];  ?>" placeholder="Ingrese Nombre">
                            </div>
                            <span id="errorNombre" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Teléfono</span>
                                <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo $data['empresa']['telefono'];  ?>" placeholder="Ingrese Teléfono">
                            </div>
                            <span id="errorTelefono" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Correo</span>
                                <input type="email" id="correo" name="correo" class="form-control" value="<?php echo $data['empresa']['correo'];  ?>" placeholder="Ingrese Correo">
                            </div>
                            <span id="errorCorreo" class="text-danger"></span>
                        </div>
                        <div class="col-lg-8 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Dirección</span>
                                <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $data['empresa']['direccion'];  ?>" placeholder="Ingrese Dirección">
                            </div>
                            <span id="errorDireccion" class="text-danger"></span>
                        </div>
                       
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text" style="color:#229afe;" >Impuesto</span>
                                <input type="number" id="impuesto" name="impuesto" class="form-control" value="<?php echo $data['empresa']['impuesto'];  ?>" placeholder="Impuesto">
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-6 mb-2">
                            <div class="form-group">
                                <label for="mensaje">Mensaje (Opcional)</label>
                                <textarea id="mensaje" class="form-control" name="mensaje" rows="3"><?php echo $data['empresa']['mensaje']; ?>"</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary" type="submit" id="btnAccion">Actualizar</button>
                    </div>
                </form>
    </div>
</div>


<?php include_once 'views/templates/footer.php'?>
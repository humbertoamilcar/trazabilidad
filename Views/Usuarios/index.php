<?php include "Views/Templates/header.php";?>

<!-- BEGIN: Content-->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
       <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
  <h4 class="mb-0"><span class="text-muted fw-light">USUARIOS /</span> Lista</h4>
  <button class="btn btn-primary" onclick="frmUsuario();">
    REGISTRAR NUEVO USUARIO <i class="fas fa-users"></i>
  </button>
</div>


        <!-- Invoice List Widget -->
        <div class="card mb-4">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                            <!-- Statistics -->
                            <div class="col-lg-8 mb-4 col-md-12">
                              <div class="card h-100">
                                <div class="card-header d-flex justify-content-between">
                                  <h5 class="card-title mb-0">ESTADISTICAS</h5>
                                  <small class="text-muted">ACTUALIZADO AL MES DE AGOSTO</small>
                                </div>
                                <div class="card-body pt-2">
                                  <div class="row gy-3">
                                    <div class="col-md-3 col-6">
                                      <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                          <i class="ti ti-chart-pie-2 ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                          <h5 class="mb-0">230k</h5>
                                          <small>Ventas</small>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                      <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-info me-3 p-2">
                                          <i class="ti ti-users ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                          <h5 class="mb-0">8.549k</h5>
                                          <small>Clientes</small>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                      <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                          <i class="ti ti-shopping-cart ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                          <h5 class="mb-0">1.423k</h5>
                                          <small>Productos</small>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                      <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                          <i class="ti ti-currency-dollar ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                          <h5 class="mb-0">$9745</h5>
                                          <small>Total Ventas</small>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Orders -->
                            <div class="col-lg-2 col-6 mb-4">
                              <div class="card h-100">
                                <div class="card-body text-center">
                                  <div class="badge rounded-pill p-2 bg-label-danger mb-2">
                                    <i class="ti ti-briefcase ti-sm"></i>
                                  </div>
                                  <h5 class="card-title mb-2">97.8k</h5>
                                  <small>Ordenes</small>
                                </div>
                              </div>
                            </div>

                            <!-- Reviews -->
                            <div class="col-lg-2 col-6 mb-4">
                              <div class="card h-100">
                                <div class="card-body text-center">
                                  <div class="badge rounded-pill p-2 bg-label-success mb-2">
                                    <i class="ti ti-message-dots ti-sm"></i>
                                  </div>
                                  <h5 class="card-title mb-2">3.4k</h5>
                                  <small>Ingresos</small>
                                </div>
                              </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de usuarios -->
            <div class="card">
              <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table">
                  <thead class="table-primary">
                    <tr>
                      <th></th>
                      <th></th>
                      <th>ID</th>
                      <th>NOMBRES Y APELLIDOS</th>
                      <th>CORREO ELECTRÓNICO</th>
                      <th>FECHA DE REGISTRO</th>
                      <th>DNI</th>
                      <th>ESTADO</th>
                      <th>ACCIONES</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

            
             

                <!-- Modal de Registro de Usuario -->
                <div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="title">REGISTRAR NUEVO USUARIO</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form method="POST" id="frmUsuario" enctype="multipart/form-data">
                                    
                                    <!-- Usuario -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Ingrese el usuario" required>
                                                <label for="usuario">Ingrese el Usuario</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Ingrese su Dirección" required>
                                                <label for="direccion">Ingrese su Dirección </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Nombres y Apellidos -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Ingrese los Nombres" required>
                                                <label for="nombre">Ingrese los Nombres</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input id="apellidos" class="form-control" type="text" name="apellidos" placeholder="Ingrese los Apellidos" required>
                                                <label for="apellidos">Ingrese los Apellidos</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Dni y Celular -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input id="dni" class="form-control" type="number" name="dni" placeholder="Ingrese su dni|" required>
                                                <label for="dni">Ingrese el numero de su dni</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input id="celular" class="form-control" type="text" name="celular" placeholder="Ingrese el numero de su celular" required>
                                                <label for="celular">Ingrese el numero de su celular</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rol y Almacén -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="caja" name="caja" aria-label="Seleccione el rol de Caja" required>
                                                    <option value="" selected>----Seleccione----</option>
                                                    <?php foreach ($data['cajas'] as $row) { ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['caja']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="caja">Seleccione el rol de Caja</label>
                                            </div>
                                        </div>

                                        <!-- Almacén: Solo los administradores pueden ver todos los almacenes -->
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="almacen" name="almacen" aria-label="Seleccione el Almacén" required>
                                                    <option value="" selected>----Seleccione el Almacén----</option>
                                                    <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                        <?php foreach ($data['almacenes'] as $almacen) { ?>
                                                            <option value="<?php echo $almacen['id']; ?>"><?php echo $almacen['nombre']; ?></option>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $_SESSION['id']; ?>" selected><?php echo $_SESSION['almacen_nombre']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="almacen">Seleccione el Almacén</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contraseña y Confirmar Contraseña -->
                                    <div class="row" id="passwords">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input id="password" class="form-control" type="password" name="password" placeholder="Ingrese la Contraseña" required>
                                                <label for="password">Ingrese la Contraseña</label>
                                            </div>
                                        </div>                                                                    
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirme la Contraseña" required>
                                                <label for="confirmar">Confirme la Contraseña</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Fotografía del Usuario -->
                                    <div class="col-sm-12">
                                        <div class="form-control">
                                            <label>Imagen referencial del usuario</label>
                                            <div class="card border-primary">
                                                <div class="card-body">
                                                    <input id="fotousuario" class="d-none" type="file" name="fotousuario" onchange="preview(event)" accept="image/*" required>
                                                    <input type="hidden" id="foto_actual" name="foto_actual">
                                                    
                                                    <center><img class="img-thumbnail" id="img-preview" width="200" height="200"></center>
                                                    <label for="fotousuario" id="icon-image" class="btn btn-primary">
                                                        <i class="fas fa-image"></i></label>
                                                    <span id="icon-cerrar"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Usuario</button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div><!-- /.modal -->
            
      



    </div><!-- /.content-wrapper -->
</div><!-- /.content -->

<?php include "Views/Templates/footer.php"; ?>

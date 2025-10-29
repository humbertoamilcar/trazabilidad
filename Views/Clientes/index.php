<?php include "Views/Templates/header.php";?>


<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">CLIENTE /</span> Lista</h4>
               <button class="btn btn-primary" onclick="frmCliente();">REGISTRAR NUEVO CLIENTE <i class="fas fa-users"></i> </button><h5></h5>
               
              <!-- Invoice List Widget -->

              <div class="card mb-4">
                <div class="card-widget-separator-wrapper">
                  <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                      <div class="col-sm-6 col-lg-3">
                        <div
                          class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                          <div>
                            <h3 class="mb-1">04</h3>
                            <p class="mb-0">Usuarios Activos</p>
                          </div>
                          <span class="avatar me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"
                              ><i class="ti ti-user ti-md"></i
                            ></span>
                          </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-4" />
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div
                          class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                          <div>
                            <h3 class="mb-1">03</h3>
                            <p class="mb-0">Usuarios Inactivos</p>
                          </div>
                          <span class="avatar me-lg-4">
                            <span class="avatar-initial bg-label-secondary rounded"
                              ><i class="ti ti-file-invoice ti-md"></i
                            ></span>
                          </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none" />
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div
                          class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                          <div>
                            <h3 class="mb-1">325</h3>
                            <p class="mb-0">Accesos a la Plataforma</p>
                          </div>
                          <span class="avatar me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"
                              ><i class="ti ti-checks ti-md"></i
                            ></span>
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <div>
                            <h3 class="mb-1">235</h3>
                            <p class="mb-0">Total Usuarios</p>
                          </div>
                          <span class="avatar">
                            <span class="avatar-initial bg-label-secondary rounded"
                              ><i class="ti ti-circle-off ti-md"></i
                            ></span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Invoice List Table -->
              <div class="card">
                <div class="card-datatable table-responsive">
                  <table class="table table-striped table-bordered nowrap" id="tblClientes">
                    <thead>
                      <tr>
                       
                        <th><font size="3">ID</font></th>
                        <th><font size="3">DNI</font></th>
                        <th><font size="3">NOMBRES</font></th>
                        <th><font size="3">APELLIDOS</font></th>
                        <th><font size="3">TELEFONO</font></th>
                        <th><font size="3">DIRECCION</font></th>
                        <th><font size="3">ESTADO</font></th>
                                                        
                        <th class="cell-fit">ACCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                  </table>

                    <div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog"     aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                             <div class="modal-header bg-primary">
                               <h5 class="modal-title text-white" id="title">REGISTRAR NUEVO CLIENTE</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" id="frmCliente">
                                  <div class="form-floating mb-3" style="display: none">
                                    <input id="dni" class="form-control" type="text" name="dni" placeholder="Ingrese el documento de Identidad" >
                                    <label for="dni">Ingrese el DNI del Cliente</label>
                                  </div>
                                  <div class="form-floating mb-3" >
                                  <input id="nombres" class="form-control" type="text" name="nombres" placeholder="Ingrese los Nombres del Cliente" >
                                  <input type="hidden" id="id" name="id">
                                  <label for="nombres">Ingrese los Nombres del Cliente</label>
                                  </div>
                                  <div class="form-floating mb-3" style="display: none">
                                  <input id="apellidos" class="form-control" type="text" name="apellidos" placeholder="Ingrese los Apellidos del Cliente" >
                                  <label for="nombres">Ingrese los Apellidos del Cliente</label>
                                  </div>
                                  <div class="form-floating mb-3" style="display: none">
                                  <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Ingrese numero de celular del Cliente" >
                                  <label for="celular">Ingrese el numero de Celular del Cliente</label>
                                  </div>                                         
                                  <div class="form-floating mb-3" style="display: none">
                                  <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Ingrese la direccion del cliente" >
                                  <label for="direccion">Ingrese la direccion del Cliente</label>
                                  </div>
                                                      
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal" data-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-primary" onclick="registrarCli(event);"><i class="fas fa-save"></i>  Guardar Cliente</button>
                                                        </form>
                                                    </div>

                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                </div>
              </div>
            </div>
            <!-- / Content -->
 


                       
            

<?php include "Views/Templates/footer.php"; ?>


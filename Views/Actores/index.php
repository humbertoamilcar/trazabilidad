<?php include "Views/Templates/header.php";?>
 

<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">ROLES /</span> Lista</h4>
               <button class="btn btn-primary" onclick="frmCaja();">REGISTRAR NUEVO ROL <i class="fas fa-users"></i> </button><h5></h5>
               
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
                            <p class="mb-0">Roles Activos</p>
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
                            <p class="mb-0">Roles Inactivos</p>
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
                  <table class="table table-striped table-bordered nowrap" id="tblCaja">
                    <thead>
                      <tr>
                       
                        <th><font size="3">ID</font></th>
                        <th><font size="3">CAJA</font></th>
                        <th><font size="3">ESTADO</font></th>
                        <th class="cell-fit">ACCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                  </table>

                    <div id="nuevo_caja" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white" id="title">REGISTRAR NUEVO CLIENTE</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">

                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                          <form method="POST" id="frmCaja">
                                                        <div class="form-floating mb-3">
                                                            <input id="caja" class="form-control" type="text" name="caja" placeholder="Ingrese el nuevo Rol" >
                                                            <input type="hidden" id="id" name="id">
                                                            <label for="caja">Ingrese la caja</label>
                                                        </div>
                                                      

                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal" data-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-primary" onclick="registrarCaja(event);"><i class="fas fa-save"></i>  Guardar Cliente</button>
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


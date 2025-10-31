<?php include "Views/Templates/header.php";?>
 

<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">CAJA CHICA/</span> Arqueo de Caja</h4>
               <button class="btn btn-primary" onclick="arqueoCaja();"> <i class="fas fa-users"> </i>_INICILIALIZAR CAJA </button>
               <button class="btn btn-danger" onclick="cerrarCaja();"> <i class="fas fa-close"> </i>_CERRAR CAJA </button><h5></h5>
               
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
                  <table class="table table-striped table-bordered nowrap" id="t_arqueo">
                    <thead>
                      <tr>
                       
                        <th><font size="3">ID</font></th>
                       
                     
                        <th><font size="3">M_INICIAL</font></th>
                        <th><font size="3">M_FINAL</font></th>
                        <th><font size="3">F_APERTURA</font></th>
                        <th><font size="3">F_CIERRE</font></th>
                        <th><font size="3">T_VENTAS</font></th>
                        <th><font size="3">M_TOTAL</font></th>
                        <th><font size="3">ESTADO</font></th>
                        <th><font size="3">ACCIONES</font></th>
                      </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                  </table>

<div id="abrir_caja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title">ARQUEO DE CAJA</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
      </div>
            <div class="modal-body">
              <form method="POST" id="frmAbrirCaja" onsubmit="abrirArqueo(event)">
                <div class="form-floating mb-3">
                  <input type="hidden" id="id" name="id">
                  <input id="monto_inicial" class="form-control" type="text" name="monto_inicial" placeholder="Monto Inicial" >
                  <label for="monto_inicial">Ingrese el monto inicial</label>
                </div>


                <div id="ocultar_campos" name="ocultar_campos">

                    <div class="form-floating mb-3">
                      <input id="monto_final" class="form-control" type="text" disabled >
                      <label for="monto_final">Monto Final</label>
                    </div> 
                    
                    <div class="form-floating mb-3">
                      <input id="total_ventas" class="form-control" type="text" disabled >
                      <label for="total_ventas">Total Ventas</label>
                    </div> 

                    <div class="form-floating mb-3">
                      <input id="monto_general" class="form-control" type="text" disabled >
                      <label for="Monto_General">Monto Total</label>
                    </div> 

                  
                </div>

                
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btnAccion"><i class="fas fa-save "></i>Monto Inicial</button>
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


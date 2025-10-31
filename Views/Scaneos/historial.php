<?php include "Views/Templates/header.php";?>
 <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Lista /</span> Compras de Productos</h4>

              <!-- Invoice List Widget -->

              <div class="card mb-4">
                <div class="card-widget-separator-wrapper">
                  <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                      <div class="col-sm-6 col-lg-3">
                        <div
                          class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                          <div>
                            <h3 class="mb-1">24</h3>
                            <p class="mb-0">Clientes</p>
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
                            <h3 class="mb-1">165</h3>
                            <p class="mb-0">Invoices</p>
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
                            <h3 class="mb-1">$2.46k</h3>
                            <p class="mb-0">Paid</p>
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
                            <h3 class="mb-1">$876</h3>
                            <p class="mb-0">Unpaid</p>
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
                  <table class="invoice-list-table table border-top" id="t_historial_c">
                    <thead>
                      <tr>
                     
                        <th>#ID</th>
                        
                     
                        <th>Total</th>
                       
                        
                        <th>Fecha compra</th>
                        <th>Estado</th>

                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    	
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- / Content -->

       

           
          </div>
          <!-- Content wrapper -->





<?php include "Views/Templates/footer.php"; ?>
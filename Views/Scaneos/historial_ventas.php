<?php include "Views/Templates/header.php";?>
 <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Lista /</span> Ventas de Productos</h4>

              <h5 class="pb-1 mb-4">Reporte de Ventas por fecha</h5>
              <form id="miFormulario"  method="POST"  target="blank">
                   <div class="row" id="sortable-4">
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-success text-white mb-3">
                    <div class="card-header cursor-move">Seleccione la fecha de inicio</div>
                    <div class="card-body">
                      <?php $ayer = date('Y-m-d'); ?>
                      <input class="form-control" type="date" value="<?php echo $ayer ?>" name="desde" id="min">
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-success text-white mb-3">
                    <div class="card-header cursor-move">Seleccione la fecha final</div>
                    <div class="card-body">
                      <?php $manana = date('Y-m-d'); ?>
                      <input class="form-control" type="date" value="<?php echo $manana; ?>" name="hasta"  id="hasta">
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-4">
                  <div class="card bg-success text-white mb-3">
                    <div class="card-header cursor-move">Imprima su Reporte en formato PDF</div>
                    <div class="card-body">
                      
                      <button type="button" class="btn btn-label-warning waves-effect" onclick="enviarPdf()">
                        <i class="fa-solid fa-file-pdf"></i> Reporte Detallado
                    </button>

                    <!-- Botón para enviar a la URL Compras/pdf1 -->
                    <button type="button" class="btn btn-label-info waves-effect" onclick="enviarPdf1()">
                        <i class="fa-solid fa-file-pdf"></i> Reporte Completo
                    </button>
                    </div>
                  </div>
                </div>
             
          
              </div>

              </form>
              <script>
    // Función para enviar el formulario a Compras/pdf
    function enviarPdf() {
        var form = document.getElementById('miFormulario');
        form.action = '<?php echo base_url; ?>Compras/pdf';
        form.submit();  // Envía el formulario
    }

    // Función para enviar el formulario a Compras/pdf1
    function enviarPdf1() {
        var form = document.getElementById('miFormulario');
        form.action = '<?php echo base_url; ?>Compras/pdf1';
        form.submit();  // Envía el formulario
    }
</script>

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
                  <table class="invoice-list-table table border-top" id="t_historial_v">
                    <thead>
                      <tr>
                     
                        <th>#ID</th>
                        <th>Clientes</th>                     
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
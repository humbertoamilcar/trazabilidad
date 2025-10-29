            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                  <div>
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , Hecho  <a href="#" target="_blank" class="fw-medium">a mano</a> Echo con ❤️.
                  </div>
                  <div class="d-none d-lg-inline-block">
                    <a href="#" class="footer-link me-4" target="_blank">License</a>
                    <a href="#" target="_blank" class="footer-link me-4">More Themes</a>
                    <a href="#" target="_blank" class="footer-link me-4">Documentation</a>
                    <a href="#" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js Assets/vendor/js/core.js -->

<div id="cambiarPass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white" id="title">MODIFICAR CONTRASEÑA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form id="frmCambiarPass" onsubmit="frmCambiarPass(event);">
            <div class="modal-body">
                <div class="form-floating mb-3">
                  <input id="clave_actual" class="form-control" type="password" name="clave_actual" placeholder="Contraseña Actual" >
                  <label for="dni">Contraseña Actual</label>
                </div>
                
                <div class="form-floating mb-3">
                  <input id="clave_nueva" class="form-control" type="password" name="clave_nueva" placeholder="Contraseña Nueva" >
                  <label for="dni">Contraseña Nueva</label>
                </div>
                
                <div class="form-floating mb-3">
                  <input id="confirmar_clave" class="form-control" type="password" name="confirmar_clave" placeholder="Confirmar Contraseña" >
                  <label for="dni">Confirmar Contraseña</label>
                </div>
                                                
              <div class="modal-footer">
                <button type="button" class="btn btn-danger"data-bs-dismiss="modal" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" ><i class="fas fa-users"></i> Cambiar Contraseña</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <!--<script> const base_url = "<?= BASE_URL ?>";</script>-->
    <script>window.base_url = "<?= BASE_URL ?>";</script>
    
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/js/menu.js"></script>


    <!-- endbuild -->

    <!-- Vendors JS -->
    
    <!-- Flat Picker -->
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/moment/moment.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/select2/select2.js"></script>

    <!-- Main JS -->
    <script src="<?php echo BASE_URL; ?>Assets/js/main.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/js/funciones.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    
   
        <!-- Main JS -->
    
    <script src="<?php echo BASE_URL; ?>Assets/vendor/libs/sweetalert2/sweetalert2.js"></script>

    <!-- Page JS-->
 
    <script src="<?php echo BASE_URL; ?>Assets/js/app-academy-dashboard.js"></script>
    <script src="<?php echo BASE_URL; ?>Assets/js/datatablesusuarios.js"></script>
     
   

  </body>
</html>
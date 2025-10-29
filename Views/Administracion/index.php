<?php include "Views/Templates/header.php";?>


<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">DATOS DE LA EMPRESA /</span> Lista</h4>
              <button class="btn btn-primary" onclick="frmCliente();">REGISTRAR NUEVO CLIENTE <i class="fas fa-users"></i> </button>
               
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
                <form id="frmEmpresa">
                  <div class="row">

                    <div class="col-md-6">
                         <input id="id" class="form-control" type="hidden" value="<?php echo $data['id']  ?>" name="id">
                        <div class="form-floating mb-3">
                         
                          <input id="nombre" class="form-control" type="text" value="<?php echo $data['nombre']  ?>" name="nombre" placeholder="Ingrese el Nombre de la Empresa" >
                          <label for="nombre">Ingrese el nombre de la Empresa</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input id="telefono" class="form-control" type="text" value="<?php echo $data['telefono']  ?>" name="telefono" placeholder="Ingrese el numero de Telefono" >
                          <label for="telefono">Ingrese el numero de Telefono</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <input id="direccion" class="form-control" type="text" value="<?php echo $data['direccion']  ?>" name="direccion" placeholder="Ingrese la dirección" >
                          <label for="direccion">Ingrese la Dirección</label>
                        </div>                                         
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input id="mensaje" class="form-control" type="text" value="<?php echo $data['mensaje']  ?>" name="mensaje" placeholder="Ingrese el mensaje" >
                        <label for="mensaje">Ingrese el mensaje</label>
                      </div>
                    </div>

                  </div>
                  
                  <button class="btn btn-primary" onclick="modificarEmpresa()">Modificar Datos</button>

              
                </form>
                <br>
              </div>
               <!-- / Content -->
 
</div>

                       
            

<?php include "Views/Templates/footer.php"; ?>


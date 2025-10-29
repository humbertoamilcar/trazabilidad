<?php include "Views/Templates/header.php";?>
 
     

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
       <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
  <h4 class="mb-0"><span class="text-muted fw-light">PRODUCTOS /</span> Lista</h4>
  <button class="btn btn-primary" onclick="frmProducto();">
    REGISTRAR NUEVO PRODUCTO <i class="fas fa-users"></i>
  </button>
</div>

              <!-- Invoice List Widget -->

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
                                  <small class="text-muted"><strong>ACTUALIZADO AL: <?php echo date("Y-M-D H:i:s"); ?></strong></small>
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


              <!-- Invoice List Table -->
              <div class="card">
                <div class="card-datatable table-responsive">
                  <table class="table table-striped table-bordered nowrap" id="tblProductos">
                    <thead>
                      <tr>
                       
                        <th><font size="3">ID</font></th>
                        <th><font size="3">FOTO</font></th>
                            <th><font size="3">NOMBRE</font></th>
                            <th><font size="3">DESCRIPCION</font></th>
                         
                            <th><font size="3">SKU</font></th>
                            <th><font size="3">EMPRESA</font></th>
                            <th><font size="3">ESTADO</font></th>
                            <th><font size="3">ACCIONES</font></th>
                      </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                  </table>
<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" 
aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title">REGISTRAR NUEVO USUARIO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
        </div>
        <div class="modal-body">
        <form method="POST" id="frmProducto">
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input id="codigo" class="form-control" type="text" name="codigo" 
                    placeholder="Ingrese el codigo" >
                    <label for="codigo">Codigo de Barras</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input id="nombre" class="form-control" type="text" name="nombre" 
                    placeholder="Ingrese los Nombres" >
                    <input type="hidden" id="id" name="id">
                    <label for="nombres">Ingrese la descripcion del Producto</label>
                </div>
            </div>
        </div>
       <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input id="precio_compra" class="form-control" type="text" 
                    name="precio_compra" placeholder="Ingrese el precio compra">
                    <label for="precio_compra">Ingrese el precio compra</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input id="precio_venta" class="form-control" type="text" 
                    name="precio_venta" placeholder="Ingrese el precio venta" >
                    <label for="precio_venta">Ingrese el precio de Venta</label>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="medida" name="medida" 
                    aria-label="Seleccione la Medida">
                        <option value ="" selected>----Seleccione----</option>
                            <?php foreach ($data['medidas'] as $row) { ?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['nombres'];?> </option>   
                            <?php } ?>
                    </select>
                    <label for="floatingSelect">Seleccione la Medida</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="categoria" name="categoria" 
                    aria-label="Seleccione la categoria">
                        <option value ="" selected>----Seleccione----</option>
                            <?php foreach ($data['categorias'] as $row) { ?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['nombres'];?> </option>   
                            <?php } ?>
                    </select>
                    <label for="floatingSelect">Seleccione la Categoria</label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-control">
                    <label>Imagen referencial del producto</label>
                    <div class="card border-primary">
                        <div class="card-body">
                            <input id="imagen" class="d-none" type="file" name="imagen" 
                            onchange="preview(event)" >
                            <input type="hidden" id="foto_actual" name="foto_actual">
                            
                            <center><img class="img-thumbnail" id="img-preview" 
                                width="200" height="200"></center>
                            <label for="imagen" id="icon-image" class="btn btn-primary">
                                <i class="fas fa-image"></i></label>
                            <span id="icon-cerrar"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" 
        data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="registrarPro(event);">
            <i class="fas fa-save"></i>  Guardar Producto</button>
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


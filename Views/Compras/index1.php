<?php include "Views/Templates/header.php";?>
 

<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">COMPRAS /</span> Lista</h4>
               
              <!-- Invoice List Widget -->
            <div class="card">
                <div class="card-body">
                    <form id="frmCompra">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="codigo"> Codigo</label>
                                    <input type="hidden" name="id" id="id">
                                    <input id="codigo" type="text" name="codigo" class="form-control" placeholder="Ingrese el Codigo" onkeyup="buscarCodigo(event)" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre"> Descripción del Producto</label>
                                    <input id="nombre" type="text" name="nombre" class="form-control" placeholder="Descripción del Producto" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="cantidad"> Cantidad</label>
                                    <input id="cantidad" type="number" name="cantidad" class="form-control" placeholder="Cantidad" onkeyup="calcularPrecio(event)">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <input id="precio" type="number" name="precio" class="form-control" placeholder="Precio" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sub_total">Sub Total</label>
                                    <input id="sub_total" type="number" name="sub_total" class="form-control" placeholder="sub_total" disabled>
                                </div>
                            </div>

                        </div>
                                   </div>
            </div> 
           <br>

              <!-- Invoice List Table -->
              <div class="row">
                <div class="col-12 col-lg-8">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="card-title m-0">Detalles de la Compra</h5>
                      <h6 class="m-0"><a class="btn btn-primary" href="#">Generar Compra</a></h6>
                    </div>
                    <div class="card-datatable table-responsive">
                      <table class="datatables-order-details table border-top">
                        <thead>
                          <tr>
                           
                            <th></th>
                            
                            <th class="w-15">ID</th>
                            
                            <th class="w-40">DESCRIPCION</th>
                            <th class="w-15">CANTIDAD</th>
                            <th class="w-15">PRECIO</th>
                            <th class="w-15">SUBTOTAL</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody id="tblDetalle">
                            
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-end align-items-center m-3 mb-2 p-1">
                        <div class="order-calculations">
                          <div class="d-flex justify-content-between mb-2">
                            <span class="w-px-100 text-heading">Sub total:</span>
                            <h6 class="mb-0">$000</h6>
                          </div>
                          <div class="d-flex justify-content-between mb-2">
                            <span class="w-px-100 text-heading">Descuentos:</span>
                            <h6 class="mb-0">$00</h6>
                          </div>
                          <div class="d-flex justify-content-between mb-2">
                            <span class="w-px-100 text-heading">Ticktes:</span>
                            <h6 class="mb-0">$00</h6>
                          </div>
                          <div class="d-flex justify-content-between">
                            <h6 class="w-px-100 mb-0">Total:</h6>
                            <input type="" name=""><h6 class="mb-0"></h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
                  </div>




                    
                </div>
    
            <!-- / Content -->
 
   </form>           
            

<?php include "Views/Templates/footer.php"; ?>


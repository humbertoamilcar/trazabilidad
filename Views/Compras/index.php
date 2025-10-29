<?php include "Views/Templates/header.php";?>
 
<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">REGISTRO /</span> Lotes de productos</h4>
               
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
                        </div><br>

              <!-- Invoice List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                <table class="table table-striped table-bordered nowrap" id="tblCompras">
                    <thead>
                        <tr>
                            <th class="w-15">ID</th>
                            <th class="w-15">DESCRIPCION</th>
                            <th class="w-15">CANTIDAD</th>
                            <th class="w-15">PRECIO</th>
                            <th class="w-15">SUBTOTAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tblDetalle">
                        
                    </tbody>

                </table>
                    <div class="row justify-content-center justify-content-md-start">
                        <div class="col-md-4 align-self-end">
                            <label for="total" class="font-weight-bold">Total</label>
                            <input id="total" type="text" name="total" class="form-control">
                            <button class="btn btn-primary mt-2 btn-block"  type="button" onclick="procesar(1)">
                            Generar Lote</button>
                        </div>
                    </div>

         </div>  
            </div>
            </div>  
            </div>
             </div>
</div>  
              </form>
            
            <!-- / Content -->
 <?php include "Views/Templates/footer.php"; ?>


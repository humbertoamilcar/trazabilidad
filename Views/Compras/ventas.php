<?php include "Views/Templates/header.php";?>
 
<!-- Content wrapper -->

<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">VENTAS /</span> Lista</h4>
  <form id="frmVenta">
    <!-- Datos del Trabajador -->
    <div class="card bg-light p-3 mb-4">
      <h5 class="card-title mb-3">Datos del Trabajador</h5>
      <div class="row g-3 align-items-end">
        <!-- DNI -->
        <div class="col-md-2">
          <div class="form-group">
            <label for="dni" class="form-label">DNI</label>
            <input id="id_cliente" type="hidden" name="id_cliente" />
            <input id="dni" type="text" name="dni" class="form-control" placeholder="Ingrese su DNI" onkeyup="buscarCodigoCliente(event)">
          </div>
        </div>
        <!-- Nombres -->
        <div class="col-md-3">
          <div class="form-group">
            <label for="nombres" class="form-label">Nombre del Cliente</label>
            <input id="nombres" type="text" name="nombres" class="form-control" placeholder="Nombres" disabled>
          </div>
        </div>
        <!-- Apellidos -->
        <div class="col-md-3">
          <div class="form-group">
            <label for="apellidos" class="form-label">Apellidos del Cliente</label>
            <input id="apellidos" type="text" name="apellidos" class="form-control" placeholder="Apellidos" disabled>
          </div>
        </div>
        <!-- Dirección -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="direccion" class="form-label">Dirección del Cliente</label>
            <input id="direccion" type="text" name="direccion" class="form-control" placeholder="Dirección" disabled>
          </div>
        </div>
      </div>
    </div>

    <!-- Formulario de Venta -->
  
      <div class="card bg-light p-3 mb-4">
        <h5 class="card-title mb-3">Ingresar Datos del Producto</h5>
        <div class="row g-3 align-items-end">
          <!-- Código -->
          <div class="col-md-2">
            <div class="form-group">
              <label for="codigo">Código</label>
              <input type="hidden" name="id" id="id">
              <input id="codigo" type="text" name="codigo" class="form-control" placeholder="Ingrese el Código" onkeyup="buscarCodigoVenta(event)">
            </div>
          </div>
          <!-- Descripción -->
          <div class="col-md-4">
            <div class="form-group">
              <label for="nombre">Descripción del Producto</label>
              <input id="nombre" type="text" name="nombre" class="form-control" placeholder="Descripción del Producto" disabled>
            </div>
          </div>
          <!-- Cantidad -->
          <div class="col-md-2">
            <div class="form-group">
              <label for="cantidad">Cantidad</label>
              <input id="cantidad" type="number" name="cantidad" class="form-control" placeholder="Cantidad" onkeyup="calcularPrecioVenta(event)">
            </div>
          </div>
          <!-- Precio -->
          <div class="col-md-2">
            <div class="form-group">
              <label for="precio">Precio</label>
              <input id="precio" type="number" name="precio" class="form-control" placeholder="Precio Venta" disabled>
            </div>
          </div>
          <!-- Sub Total -->
          <div class="col-md-2">
            <div class="form-group">
              <label for="sub_total">Sub Total</label>
              <input id="sub_total" type="number" name="sub_total" class="form-control" placeholder="Sub Total" disabled>
            </div>
          </div>
        </div>

        <br>

        <!-- Tabla de Detalle -->
        <div class="card">
          <div class="card-datatable table-responsive">
            <table class="table table-striped table-bordered nowrap" id="tblCompras">
              <thead class="table-primary">
                <tr>
                  <th>ID</th>
                  <th>DESCRIPCIÓN</th>
                  <th>CANTIDAD</th>
                  <th>APLICAR</th>
                  <th>DESCUENTO</th>
                  <th>PRECIO</th>
                  <th>SUBTOTAL</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tblDetalleVenta">
                <!-- Detalles se insertan aquí -->
              </tbody>
            </table>
          </div>

          <!-- Total y Botón Generar Venta -->
          <div class="row mt-2">
            <div class="col-md-3 ms-auto">
              <div class="form-group">
                <label for="total" class="fw-bold">Total</label>
                <input id="total" type="text" name="total" class="form-control" disabled>
                <button class="btn btn-primary mt-2 w-100 d-flex align-items-center justify-content-center" type="button" onclick="procesar(0)">
                  <i class="fas fa-file-invoice me-2"></i> Generar Venta
                </button>
                <br>
              </div>
            </div>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>


            
            <!-- / Content -->
 <?php include "Views/Templates/footer.php"; ?>


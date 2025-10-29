<?php include "Views/Templates/header.php";?>
 
<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Listado de Opciones de Categorias Activas</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active "><a href="#"> Reporte de Categorias
                                                 <i class="fas fa-archive"></i>
                                            </a></li>

                                            
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header justify-content-between d-flex align-items-center">
                                        <h4 class="card-title">Categorias Activas en la Plataforma</h4>


                                        <button class="btn btn-primary" onclick="frmCategorias();">REGISTRAR NUEVA CATEGORIA <i class="fas fa-users"></i> </button><h5></h5>
                                    </div><!-- end card header -->

                                    
                                    <div class="card-body">
                                        <div id="#">
                                        
                                            <table class="table table-striped table-bordered nowrap" class="display" style="width: :100%;" id="tblCategorias">
                                                <thead class="btn-primary">
                                                    <tr>
                                                        <th><font size="3">ID</font></th>
                                                        <th><font size="3">NOMBRE</font></th>
                                                        <th><font size="3">ESTADO</font></th>
                                                        <th><font size="3">ACCIONES</font></th>
                                                        
                                                    </tr>
                                            
                                                </thead>
                                                <tbody>
                                                  
                                                </tbody>
 
                                            </table>

                                            <div id="nuevo_categoria" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white" id="title">REGISTRAR NUEVA CATEGORIA</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">

                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form method="POST" id="frmCategorias">
                                                        <div class="form-floating mb-3">
                                                            <input id="nombres" class="form-control" type="text" name="nombres" placeholder="Ingrese el nombre de la Categoria" >
                                                            <label for="caja">Ingrese la Nueva Categoria</label>
                                                             <input type="hidden" id="id" name="id">
                                                        </div>
                                                                                                            

                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal" data-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-primary" onclick="registrarCategorias(event);"><i class="fas fa-save"></i>  Guardar Categoria</button>
                                                        </form>
                                                    </div>

                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->


                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                               
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            </div>
            </div>
             
            

<?php include "Views/Templates/footer.php"; ?>


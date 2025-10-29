<?php include "Views/Templates/header.php";?>
 
<!-- BEGIN: Content-->

<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

 <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Hour chart  -->
              <div class="card bg-transparent shadow-none my-4 border-0">
                <div class="card-body row p-0 pb-3">
                  <div class="col-12 col-md-8 card-separator">
                    <h4>Bienvenido Nuevamente, <?php echo $_SESSION['nombre'] ?> 👋🏻</h4>
                    <div class="col-12 col-lg-7">
                        <p >|| Sistema de Trazabilidad - <strong> <?php echo $_SESSION['empresa'] ?> ✅ </strong> || <br></p>
                        <h6 ><strong>------------------------------------------------------------------</strong></h6>
                    </div>
                    <div class="d-flex justify-content-between flex-wrap gap-3 me-5">
                      <div class="d-flex align-items-center gap-3 me-4 me-sm-0">
                        <span class="bg-label-primary p-2 rounded">
                          <i class="ti ti-users ti-xl"></i>
                        </span>
                        <div class="content-right">
                          <h6 class="text-primary mb-0">USUARIOS</h6>
                          <h5 class="text-primary mb-0"><?php echo $data['usuarios']['total']. " Total"; ?></h5>
                        </div>
                      </div>
                      <div class="d-flex align-items-center gap-3">
                        <span class="bg-label-info p-2 rounded">
                          <i class="ti ti-checkup-list ti-xl"></i>
                        </span>
                        <div class="content-right">
                          <h6 class="text-info mb-0">CLIENTES</h6>
                          <h5 class="text-info mb-0"><?php echo $data['clientes']['total']. " Total"; ?></h5>
                        </div>
                      </div>
                      <div class="d-flex align-items-center gap-3">
                        <span class="bg-label-warning p-2 rounded">
                          <i class="ti ti-discount-check ti-xl"></i>
                        </span>
                        <div class="content-right">
                          <h6 class="text-warning mb-0">PRODUCTOS</h6>
                          <h5 class="text-warning mb-0"><?php echo $data['productos']['total']. " Total"; ?></h5>
                        </div>
                      </div>
                      <div class="d-flex align-items-center gap-3">
                        <span class="bg-label-success p-2 rounded">
                          <i class="ti ti-ticket ti-xl"></i>
                        </span>
                        <div class="content-right">
                          <h6 class="text-success mb-0">VENTAS</h6>
                          <h5 class="text-success mb-0"><?php    $total = $data['monto']['suma_total_ventas'] ?? 0;
                           echo number_format($total, 2) . " Soles"; ?></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4 ps-md-3 ps-lg-4 pt-3 pt-md-0">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <div>
                          <h5 class="mb-2">PRODUCTOS MAS COMPRADOS</h5>
                          <p class="mb-5">Reporte Diario</p>
                        </div>
                        <div class="time-spending-chart">
                          <h3 class="mb-2">6<span class="text-muted"> Productos</span> </h3>
                          <span class="badge bg-label-success">-- Productos con menos de 15 unidades</span>
                        </div>
                      </div>
                      <div id="leadsReportChart"></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Hour chart End  -->

              <!-- Topic and Instructors -->
              <div class="row mb-4 g-4">
                <div class="col-12 col-xl-8">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">ITEMS MAS ESCANEADOS HASTA LA FECHA.</h5>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="topic"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topic">
                          <a class="dropdown-item" href="javascript:void(0);">Highest Views</a>
                          <a class="dropdown-item" href="javascript:void(0);">See All</a>
                        </div>
                      </div>
                    </div>


                     <div class="card-body row g-3">
                      <div class="col-md-6">
                          <div id="horizontalBarChart"></div>
                      </div>
                      <div class="col-md-6">
                          <div class="row">
                              <?php foreach ($data['products'] as $index => $product): ?>
                                  <div class="col-6 mb-3">
                                      <div class="d-flex align-items-baseline">
                                      <span class="<?= $index === 0 ? 'text-primary' : 
                                                      ($index === 1 ? 'text-info' : 
                                                      ($index === 2 ? 'text-success' : 
                                                      ($index === 3 ? 'text-secondary' : 
                                                      ($index === 4 ? 'text-danger' : 
                                                      ($index === 5 ? 'text-warning' : 
                                                      ($index === 6 ? 'text-warning' : 'text-success')))))) ?> me-2">
                                              <i class="ti ti-circle-filled fs-6"></i>
                                          </span>
                                          <div>
                                              <p class="mb-2" style="font-size: 12px;"><?= htmlspecialchars($product['descripcion']) ?></p>
                                              <h5 style="font-size: 16px;"><?= htmlspecialchars($product['cantidad']) ?></h5>
                                          </div>
                                      </div>
                                  </div>
                              <?php endforeach; ?>
                          </div>
                      </div>
                  </div>




                  </div>
                </div>
                <div class="col-12 col-xl-4 col-md-6">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Encuesta de Satisfacción de atención</h5>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        <li class="d-flex mb-3 pb-1">
                          <div
                            class="chart-progress me-3"
                            data-color="primary"
                            data-series="97"
                            data-progress_variant="true"></div>
                          <div class="row w-100 align-items-center">
                            <div class="col-9">
                              <div class="me-2">
                                <h6 class="mb-2">Trámites mas rápidos.</h6>
                                <small>810 Atenciones</small>
                              </div>
                            </div>
                            <div class="col-3 text-end">
                              <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-3 pb-1">
                          <div
                            class="chart-progress me-3"
                            data-color="success"
                            data-series="89"
                            data-progress_variant="true"></div>
                          <div class="row w-100 align-items-center">
                            <div class="col-9">
                              <div class="me-2">
                                <h6 class="mb-2">Atención brindada al Cliente.</h6>
                                <small>32 Clientes</small>
                              </div>
                            </div>
                            <div class="col-3 text-end">
                              <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-3 pb-1">
                          <div
                            class="chart-progress me-3"
                            data-color="danger"
                            data-series="15"
                            data-progress_variant="true"></div>
                          <div class="row w-100 align-items-center">
                            <div class="col-9">
                              <div class="me-2">
                                <h6 class="mb-2">Experiencia de Proveedores</h6>
                                <small>182 Encuestas</small>
                              </div>
                            </div>
                            <div class="col-3 text-end">
                              <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex">
                          <div
                            class="chart-progress me-3"
                            data-color="info"
                            data-series="24"
                            data-progress_variant="true"></div>
                          <div class="row w-100 align-items-center">
                            <div class="col-9">
                              <div class="me-2">
                                <h6 class="mb-2">Experiencia a Nuestros Usuarios</h6>
                                <small>56 Encuestas</small>
                              </div>
                            </div>
                            <div class="col-3 text-end">
                              <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex">
                          <div
                            class="chart-progress me-3"
                            data-color="warning"
                            data-series="67"
                            data-progress_variant="true"></div>
                          <div class="row w-100 align-items-center">
                            <div class="col-9">
                              <div class="me-2">
                                <h6 class="mb-2">Registro de Productos</h6>
                                <small>16256 Encuestas</small>
                              </div>
                            </div>
                            <div class="col-3 text-end">
                              <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

          <!--      <div class="col-12 col-xl-4 col-md-6">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Usuarios con mas ingresos.</h5>
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="popularInstructors"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularInstructors">
                          <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                          <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                          <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-borderless border-top">
                        <thead class="border-bottom">
                          <tr>
                            <th>Nombres y Apellidos </th>
                            <th class="text-end">Ingresos</th>
                          </tr>
                        </thead>
                        <tbody>

                          
                              <?php foreach ($data['usuario'] as $users => $usuario): ?>
                                  <tr>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <div class="avatar me-3 avatar-sm">
                                          
                                           <img src="<?php echo base_url .'assets/img/avatars/'. $usuario['fotousuario']; ?>" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="d-flex flex-column">
                                          <h6 class="mb-0"><?php echo htmlspecialchars($usuario['nombre']); ?></h6>
                                          <small class="text-truncate text-muted"><?php echo htmlspecialchars($usuario['apellidos']); ?></small>
                                        </div>
                                      </div>
                                    </td>
                                    <td class="text-end">
                                      <div class="user-progress">
                                        <p class="mb-0 fw-medium"><?php echo htmlspecialchars($usuario['ingresos']); ?></p>
                                      </div>
                                    </td>
                                  </tr>
                          <?php endforeach; ?>
                        

                        
                        
                      
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>  -->

<!--                <div class="col-12 col-xl-4 col-md-6">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Top De Ventas por Marca</h5>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="topCourses"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topCourses">
                          <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                          <a class="dropdown-item" href="javascript:void(0);">Download</a>
                          <a class="dropdown-item" href="javascript:void(0);">View All</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-4 pb-1 align-items-center">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"
                              ><i class="ti ti-video ti-md"></i
                            ></span>
                          </div>
                          <div class="row w-100 align-items-center">
                            <div class="col-sm-8 col-lg-12 col-xxl-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                              <p class="mb-0 fw-medium">Productos de la Marca Gloria</p>
                            </div>
                            <div
                              class="col-sm-4 col-lg-12 col-xxl-4 d-flex justify-content-sm-end justify-content-md-start justify-content-xxl-end">
                              <div class="badge bg-label-secondary">1.2k Ventas</div>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1 align-items-center">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class="ti ti-code ti-md"></i></span>
                          </div>
                          <div class="row w-100 align-items-center">
                            <div class="col-sm-8 col-lg-12 col-xxl-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                              <p class="mb-0 fw-medium">Bebidas de la Marca Backus</p>
                            </div>
                            <div
                              class="col-sm-4 col-lg-12 col-xxl-4 d-flex justify-content-sm-end justify-content-md-start justify-content-xxl-end">
                              <div class="badge bg-label-secondary">834 Ventas</div>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1 align-items-center">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success"
                              ><i class="ti ti-camera ti-md"></i
                            ></span>
                          </div>
                          <div class="row w-100 align-items-center">
                            <div class="col-sm-8 col-lg-12 col-xxl-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                              <p class="mb-0 fw-medium">Productos de Tipo Menestras de la Marca el Norteño</p>
                            </div>
                            <div
                              class="col-sm-4 col-lg-12 col-xxl-4 d-flex justify-content-sm-end justify-content-md-start justify-content-xxl-end">
                              <div class="badge bg-label-secondary">3.7k Views</div>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1 align-items-center">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-warning"
                              ><i class="ti ti-brand-dribbble ti-md"></i
                            ></span>
                          </div>
                          <div class="row w-100 align-items-center">
                            <div class="col-sm-8 col-lg-12 col-xxl-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                              <p class="mb-0 fw-medium">Productos de la Marca Royal</p>
                            </div>
                            <div
                              class="col-sm-4 col-lg-12 col-xxl-4 d-flex justify-content-sm-end justify-content-md-start justify-content-xxl-end">
                              <div class="badge bg-label-secondary">2.5k Views</div>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex align-items-center">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-danger"
                              ><i class="ti ti-microphone-2 ti-md"></i
                            ></span>
                          </div>
                          <div class="row w-100 align-items-center">
                            <div class="col-sm-8 col-lg-12 col-xxl-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                              <p class="mb-0 fw-medium">productos de concervas de la Marca Atun.</p>
                            </div>
                            <div
                              class="col-sm-4 col-lg-12 col-xxl-4 d-flex justify-content-sm-end justify-content-md-start justify-content-xxl-end">
                              <div class="badge bg-label-secondary">948 Ventas</div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div> 

                <div class="col-12 col-xl-4 col-md-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                        <img
                          class="img-fluid"
                          src="<?php echo base_url; ?>/assets/img/illustrations/girl-with-laptop.png"
                          alt="Card girl image"
                          width="140" />
                      </div>
                      <h4 class="mb-2 pb-1">Reuniones de trabajo por asistir:</h4>
                      <p class="small">
                        Lanzamiento de nuevos productos en al ciudad de Puno.
                      </p>
                      <div class="row mb-3 g-3">
                        <div class="col-6">
                          <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-2">
                              <span class="avatar-initial rounded bg-label-primary"
                                ><i class="ti ti-calendar-event ti-md"></i
                              ></span>
                            </div>
                            <div>
                              <h6 class="mb-0 text-nowrap">17 Nov 2024</h6>
                              <small>Fecha</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-2">
                              <span class="avatar-initial rounded bg-label-primary"
                                ><i class="ti ti-clock ti-md"></i
                              ></span>
                            </div>
                            <div>
                              <h6 class="mb-0 text-nowrap">120 minutos</h6>
                              <small>Duración</small>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a href="javascript:void(0);" class="btn btn-primary w-100">Ingresar a la reunión</a>
                    </div>
                  </div>
                </div>-->

             
              <!--  Topic and Instructors  End-->

              <!-- Course datatable -->
              <div class="card mb-4">
                <div class="table-responsive mb-3">
                  <table class="table datatables-academy-course">
                    <thead class="border-top">
                      <tr>
                        <th></th>
                        <th></th>
                        <th height="w-20">Nombre del Usuario</th>
                      
                        <th>Tiempo</th>
                        <th class="w-20">Porcentaje de Ingresos</th>
                        <th class="w-30">Ingresos / Ventas / Anulados</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>

              <!-- Course datatable End -->
            </div>


<?php include "Views/Templates/footer.php"; ?>


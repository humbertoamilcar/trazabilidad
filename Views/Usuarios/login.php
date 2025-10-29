<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?php echo base_url; ?>assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Sistema | Trazabilidad</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url; ?>assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/css/pages/page-auth.css" />
     <link rel="stylesheet" href="<?php echo base_url; ?>assets/vendor/libs/sweetalert2/sweetalert2.css" />

    <!-- Helpers -->
    <script src="<?php echo base_url; ?>assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?php echo base_url; ?>assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo base_url; ?>assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
      <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="<?php echo base_url; ?>assets/img/illustrations/auth-login-illustration-light.png"
              alt="auth-login-cover"
              class="img-fluid my-5 auth-illustration"
              data-app-light-img="illustrations/auth-login-illustration-light.png"
              data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

            <img
              src="<?php echo base_url; ?>assets/img/illustrations/bg-shape-image-light.png"
              alt="auth-login-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" />
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
          <div class="w-px-400 mx-auto">
            <!-- Logo -->
            
            <!-- /Logo -->
            <h3 class="mb-1">SISTEMA DE TRAZABILIDAD 👋</h3>
            <p class="mb-4">Por Favor Ingrese su Usuario y Contraseña</p>

            <form id="frmLogin" class="form"  autocomplete="off" class="mb-3" >
              <div class="mb-3">
                <label for="email" class="form-label">Usuario</label>
                <input
                  type="text"
                  class="form-control"
                  id="correo"
                  name="correo"
                  placeholder="Ingrese su Usuario"
                  autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="auth-forgot-password-cover.html">
                    <small>Ingrese su Contraseña?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>
          <div class="alert alert-danger text-center fw-bold d-none" role="alert" id="alerta"></div>

              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Recordar mis datos </label>
                </div>
              </div>
               <button class="btn btn-primary d-grid w-100" type="submit" onclick="frmLogin(event);"><span class="fas fa-sign-in-alt"> ACCESAR A LA PLATAFORMA</span></button>
            </form>

            <p class="text-center">
              <span>Es Ud. Nuevo en Nuestra Plataforma?</span>
              <a href="auth-register-cover.html">
                <span>Crear su Usuario</span>
              </a>
            </p>

            <div class="divider my-4">
              <div class="divider-text">O</div>
            </div>

            <div class="d-flex justify-content-center">
              <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                <i class="tf-icons fa-brands fa-google fs-5"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                <i class="tf-icons fa-brands fa-twitter fs-5"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script>  const base_url = "<?= BASE_URL ?>"; </script>

    <script src="<?= BASE_URL ?>Assets/js/idle.js"></script>

    <script src="<?php echo base_url; ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo base_url; ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo base_url; ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo base_url; ?>assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="<?php echo base_url; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url; ?>assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?php echo base_url; ?>assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?php echo base_url; ?>assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="<?php echo base_url; ?>assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo base_url; ?>assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="<?php echo base_url; ?>assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="<?php echo base_url; ?>assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

    <!-- Main JS -->
    <script src="<?php echo base_url; ?>assets/js/main.js"></script>
    <script src="<?php echo base_url; ?>assets/js/login.js"></script>
    <!-- Page JS 
    <script src="<?php echo base_url; ?>assets/js/pages-auth.js"></script>-->
        <!-- Vendors JS -->
    <script src="<?php echo base_url; ?>assets/vendor/libs/sweetalert2/sweetalert2.js"></script>

      <!-- Page JS 
    <script src="<?php echo base_url; ?>assets/js/extended-ui-sweetalert2.js"></script>-->

<script>window.base_url = "<?= BASE_URL ?>";</script>
  </body>
</html>


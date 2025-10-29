let tblUsuarios, tblClientes, tblRoles, tblCategorias, tblProductos, tblMedidas,t_h_c, t_h_v, t_arqueo;
document.addEventListener("DOMContentLoaded",function() {
    $('#cliente').select2();
    
    tblUsuarios=$('#tblUsuarios').DataTable({
        language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
        }
        },

        ajax:{
            url:base_url+"Usuarios/listar",
            dataSrc:''
        },
        columns:[{
                'data':'id' },{
                'data':'usuario' },{
                'data':'nombre'},{
                'data':'apellidos' },{
                'data':'caja' },{
                'data':'estado' },{
                'data':'acciones' }]
    });
    //listar clientes

    tblClientes=$('#tblClientes').DataTable({
          language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
        }
        },

        ajax:{
            url:base_url+"Clientes/listar",
            dataSrc:''
        },
        columns:[{
                'data':'id'},{'data':'dni'},{'data':'nombres'},{'data':'apellidos'},{'data':'telefono'},{
                'data':'direccion'},{'data':'estado'},{'data':'acciones'}] 
    });
     //Roles

    tblRoles=$('#tblCaja').DataTable({
          language: {
        "decimal": "","emptyTable": "No hay información","info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas","infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "","thousands": ",","lengthMenu": "Mostrar _MENU_ Entradas","loadingRecords": "Cargando...",
        "processing": "Procesando...","search": "Buscar:","zeroRecords": "Sin resultados encontrados",
        "paginate": {"first": "Primero","last": "Ultimo","next": "Siguiente","previous": "Anterior"
        }},

        ajax:{
            url:base_url+"Roles/listar",
            dataSrc:''
        },
        columns:[{
                'data':'id'
            },{
                'data':'caja'
            },{                
                'data':'estado'
            },{
                'data':'acciones'    
            }]
    });

     //Categorias

    tblCategorias=$('#tblCategorias').DataTable({
          language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
        }
        },
        ajax:{
            url:base_url+"Categorias/listar",
            dataSrc:''
        },
        columns:[{
                'data':'id'
            },{
                'data':'nombres'
            },{                
                'data':'estado'
            },{
                'data':'acciones'    
            }]
    });

      //Medidas

    tblMedidas=$('#tblMedidas').DataTable({
          language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
        }
        },
        ajax:{
            url:base_url+"Medidas/listar",
            dataSrc:''
        },
        columns:[{
                'data':'id'
            },{
                'data':'nombres'
            },{
                'data':'nombrecorto'
            },{                
                'data':'estado'
            },{
                'data':'acciones'    
            }]
    });

      //productos
    if ($.fn.DataTable.isDataTable('#tblProductos')) {
      $('#tblProductos').DataTable().destroy();
    }

let tblProductos = $('#tblProductos').DataTable({
  responsive: true,
  autoWidth: false,
  processing: true,
  serverSide: false, // cámbialo a true si el backend pagina
  language: {
    decimal: "",
    emptyTable: "No hay información disponible",
    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
    infoEmpty: "Mostrando 0 a 0 de 0 registros",
    infoFiltered: "(filtrado de _MAX_ registros totales)",
    thousands: ",",
    lengthMenu: "Mostrar _MENU_ registros",
    loadingRecords: "Cargando...",
    processing: "Procesando...",
    search: "Buscar:",
    zeroRecords: "Sin resultados encontrados",
    paginate: {
      first: "Primero",
      last: "Último",
      next: "Siguiente",
      previous: "Anterior"
    }
  },
  ajax: {
    url: base_url + "Productos/listar",
    type: "GET",
    dataType: "json",
    dataSrc: function (json) {
      if (!Array.isArray(json)) {
        console.error("Respuesta inesperada del servidor:", json);
        return [];
      }
      return json;
    },
    error: function (xhr, error, thrown) {
      console.error("Error al cargar productos:", error, thrown, xhr.responseText);
    }
  },
  columns: [
    { data: "id" },
    { data: "imagen" },
    { data: "nombre" },
    { data: "descripcion" },

    { data: "sku" },
    { data: "razon_social" },
    {
      data: "estado",
      render: function (data) {
        return data == 1
          ? '<span class="badge rounded-pill bg-label-success">Producto Activo</span>'
          : '<span class="badge rounded-pill bg-label-danger">Producto Inactivo</span>';
      }
    },
    { 
      data: "acciones", 
      orderable: false, 
      searchable: false 
    }
  ]
});



        //listar Compras

    t_h_c=$('#t_historial_c').DataTable({
          language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
        }
        },
        ajax:{
            url:base_url+"Compras/listar_historial",
            dataSrc:''
        },
        columns:[{
                'data':'id'
            },{
                'data':'total'
            },{
                'data':'fecha'
            },{ 
                'data':'estado'
            },{                
                'data':'acciones'    
            }]
    });

    t_h_v=$('#t_historial_v').DataTable({
          language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
        }
        },
        ajax:{
            url:base_url+"Compras/listar_historial_venta",
            dataSrc:''
        },
        columns:[{
                'data':'id'
            },{
                'data':'nombres'
            },{
                'data':'total'
            },{
                'data':'fecha'
            },{
                'data':'estado'
            },{                
                'data':'acciones'    
            }]
    });



    t_arqueo=$('#t_arqueo').DataTable({
          language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
        }
        },
        ajax:{
            url:base_url+"Roles/listar_arqueo",
            dataSrc:''
        },
        columns:[{
                'data':'id'
            },{
                'data':'monto_inicial'
            },{
                'data':'monto_final'
            },{                
                'data':'fecha_apertura'
            },{                
                'data':'fecha_cierre'
            },{                
                'data':'total_ventas'
            },{                
                'data':'monto_total'
            },{
                'data':'estado'
            },{
                'data':'acciones'    
            }]
    });


})

function frmPassword(){
    document.getElementById("title").innerHTML="CAMBIAR PASSWORD";
    document.getElementById("frmCambiarPass").reset();
    $("#cambiarPass").modal("show");
    //document.getElementById("id").value="";
}

function frmCambiarPass(e){
    e.preventDefault();
    const actual=document.getElementById('clave_actual').value;
    const nueva=document.getElementById('clave_nueva').value;
    const confirmar=document.getElementById('confirmar_clave').value;
    if (actual=='' || nueva=='' || confirmar=='') {
        alertas("Todos los Campos son obligatoriosssss", "warning","ADVERTENCIA!!!!");

    }else{
        if (nueva!=confirmar) {
            alertas("LAs Contraseñas no coinciden", "warning","ADVERTENCIA!!!!");
        }else{
            const url = base_url + "Usuarios/cambiarPass";
            const frm = document.getElementById("frmCambiarPass");
            const http=new XMLHttpRequest();
            http.open("POST",url, true );
            http.send(new FormData(frm));
            http.onreadystatechange=function(){
                if (this.readyState==4 && this.status==200) {
                    const res = JSON.parse(this.responseText);
                    $("#cambiarPass").modal("hide");
                    alertas(res.msg,res.icono, res.titulo);
                    frm.reset();
            
               
            }
        }
        }
        
    }
}

function frmUsuario(){
    document.getElementById("title").innerHTML="REGISTRAR NUEVO USUARIO";
    document.getElementById("passwords").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value="";
}

function registrarUser(e){
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const apellidos = document.getElementById("apellidos");

    const caja = document.getElementById("caja");
    if (usuario.value=="" || nombre.value=="" || apellidos.value=="" || caja.value==""){
       alertas("Todos los Campos son obligatorios", "warning","ADVERTENCIA!!!!");

    }else{
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http=new XMLHttpRequest();
        http.open("POST",url, true );
        http.send(new FormData(frm));
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_usuario").modal("hide");
                alertas(res.msg,res.icono, res.titulo);
                tblUsuarios.ajax.reload();
               
            }
        }
    }
}

function btnEditarUser(id){
    document.getElementById("title").innerHTML="ACTUALIZAR USUARIO";
        const url = base_url + "Usuarios/editar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res=JSON.parse(this.responseText);
                document.getElementById("id").value=res.id;   
                document.getElementById("usuario").value=res.usuario;            
                document.getElementById("nombre").value=res.nombre;
                document.getElementById("apellidos").value=res.apellidos;
                document.getElementById("caja").value=res.id_caja;
                document.getElementById("passwords").classList.add("d-none");
                $("#nuevo_usuario").modal("show");
            }
        }
}

function btnEliminarUser(id){
    Swal.fire({
      title: 'ESTA SEGURO DE ELIMINAR?',
      text: "El usuario no se eliminara de forma permanente, solo se Inactivara!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si, Cambiar Estado!',
      customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-label-danger'
        },
        buttonsStyling: false
        })
    .then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Usuarios/eliminar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire(
                      {
                      icon: 'success',
                      title:'ACTUALIZACIÓN EXITOSA',
                      text: 'Usuario inabilitado con exito',
                      timer: 3000,
                      customClass:{
                      confirmButton: 'btn btn-primary',
                      confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                    }
                    )
                tblUsuarios.ajax.reload();
                }else{
                    Swal.fire(
                      'Mensaje!',
                      res,
                      'error'
                    )
                }
            }
        }
       
      }
    })
   
}

function btnReingresarUser(id){
    Swal.fire({
      title: 'ESTA SEGURO DE ACTIVAR USUARIO?',
      text: "El usuario se activara para futuros accesos al sistema!",
      icon: 'warning',
      showCancelButton: true,
        confirmButtonText: 'Si, Cambiar Estado!',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-label-danger'
        },
        buttonsStyling: false
    }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Usuarios/reingresar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire(
                      {
                      icon: 'success',
                      title:'REINGRESO EXITOSO',
                      text: 'Usuario reingresado con exito',
                      timer: 8000,
                      customClass:{
                      confirmButton: 'btn btn-primary',
                      confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                    }
                    )
                tblUsuarios.ajax.reload();
                }else{
                    Swal.fire(
                      'Mensaje!',
                      res,
                      'error'
                    )
                }
            }
        }
       
      }
    })
            
}

// FIN USUARIOS.
//INICIO DE CLIENTEs

function frmCliente(){
    document.getElementById("title").innerHTML="REGISTRAR NUEVO CLIENTE";
    //document.getElementById("btnAccion").innerHTML="Registrar";
    document.getElementById("frmCliente").reset();
    $("#nuevo_cliente").modal("show");
    document.getElementById("id").value="";
}
function registrarCli(e){
    e.preventDefault();
    const dni = document.getElementById("dni");
    const nombres = document.getElementById("nombres");
    const apellidos = document.getElementById("apellidos");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    
    if ( nombres.value=="" ){
        Swal.fire({
          icon: 'error',
          title: 'Alerta .....',
          text: 'Todos los campos son obligatorios',
          timer: 3000,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'          
        })

    }else{
        const url = base_url + "Clientes/registrar";
        const frm = document.getElementById("frmCliente");
        const http=new XMLHttpRequest();
        http.open("POST",url, true );
        http.send(new FormData(frm));
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
               const res = JSON.parse(this.responseText);
               if (res=="si"){
                    Swal.fire({
                      icon: 'success',
                      title: 'REGISTRO EXITOSO',
                      text: 'Se ha generado un nuevo registro',
                      timer: 4000,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'          
                    })
                    frm.reset();
                    $("#nuevo_cliente").modal("hide");
                    tblClientes.ajax.reload();

               }else if (res=="modificado") {
                    Swal.fire({
                      icon: 'success',
                      title: 'CLIENTE MODIFICADO CON EXITO',
                      text: 'Se ha modificado el registro',
                      timer: 4000,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'          
                    })
                     $("#nuevo_cliente").modal("hide");
                       tblClientes.ajax.reload();
               }else{
                    Swal.fire({
                      icon: 'error',
                      title: res,
                      text: 'NO SE PUDO REGISTRAR AL CLIENTE',
                      timer: 4000,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'          
                    })
               }
            }
        }
    }
}
function btnEditarCli(id){
    document.getElementById("title").innerHTML="ACTUALIZAR DATOS DEL CLIENTE";
        const url = base_url + "Clientes/editar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res=JSON.parse(this.responseText);
                document.getElementById("id").value=res.id;   
                document.getElementById("dni").value=res.dni;            
                document.getElementById("nombres").value=res.nombres;
                document.getElementById("apellidos").value=res.apellidos;
                document.getElementById("telefono").value=res.telefono;
                document.getElementById("direccion").value=res.direccion;
                $("#nuevo_cliente").modal("show");
            }
        }
}
function btnEliminarCli(id){
    Swal.fire({
      title: 'ESTA SEGURO DE ELIMINAR?',
      text: "El Cliente no se eliminara de forma permanente, solo se Inactivara!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Cambiar estado!',
      cancelButtonText:'No, Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Clientes/eliminar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire(
                      'Registro Deshabilitado!',
                      'Se ha Inabilitado el Registro del Cliente.',
                      'success'
                    )
                tblClientes.ajax.reload();
                }else{
                    Swal.fire(
                      'Mensaje!',
                      res,
                      'error'
                    )
                }
            }
        }
       
      }
    })
   
}
function btnReingresarCli(id){
    Swal.fire({
      title: 'ESTA SEGURO DE ACTIVAR CLIENTE?',
      text: "El cliente se activara para futuras ventas!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Cambiar estado!',
      cancelButtonText:'No, Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Clientes/reingresar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire(
                      'MENSAJE!',
                      'Cliente reingresado con Exito.',
                      'success'
                    )
                tblClientes.ajax.reload();
                }else{
                    Swal.fire(
                      'Mensaje!',
                      res,
                      'error'
                    )
                }
            }
        }
       
      }
    })
            
}
// fin de cliente

//INICIO DE Categorias
function frmCategorias(){
    document.getElementById("title").innerHTML="REGISTRAR NUEVA CATEGORIA";
    //document.getElementById("btnAccion").innerHTML="Registrar";
    document.getElementById("frmCategorias").reset();
    $("#nuevo_categoria").modal("show");
    document.getElementById("id").value="";
}
function registrarCategorias(e){
    e.preventDefault();
    
    const nombres = document.getElementById("nombres");
        
    if (nombres.value==""){
        Swal.fire({
          icon: 'error',
          title: 'Alerta .....',
          text: 'Todos los campos son obligatorios',
          timer: 3000,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'          
        })

    }else{
        const url = base_url + "Categorias/registrar";
        const frm = document.getElementById("frmCategorias");
        const http=new XMLHttpRequest();
        http.open("POST",url, true );
        http.send(new FormData(frm));
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
               const res = JSON.parse(this.responseText);
               if (res=="si"){
                    Swal.fire({
                      icon: 'success',
                      title: 'REGISTRO EXITOSO',
                      text: 'Se ha generado un nuevo registro',
                      timer: 4000,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'          
                    })
                    frm.reset();
                    $("#nuevo_categoria").modal("hide");
                    tblCategorias.ajax.reload();

               }else if (res=="modificado") {
                    Swal.fire({
                      icon: 'success',
                      title: 'CLIENTE MODIFICADO CON EXITO',
                      text: 'Se ha modificado el registro',
                      timer: 4000,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'          
                    })
                     $("#nuevo_categoria").modal("hide");
                       tblCategorias.ajax.reload();
               }else{
                    Swal.fire({
                      icon: 'error',
                      title: res,
                      text: 'NO SE PUDO REGISTRAR AL CLIENTE',
                      timer: 4000,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'          
                    })
               }
            }
        }
    }
}
function btnEditarCat(id){
    document.getElementById("title").innerHTML="ACTUALIZAR DATOS DE LA CATEGORIA";
        const url = base_url + "Categorias/editar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res=JSON.parse(this.responseText);
                document.getElementById("id").value=res.id;   
                document.getElementById("nombres").value=res.nombres;            
                $("#nuevo_categoria").modal("show");
            }
        }
}
function btnEliminarCat(id){
    Swal.fire({
      title: 'ESTA SEGURO DE ELIMINAR?',
      text: "La Categoria no se eliminara de forma permanente, solo se Inactivara!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Cambiar estado!',
      cancelButtonText:'No, Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Categorias/eliminar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire(
                      'Registro Deshabilitado!',
                      'Se ha Inabilitado el Registro del Cliente.',
                      'success'
                    )
                tblCategorias.ajax.reload();
                }else{
                    Swal.fire(
                      'Mensaje!',
                      res,
                      'error'
                    )
                }
            }
        }
       
      }
    })
   
}
function btnReingresarCat(id){
    Swal.fire({
      title: 'ESTA SEGURO DE ACTIVAR CATEGORIA?',
      text: "LA categoria se activara para futuras ventas!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Cambiar estado!',
      cancelButtonText:'No, Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Categorias/reingresar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire(
                      'MENSAJE!',
                      'Categoria reingresada con Exito.',
                      'success'
                    )
                tblCategorias.ajax.reload();
                }else{
                    Swal.fire(
                      'Mensaje!',
                      res,
                      'error'
                    )
                }
            }
        }
       
      }
    })
            
}
// fin de Categorias

//INICIO DE PRODUCTOS
function frmProducto(){
    document.getElementById("title").innerHTML="REGISTRAR NUEVO PRODUCTO";
    document.getElementById("frmProducto").reset();
    $("#nuevo_producto").modal("show");
    document.getElementById("id").value="";
    deleteImg();
}


function registrarPro(e){
  e.preventDefault();

  const frm = document.getElementById("frmProducto");
  const codigo = document.getElementById("codigo");
  const nombre = document.getElementById("nombre");
  const precio_compra = document.getElementById("precio_compra");
  const precio_venta = document.getElementById("precio_venta");
  const medida = document.getElementById("medida");
  const categoria = document.getElementById("categoria");

  // Validación
  if (
    codigo.value.trim()==="" ||
    nombre.value.trim()==="" ||
    precio_compra.value.trim()==="" ||
    precio_venta.value.trim()==="" ||   // <- corregido
    medida.value.trim()==="" ||
    categoria.value.trim()===""
  ){
    Swal.fire({
      icon: 'error',
      title: 'ALERTA!',
      text: 'Todos los campos son obligatorios',
      timer: 6000,
      timerProgressBar: true,
      confirmButtonText: 'Aceptar',
      customClass:{ confirmButton: 'btn btn-primary' },
      buttonsStyling:false
    });
    return;
  }

  // (Opcional) Validar números
  if (isNaN(precio_compra.value) || isNaN(precio_venta.value)) {
    Swal.fire({
      icon:'error',
      title:'Precios inválidos',
      text:'Ingrese valores numéricos en precios',
      confirmButtonText:'Aceptar',
      customClass:{ confirmButton:'btn btn-primary' },
      buttonsStyling:false
    });
    return;
  }

  // Evitar doble envío
  const btn = e.currentTarget;
  if (btn && btn.disabled) return;
  if (btn) {
    btn.disabled = true;
    btn.dataset._old = btn.innerHTML;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Guardando...';
  }

  const http = new XMLHttpRequest();
  http.open("POST", base_url + "Productos/registrar", true);
  http.onreadystatechange = function(){
    if (this.readyState === 4) {
      // restaurar botón
      if (btn) {
        btn.disabled = false;
        if (btn.dataset._old) {
          btn.innerHTML = btn.dataset._old;
          delete btn.dataset._old;
        }
      }

      if (this.status !== 200) {
        Swal.fire({
          icon:'error',
          title:'Error de red',
          text:'No se pudo procesar la solicitud',
          confirmButtonText:'Aceptar',
          customClass:{ confirmButton:'btn btn-primary' },
          buttonsStyling:false
        });
        return;
      }

      let res;
      try { res = JSON.parse(this.responseText); } catch { res = this.responseText; }

      const cerrarModalYLuegoAlerta = (opciones) => {
        // cierra modal primero para evitar warning de accesibilidad (focus)
        $('#nuevo_producto').one('hidden.bs.modal', () => Swal.fire(opciones));
        $('#nuevo_producto').modal('hide');
      };

      if (res === "si") {
        frm.reset();
        if (typeof deleteImg === 'function') deleteImg();
        if (typeof tblProductos !== 'undefined' && tblProductos.ajax) {
          tblProductos.ajax.reload();
        }
        cerrarModalYLuegoAlerta({
          icon:'success',
          title:'REGISTRO EXITOSO',
          text:'Se ha generado un nuevo registro',
          timer:5000,
          timerProgressBar:true,
          confirmButtonText:'Aceptar',
          customClass:{ confirmButton:'btn btn-primary' },
          buttonsStyling:false
        });

      } else if (res === "modificado") {
        if (typeof tblProductos !== 'undefined' && tblProductos.ajax) {
          tblProductos.ajax.reload();
        }
        cerrarModalYLuegoAlerta({
          icon:'success',
          title:'REGISTRO MODIFICADO EXITOSAMENTE',
          text:'Se actualizó correctamente',
          timer:5000,
          timerProgressBar:true,
          confirmButtonText:'Aceptar',
          customClass:{ confirmButton:'btn btn-primary' },
          buttonsStyling:false
        });

      } else {
        Swal.fire({
          icon:'error',
          title: (typeof res === 'string' && res) ? res : 'Error',
          text:'NO SE PUDO REGISTRAR EL PRODUCTO',
          confirmButtonText:'Aceptar',
          customClass:{ confirmButton:'btn btn-primary' },
          buttonsStyling:false
        });
      }
    }
  };
  http.send(new FormData(frm));
}



function btnEditarPro(id){
    document.getElementById("title").innerHTML="ACTUALIZAR DATOS DEL PRODUCTO";
        const url = base_url + "Productos/editar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res=JSON.parse(this.responseText);
                document.getElementById("id").value=res.id;   
                document.getElementById("codigo").value=res.codigo;            
                document.getElementById("nombre").value=res.descripcion;
                document.getElementById("precio_compra").value=res.precio_compra;
                document.getElementById("precio_venta").value=res.precio_venta;
                document.getElementById("medida").value=res.id_medida;
                document.getElementById("categoria").value=res.id_categoria;
                document.getElementById("img-preview").src=base_url+
                'Assets/img/products/'+ res.foto;
                document.getElementById("icon-cerrar").innerHTML=
                `<button class="btn btn-danger" onclick="deleteImg()">
                <i class="fas fa-times"></i></button>`;
                document.getElementById("icon-image").classList.add("d-none");
                document.getElementById("foto_actual").value=res.foto;
                $("#nuevo_producto").modal("show");
            }
        }
}
function btnEliminarPro(id){
  Swal.fire({
    title: 'ESTA SEGURO DE ELIMINAR?',
    text: 'El Cliente, solo se Inactivara!',
    icon: 'warning',
    showCancelButton: true,      // ← solo cancelar
    showDenyButton: false,       // ← forzado para ocultar el tercero
    confirmButtonText: 'Si, Cambiar estado!',
    cancelButtonText: 'No, Cancelar',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    // (opcional) evita cierres por click fuera o ESC
    allowOutsideClick: false,
    allowEscapeKey: false
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + 'Productos/eliminar/' + id;
      const http = new XMLHttpRequest();
      http.open('GET', url, true);
      http.send();
      http.onreadystatechange = function(){
        if (this.readyState === 4 && this.status === 200) {
          const res = JSON.parse(this.responseText);
          if (res === 'ok') {
            Swal.fire('Registro Deshabilitado!', 'Se ha Inhabilitado el Registro del Cliente.', 'success');
            if (typeof tblProductos !== 'undefined' && tblProductos.ajax) tblProductos.ajax.reload();
          } else {
            Swal.fire('Mensaje!', res, 'error');
          }
        }
      };
    }
  });
}

function btnReingresarPro(id){
    Swal.fire({
      title: 'ESTA SEGURO DE ACTIVAR CLIENTE?',
      text: "El cliente se activara para futuras ventas!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Cambiar estado!',
      cancelButtonText:'No, Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Productos/reingresar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire(
                      'MENSAJE!',
                      'Cliente reingresado con Exito.',
                      'success'
                    )
                tblProductos.ajax.reload();
                }else{
                    Swal.fire(
                      'Mensaje!',
                      res,
                      'error'
                    )
                }
            }
        }
    }
    })
}

function preview(e){
    const url = e.target.files[0];
    const urlTmp=URL.createObjectURL(url);
    document.getElementById("img-preview").src=urlTmp; 
    document.getElementById("icon-image").classList.add("d-none");
    document.getElementById("icon-cerrar").innerHTML=
    `<button class="btn btn-danger" onclick="deleteImg()">
    <i class="fas fa-times"></i></button>
    ${url['name']}`;
}

function deleteImg(){
    document.getElementById("img-preview").src=""; 
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("icon-cerrar").innerHTML='';
    document.getElementById("imagen").value='';
    document.getElementById("foto_actual").value='';
}

function buscarCodigo(e){
   e.preventDefault();
   if (e.which==13) {
    const cod=document.getElementById("codigo").value;
    const url = base_url + "Compras/buscarCodigo/"+ cod;
    const http=new XMLHttpRequest();
    http.open("GET",url, true );
    http.send();
    http.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200) {
            const res=JSON.parse(this.responseText);
           if (res) {
            document.getElementById("nombre").value=res.descripcion;
            document.getElementById("precio").value=res.precio_compra;
            document.getElementById("id").value=res.id;
            document.getElementById("cantidad").focus();
           }else{
             Swal.fire({
                        icon: 'error',
                        title: 'NO SE HA ENCONTRADO EL PRODUCTO',
                        text: 'Intente de Nuevo',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
                    document.getElementById("codigo").value='';
                    document.getElementById("codigo").focus();
           }
        }
    }
  }
}

function buscarCodigoVenta(e){
   e.preventDefault();
   if (e.which==13) {
    const cod=document.getElementById("codigo").value;
    const url = base_url + "Compras/buscarCodigo/"+ cod;
    const http=new XMLHttpRequest();
    http.open("GET",url, true );
    http.send();
    http.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200) {
            const res=JSON.parse(this.responseText);
           if (res) {
            document.getElementById("nombre").value=res.descripcion;
            document.getElementById("precio").value=res.precio_venta;
            document.getElementById("id").value=res.id;
            document.getElementById("cantidad").focus();
           }else{
             Swal.fire({
                        icon: 'error',
                        title: 'NO SE HA ENCONTRADO EL PRODUCTO',
                        text: 'Intente de Nuevo',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
                    document.getElementById("codigo").value='';
                    document.getElementById("codigo").focus();
           }
        }
    }
  }
}

function buscarCodigoCliente(e){
   e.preventDefault();
   if (e.which==13) {
    const codigo=document.getElementById("dni").value;
    const url = base_url + "Compras/buscarCliente/"+ codigo;
    const http=new XMLHttpRequest();
    http.open("GET",url, true );
    http.send();
    http.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200) {
            const res=JSON.parse(this.responseText);
           if (res) {
            document.getElementById("nombres").value=res.nombres;
            document.getElementById("apellidos").value=res.apellidos;
            document.getElementById("id_cliente").value=res.id;
            document.getElementById("codigo").focus();
           }else{
             Swal.fire({
                        icon: 'error',
                        title: 'NO SE HA ENCONTRADO AL CLIENTE',
                        text: 'Intente de Nuevo',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
                    document.getElementById("dni").value='';
                    document.getElementById("dni").focus();
           }
        }
    }
  }
}

function calcularPrecio(e){
    e.preventDefault();
    const cant=document.getElementById("cantidad").value;
    const precio=document.getElementById("precio").value;
    document.getElementById("sub_total").value=precio * cant;
    if (e.which==13) {
        if (cant>0) {
            const url=base_url+"Compras/ingresar";
            const frm=document.getElementById("frmCompra")
            const http=new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange=function(){
                if (this.readyState==4 && this.status==200) {
                    const res=JSON.parse(this.responseText);
                    if (res=='ok') {
                        Swal.fire({
                            icon: 'success',
                            title: 'PRODUCTO INGRESADO',
                            timer: 1000,
                            customClass:{
                            confirmButton: 'btn btn-primary',
                            confirmButtonText: 'Aceptar'            
                            },
                            buttonsStyling:false          
                            })
                        frm.reset();
                        cargarDetalle();
                    }else if (res=='modificado') {
                        Swal.fire({
                            icon: 'success',
                            title: 'PRODUCTO ACTUALIZADO',
                            timer: 1000,
                            customClass:{
                            confirmButton: 'btn btn-primary',
                            confirmButtonText: 'Aceptar'            
                            },
                            buttonsStyling:false          
                            })

                        cargarDetalle();
                        frm.reset();
                    }
                }
            }
        }
    }
}

if (document.getElementById('tblDetalle')) {
cargarDetalle();
}

if (document.getElementById('tblDetalleVenta')) {
cargarDetalleVenta();
}

function calcularPrecioVenta(e){
    e.preventDefault();
    const cant=document.getElementById("cantidad").value;
    const precio=document.getElementById("precio").value;
    document.getElementById("sub_total").value=precio * cant;
    if (e.which==13 || e.which==9) {
        if (cant>0) {
            const url=base_url+"Compras/ingresarVenta";
            const frm=document.getElementById("frmVenta")
            const http=new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange=function(){
                if (this.readyState==4 && this.status==200) {
                    const res=JSON.parse(this.responseText);
                    if (res=='ok') {
                        Swal.fire({
                            icon: 'success',
                            title: 'PRODUCTO INGRESADO',
                            timer: 1000,
                            customClass:{
                            confirmButton: 'btn btn-primary',
                            confirmButtonText: 'Aceptar'            
                            },
                            buttonsStyling:false          
                            })
                        frm.reset();
                       cargarDetalleVenta();
                    }else if (res=='modificado') {
                        Swal.fire({
                            icon: 'success',
                            title: 'PRODUCTO ACTUALIZADO',
                            timer: 1000,
                            customClass:{
                            confirmButton: 'btn btn-primary',
                            confirmButtonText: 'Aceptar'            
                            },
                            buttonsStyling:false          
                            })

                        cargarDetalleVenta();
                        frm.reset();
                    }
                }
            }
        }
    }
}


function cargarDetalle(){
    const url = base_url + "Compras/listar/detalle";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200) {
            const res=JSON.parse(this.responseText);
            let html='';
            res.detalle.forEach(row=>{
                html += `<tr>
                <th>${row['id']}</th>
                <th>${row['descripcion']}</th>
                <th>${row['cantidad']}</th>
                <th>${row['precio']}</th>
                <th>${row['sub_total']}</th>
                <th><button class="btn btn-danger" type= "button" 
                onclick="deleteDetalle(${row['id']},1)">
                <i class="fa fa-trash"></i></button></th>
                </tr>`;
                    });
                    document.getElementById('tblDetalle')
                    .innerHTML=html;
                    document.getElementById('total')
                    .value=res.total_pagar.total;
                }
        }
    }

function cargarDetalleVenta(){
    const url = base_url + "Compras/listar/detalle_temp";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200) {
            const res=JSON.parse(this.responseText);
            let html='';
            res.detalle.forEach(row=>{
                html += `<tr>
                <th>${row['id']}</th>
                <th>${row['descripcion']}</th>
                <th>${row['cantidad']}</th>
                <th><input type="text" class="form-control" placeholder="Descuento" onkeyup="calcularDescuento(event,${row['id']})"/></th>
                <th>${row['descuento']}</th>
                <th>${row['precio']}</th>
                <th>${row['sub_total']}</th>
                <th><button class="btn btn-danger" type= "button" 
                onclick="deleteDetalle(${row['id']}, 2)">
                <i class="fa fa-trash"></i></button></th>
                </tr>`;
                    });
                    document.getElementById('tblDetalleVenta').innerHTML=html;
                    document.getElementById('total').value=res.total_pagar.total;
                }
        }
    }
function calcularDescuento(e,id){
    e.preventDefault();
    if (e.target.value=='') {
        alertas("Ingrese el Descuento", "warning","ADVERTENCIA!!!!");
    }else{
        if (e.which==13) {
            const url=base_url+"Compras/calcularDescuento/" + id + "/" + e.target.value;
            const http=new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange=function(){
                if (this.readyState==4 && this.status==200) {
                    const res=JSON.parse(this.responseText);
                    alertas(res.msg,res.icono,"Mensaje");
                    cargarDetalleVenta();
                }
            }
        }
    }
}
function deleteDetalle(id, accion){
    let url;
    if (accion == 1) {
         url=base_url + "Compras/delete/"+id ;
    }else{
         url=base_url + "Compras/deleteVenta/"+id ;
    }
   
   const http=new XMLHttpRequest();
   http.open("GET",url, true);
   http.send();
   http.onreadystatechange=function(){
    if (this.readyState==4 && this.status==200) {
        const res=JSON.parse(this.responseText);
        if (res=='ok') {
            Swal.fire({
                icon: 'success',
                title: 'EL REGISTRO SE HA ELIMINADO',
                text: 'Exitosamente',
                timer: 3000,
                customClass:{
                confirmButton: 'btn btn-primary',
                confirmButtonText: 'Aceptar'            
                },
                buttonsStyling:false          
                })
                if (accion == 1) {
                    cargarDetalle();
                }else{
                    cargarDetalleVenta();
                }
        }else{
              Swal.fire({
                icon: 'error',
                title: 'se ha producido un error',
                text: 'No se pudo eliminar el Producto',
                timer: 3000,
                customClass:{
                confirmButton: 'btn btn-danger',
                confirmButtonText: 'Aceptar'            
                },
                buttonsStyling:false          
                })
            }
        }
    }
}

function procesar(accion) {
 
    Swal.fire({
        title: 'ESTA SEGURO DE REALIZAR LA ACCIÓN ?',
        text: "La compra se realizará con Exito",
        icon: 'warning',
        cancelButtonText: 'No, Cancelar la compra!',
        confirmButtonText: 'Si, Generar la compra!',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-danger me-3'
        },
        buttonsStyling: false
    }).then((result) => {
      if (result.isConfirmed) {
           let url;
           if (accion==1) {
                url = base_url + "Compras/registrarCompra";
            }else{
                const id_cliente=document.getElementById('cliente').value;
                url = base_url + "Compras/registrarVenta/"+id_cliente;
            }

        
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res.msg == "ok") {
                      Swal.fire({
                        icon: 'success',
                        title: 'COMPRA REALIZADA CON EXITO',
                        text: 'Su compra se ha realizado Exitosamente',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
                      let ruta;
                      if (accion==1) {
                        ruta=base_url+'Compras/generarPdf/'+res.id_compra;
                      }else{
                        ruta=base_url+'Compras/generarPdfVenta/'+res.id_venta;
                      }
                      
                      window.open(ruta);

                      setTimeout(()=>{
                        window.location.reload();
                      },300);
                
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'NO SE PUDO REALIZAR LA COMPRA',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })

                }
            }
        }
    }
    })
    
}


function modificarEmpresa(){
    const frm = document.getElementById('frmEmpresa'); 
    const url = base_url + "Administracion/modificar";
    const http=new XMLHttpRequest();
    http.open("POST",url, true );
    http.send(new FormData(frm));
    http.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200) {
           const res = JSON.parse(this.responseText);
           if (res=='ok') {
            alert('modificado');
           }
       }
   }
}

function alertas(mensaje,icono, titulo){
     Swal.fire({
        icon: icono,
        text: mensaje,
        title: titulo,
        timer: 8000,
        customClass:{
        confirmButton: 'btn btn-primary',
        confirmButtonText: 'Aceptar'            
        },
        buttonsStyling:false          
    })
}

function btnAnularC(id) {
     Swal.fire({
        title: 'ESTA SEGURO DE ANULAR LAs COMPRA...?',
        text: "La compra se eliminara, pero el registro seguira en la Base de Datos..",
        icon: 'warning',
        cancelButtonText: 'No, Anular la Compra!',
        confirmButtonText: 'Si, Anular la compra!',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-danger me-3'
        },
        buttonsStyling: false
    }).then((result) => {
      if (result.isConfirmed) {
            const url = base_url + "Compras/anularCompra/"+id;
            const http=new XMLHttpRequest();
            http.open("GET",url, true );
            http.send();
            http.onreadystatechange=function(){
                if (this.readyState==4 && this.status==200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg,res.icono,"ADVERTENCIA!!!!!");
                    t_h_c.ajax.reload();
            }
        }
    }
    })
}


function btnAnularV(id) {
     Swal.fire({
        title: 'ESTAS SEGURO DE ELIMINAR LA VENTA ...?',
        text: "Recuerde el registro de venta se anulará, pero el historial de venta quedará registrado ????",
        icon: 'warning',
        cancelButtonText: 'No, Eliminar la Venta!',
        confirmButtonText: 'Si, Eliminar la Venta!',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-danger me-3'
        },
        buttonsStyling: false
    }).then((result) => {
      if (result.isConfirmed) {
            const url = base_url + "Compras/anularVenta/"+id;
            const http=new XMLHttpRequest();
            http.open("GET",url, true );
            http.send();
            http.onreadystatechange=function(){
                if (this.readyState==4 && this.status==200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg,res.icono,"ADVERTENCIA!!!!!");
                    t_h_v.ajax.reload();
            }
        }
    }
    })
}


function arqueoCaja(){
    document.getElementById("ocultar_campos").classList.add('d-none');
    document.getElementById('monto_inicial').value='';
    document.getElementById("btnAccion").textContent="Aperturar Caja";
    $('#abrir_caja').modal('show');
} 

function abrirArqueo(e){
    e.preventDefault();
    const monto_inicial=document.getElementById('monto_inicial').value;
    if (monto_inicial=='') {
        alertas("Ingrese el Monto Inicial", "warning","ADVERTENCIA!!!!");
    }else{
        const frm=document.getElementById('frmAbrirCaja');
        const url = base_url + "Roles/abrirArqueo";
            const http=new XMLHttpRequest();
            http.open("POST",url, true );
            http.send(new FormData(frm));
            http.onreadystatechange=function(){
                if (this.readyState==4 && this.status==200) {
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono, 'ADVERTENCIA....');
                    $('#abrir_caja').modal('hide')  ;
                }
            }
    }
}

function cerrarCaja(){
      
        const url = base_url + "Roles/getVentas";
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
               const res = JSON.parse(this.responseText);
                    document.getElementById("monto_final").value = res.monto_total[0].total;
                    document.getElementById("total_ventas").value = res.total_ventas[0].total;
                    document.getElementById("monto_inicial").value = res.inicial[0].monto_inicial;
                    document.getElementById("monto_general").value = parseFloat(res.monto_total[0].total) + parseFloat(res.inicial[0].monto_inicial);
                    document.getElementById("id").value = res.inicial.id;
                    document.getElementById("ocultar_campos").classList.remove("d-none");
                    document.getElementById("btnAccion").textContent="Cerrar Caja";
               $('#abrir_caja').modal('show')  ;
            }
        }
}

// FIN PRODUCTOS

  

// Inicio de la Caja o Roles

function frmCaja(){
    document.getElementById("title").innerHTML="REGISTRAR NUEVO ROL";
    //document.getElementById("btnAccion").innerHTML="Registrar";
    document.getElementById("frmCaja").reset();
    $("#nuevo_caja").modal("show");
    document.getElementById("id").value="";
}
function registrarCaja(e){
    e.preventDefault();
    const caja = document.getElementById("caja");
    
    if (caja.value==""){
        Swal.fire({
            icon: 'error',
            title: 'Alerta .....',
            text: 'El campo de ingreso del nuevo rol, es obligatorio',
            timer: 8000,
            customClass:{
            confirmButton: 'btn btn-primary',
            confirmButtonText: 'Aceptar'            
            },
            buttonsStyling:false          
            })

    }else{
        const url = base_url + "Roles/registrar";
        const frm = document.getElementById("frmCaja");
        const http=new XMLHttpRequest();
        http.open("POST",url, true );
        http.send(new FormData(frm));
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
               const res = JSON.parse(this.responseText);
               if (res=="si"){
                    Swal.fire({
                        icon: 'success',
                        title: 'REGISTRO EXITOSO',
                        text: 'Se ha generado un nuevo registro',
                        timer: 4000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
                    frm.reset();
                    $("#nuevo_caja").modal("hide");
                    tblRoles.ajax.reload();

               }else if (res=="modificado") {
                    Swal.fire({
                        icon: 'success',
                        title: 'ROL MODIFICADO CON EXITO',
                        text: 'Se ha modificado el registro',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
                     $("#nuevo_caja").modal("hide");
                       tblRoles.ajax.reload();
               }else{
                    Swal.fire({
                        icon: 'error',
                        title: res,
                        text: 'NO SE PUDO REGISTRAR AL CLIENTE',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
               }
            }
        }
    }
}
function btnEditarCaja(id){
    document.getElementById("title").innerHTML="ACTUALIZAR LOS DATOS DEL ROLES";
        const url = base_url + "Roles/editar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res=JSON.parse(this.responseText);
                document.getElementById("caja").value=res.caja;
                $("#nuevo_caja").modal("show");
            }
        }
}
function btnEliminarCaja(id){
    Swal.fire({
        title: 'ESTA SEGURO DE ELIMINAR EL ROL?',
        text: "El Rol no se eliminara de forma permanente, solo se Inactivara!",
        icon: 'warning',
        cancelButtonText: 'No, Cancelar!',
        confirmButtonText: 'Si, Cambiar Estado!',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-danger me-3'
        },
        buttonsStyling: false
      }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Roles/eliminar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire({
                        icon: 'success',
                        title: res,
                        text: 'SE HA INABILITADO CORRECTAMENTE EL ROL',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        }
                    )
                tblRoles.ajax.reload();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: res,
                        text: 'NO SE HA PODIDO DESHABILITAR CORRECTAMENTE EL ROL',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
                }
            }
        }
       
      }
    })
   
}
function btnReingresarCaja(id){
Swal.fire({
        title: 'ESTA SEGURO DE ACTIVAR EL ROL DE USUARIO?',
        text: "El cliente se activara para futuras ventas!",
        icon: 'warning',
        confirmButtonText: 'Si, Cambiar Estado!',
        cancelButtonText: 'No, Cancelar!',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-danger me-3'
        },
        buttonsStyling: false
      }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Roles/reingresar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire({
                        icon: 'success',
                        title: res,
                        text: 'SE HA HABILITADO CORRECTAMENTE EL ROL',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
                tblRoles.ajax.reload();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: res,
                        text: 'NO SE HA PODIDO DESHABILITAR CORRECTAMENTE EL ROL',
                        timer: 8000,
                        customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
                   
                }
            }
        }
       
      }
    })
            
}
// Fin de la Caja o Roles

//INICIO DE UNIDADES DE MEDIDA
function frmMedidas(){
    document.getElementById("title").innerHTML="REGISTRAR NUEVA UNIDAD DE MEDIDA";
    //document.getElementById("btnAccion").innerHTML="Registrar";
    document.getElementById("frmMedidas").reset();
    $("#nuevo_medida").modal("show");
    document.getElementById("id").value="";
}
function registrarMedidas(e){
    e.preventDefault();
    
    const nombres = document.getElementById("nombres");
    const nombrecorto = document.getElementById("nombrecorto");
        
    if (nombres.value=="" || nombrecorto.value==""){
        Swal.fire({
          icon: 'error',
          title: 'Alerta .....',
          text: 'Todos los campos son obligatorios',
          timer: 6000,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar'          
        })

    }else{
        const url = base_url + "Medidas/registrar";
        const frm = document.getElementById("frmMedidas");
        const http=new XMLHttpRequest();
        http.open("POST",url, true );
        http.send(new FormData(frm));
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
               const res = JSON.parse(this.responseText);
               if (res=="si"){
                    Swal.fire({
                      icon: 'success',
                      title: 'REGISTRO EXITOSO',
                      text: 'Se ha generado un nuevo registro',
                      timer: 6000,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'          
                    })
                    frm.reset();
                    $("#nuevo_medida").modal("hide");
                    tblMedidas.ajax.reload();

               }else if (res=="modificado") {
                    Swal.fire({
                      icon: 'success',
                      title: 'UNIDAD DE MEDIDA MODIFICADO CON EXITO',
                      text: 'Se ha modificado el registro',
                      timer: 4000,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'          
                    })
                     $("#nuevo_medida").modal("hide");
                       tblMedidas.ajax.reload();
               }else{
                    Swal.fire({
                      icon: 'error',
                      title: res,
                      text: 'NO SE PUDO REGISTRAR AL CLIENTE',
                      timer: 4000,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'          
                    })
               }
            }
        }
    }
}
function btnEditarMed(id){
    document.getElementById("title").innerHTML="ACTUALIZAR DATOS DE LA CATEGORIA";
        const url = base_url + "Medidas/editar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res=JSON.parse(this.responseText);
                document.getElementById("id").value=res.id;   
                document.getElementById("nombres").value=res.nombres;            
                document.getElementById("nombrecorto").value=res.nombrecorto;            
                $("#nuevo_medida").modal("show");
            }
        }
}
function btnEliminarMed(id){
    Swal.fire({
        title: 'ESTA SEGURO DE ELIMINAR?',
        text: "La Unidad de Medida no se eliminara de forma permanente, solo se Inactivara!",
        icon: 'warning',
        confirmButtonText: 'Si, Cambiar Estado!',
        cancelButtonText: 'No, Cancelar!',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-danger me-3'
        },
        buttonsStyling: false
      }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Medidas/eliminar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire(
                      'Registro Deshabilitado!',
                      'Se ha Inabilitado el Registro de la Unidad de Medida.',
                      'success'
                    )
                tblMedidas.ajax.reload();
                }else{
                    Swal.fire(
                      'Mensaje!',
                      res,
                      'error'
                    )
                }
            }
        }
       
      }
    })
   
}
function btnReingresarMed(id){
    Swal.fire({
        icon: 'warning',
        title: 'ESTA SEGURO DE ACTIVAR LA UNIDAD DE MEDIDA?',
        text: "La Unidad de Medidad se activara para futuras ventas!",
        showCancelButton: true,
        confirmButtonText: 'Si, Cambiar Estado!',
        customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-danger'
        },
        buttonsStyling: false
        })
     Swal.fire({
        title: 'ESTA SEGURO DE ACTIVAR LA UNIDAD DE MEDIDA?',
        text: "La Unidad de Medida no se eliminara de forma permanente, solo se Inactivara!",
        icon: 'warning',
        confirmButtonText: 'Si, Cambiar Estado!',
        cancelButtonText: 'No, Cancelar!',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-danger me-3'
        },
        buttonsStyling: false
      }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + "Medidas/reingresar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET",url, true );
        http.send();
        http.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                     Swal.fire({
                      icon: 'success',
                      title: 'UNIDAD DE MEDIDA REINGRESADA CON EXITO',
                      text: 'Se ha modificado el registro',
                      timer: 8000,
                      customClass:{
                        confirmButton: 'btn btn-primary',
                        confirmButtonText: 'Aceptar'            
                        },
                        buttonsStyling:false          
                        })
                tblMedidas.ajax.reload();
                }else{
                    Swal.fire(
                      'Mensaje!',
                      res,
                      'error'
                    )
                }
            }
        }
       
      }
    })
            
}
// fin de Categorias



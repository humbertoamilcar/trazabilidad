(() => {
  if (typeof base_url === 'undefined') return;

  // Definir el intervalo de 5 minutos (300,000 ms) y el tiempo de advertencia antes del cierre (30 segundos)
  const TOTAL = 3000000, WARN = 300000; 
  let t1, t2, iv, left;

  // Función para redirigir a la página de cierre de sesión
  const goOut = () => window.location = base_url + 'Usuarios/salir';

  // Función para restablecer el temporizador de inactividad
  const reset = () => { 
    clearTimeout(t1); 
    clearTimeout(t2); 
    if (iv) clearInterval(iv);
    t1 = setTimeout(goOut, TOTAL);  // Cierra sesión después de 5 minutos de inactividad
    t2 = setTimeout(warn, TOTAL - WARN); // Muestra advertencia 30 segundos antes de cerrar sesión
  };

  // Función para mostrar advertencia de inactividad
  const warn = () => {
    left = WARN / 10000;
    const tick = () => { 
      if (left <= 0) return; 
      Swal.update({ html: `Cierre por inactividad en <b>${left--}</b>s` }); // Actualiza el contador de segundos
    };
    
    Swal.fire({
      icon: 'warning',
      title: 'Inactividad',
      html: `Cierre por inactividad en <b>${left}</b>s`, // Muestra el contador de 30 segundos
      showCancelButton: true,
      confirmButtonText: 'Seguir',
      cancelButtonText: 'Cerrar sesión',
      allowOutsideClick: false,
      allowEscapeKey: false,
      didOpen: () => { iv = setInterval(tick, 10000); }, // Inicia el contador de los 30 segundos
      willClose: () => { if (iv) clearInterval(iv); } // Detiene el contador cuando la ventana se cierra
    }).then(r => r.isConfirmed ? reset() : goOut());
  };

  // Agregar eventos para restablecer el temporizador de inactividad
  ['mousemove', 'keydown', 'click', 'scroll', 'touchstart'].forEach(e => window.addEventListener(e, reset, { passive: true }));

  // Iniciar el temporizador de inactividad al cargar la página
  reset();
})();

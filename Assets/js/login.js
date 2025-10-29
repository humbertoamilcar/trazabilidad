function frmLogin(e) {
    e.preventDefault();
    const correo = document.getElementById("correo");
    const password = document.getElementById("password");

    // Validación correo vacío
    if (correo.value.trim() === "") {
        correo.classList.add("is-invalid");
        password.classList.remove("is-invalid");
        correo.focus();
        Swal.fire({
            icon: 'error',
            title: 'CORREO',
            text: 'Ingrese su correo electrónico',
            timer: 4000,
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
        return;
    }

    // Validación password vacío
    if (password.value.trim() === "") {
        password.classList.add("is-invalid");
        correo.classList.remove("is-invalid");
        password.focus();
        Swal.fire({
            icon: 'error',
            title: 'CONTRASEÑA',
            text: 'Ingrese su contraseña',
            timer: 4000,
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
        return;
    }

    // Si todo está correcto → enviar al backend
    const url = base_url + "Usuarios/validar";
    const frm = document.getElementById("frmLogin");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));

    http.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const res = JSON.parse(this.responseText);

            if (res === "ok") {
                window.location = base_url + "Dashboard";
            } else {
                // Mostrar alerta de error (por ejemplo: credenciales inválidas)
                document.getElementById("alerta").classList.remove("d-none");
                document.getElementById("alerta").innerHTML = `
                    <div class="alert alert-danger text-center" role="alert">
                        ${res}
                    </div>`;
            }
        }
    };
}

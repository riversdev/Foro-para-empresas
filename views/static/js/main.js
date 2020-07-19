$(document).ready(function () {
    // PARA FORMULARIOS DE LOGIN
    $('#iniciarSesion').on('click', function () {
        $('#iniciarSesion').addClass("d-none");
        $('#contenedorFormularioIdentificar').removeClass("d-none");
    });
    $('#registrarme').on('click', function () {
        $('#contenedorFormularioIdentificar').addClass("d-none");
        $('#contenedorFormularioRegistrar').removeClass("d-none");
    });
    $('#yaTengoUnaCuenta').on('click', function () {
        $('#contenedorFormularioIdentificar').removeClass("d-none");
        $('#contenedorFormularioRegistrar').addClass("d-none");
    });
});

(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
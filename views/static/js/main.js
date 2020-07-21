$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    // BIENVENIDA A LA SESION
    alertify.success("Todo está listo!");
    // CERRAR SESION
    $('#salir').on('click', function () {
        $.ajax({
            type: "POST",
            url: "ajax/welcomeAjax.php",
            data: {
                tipo: "salir"
            },
            error: function (data) {
                console.error(data);
            },
            success: function (data) {
                location.href = "welcome";
            }
        });
    });
});

function listarEmpresas() {
    $.ajax({
        type: "POST",
        url: "ajax/empresasAjax.php",
        data: {},
        error: function (data) {
            console.error(data);
        },
        success: function (data) {
            $('#contenedorEmpresas').empty();
            $('#contenedorEmpresas').append(data);
        }
    });
}

function prepararValidacionFormularios() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                console.log(form.id);
            } else {
                event.preventDefault();
                if (form.id == "formEditarInformacion") {
                    appEmpresa.editarInformacion(form[0].value);
                } else if (form.id == "formEditarLogo") {
                    console.log("Para editar logo");
                    var formData = new FormData(document.getElementById(form.id));
                    $.ajax({
                        type: "POST",
                        url: "ajax/empresasAjax.php",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    }).done(function (echo) {
                        $('#mensaje').html(echo);
                    });
                } else {
                    console.log("Formulario no encontrado");
                }
            }
            form.classList.add('was-validated');
        }, false);
    });
}

function guardarLogo(idEmpresa) {
    let logo = document.getElementById('txtEmpresaLogo').files[0];
    $.ajax({
        type: "POST",
        url: "ajax/empresasAjax.php",
        data: {
            tipoPeticion: "guardarLogo",
            idEmpresa,
            logo
        },
        error: function (data) {
            console.error(data);
        },
        success: function (data) {
            console.log(data);
        }
    });
}

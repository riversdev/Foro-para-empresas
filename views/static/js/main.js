$(document).ready(function () {
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
                console.eror(data);
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
            } else {
                event.preventDefault();
                if (form.id == "formIdentificarUsuario") {
                    console.log("Para indentificar usuario");
                    app.fun();
                } else if (form.id == "formRegistrarUsuario") {
                    console.log("Para registrar usuario");
                } else {
                    console.log("Formulario no encontrado");
                }
            }
            form.classList.add('was-validated');
        }, false);
    });
}

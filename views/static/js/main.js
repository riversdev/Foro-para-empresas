$(document).ready(function () {
    $('#salir').on('click', function () {
        $.ajax({
            type: "POST",
            url: "ajax/welcomeAjax.php",
            data: {
                tipo: "salir"
            },
            error: function (data) {
                console.log(data);
            },
            success: function (data) {
                console.log("Saliendo:"+data);
                location.href = "welcome";
            }
        });
    });
});

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

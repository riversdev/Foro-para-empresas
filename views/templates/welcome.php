<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: /Foro-para-empresas/usuario");
}
if (isset($_SESSION['empresa_id'])) {
    header("Location: /Foro-para-empresas/empresa");
}

?>

<div class="row align-items-center justify-content-center" style="height: 100%;">
    <button id="iniciarSesion" class="btn btn-outline-primary btn-lg">
        Iniciar sesión
    </button>
    <div id="contenedorFormularioIdentificar" class="card border-primary mb-3 d-none" style="max-width: 20rem;">
        <div class="card-body text-primary">
            <h5 class="card-title text-center">Identifícate</h5>
            <form id="formIdentificarUsuario" class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-7 mb-3">
                        <label for="txtEmail">Correo</label>
                        <input type="email" class="form-control" id="txtEmail" required>
                        <div class="valid-feedback">
                            Correcto!
                        </div>
                        <div class="invalid-feedback">
                            Verifica tu correo
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="txtPassword">Contraseña</label>
                        <input type="password" class="form-control" id="txtPassword" required>
                        <div class="valid-feedback">
                            Correcto!
                        </div>
                        <div class="invalid-feedback">
                            Verifica tu contraseña
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="txtSoyEmpresa">
                                <label class="form-check-label text-primary" for="txtSoyEmpresa">
                                    Soy una empresa
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-between">
                    <button id="registrarme" class="btn btn-transparent btn-sm text-secondary" type="button">
                        Registrarme
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Ingresar
                        <i class="fas fa-arrow-circle-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="contenedorFormularioRegistrar" class="card border-primary mb-3 d-none" style="max-width: 25rem;">
        <div class="card-body text-primary">
            <h5 class="card-title text-center">Registro</h5>
            <form id="formRegistrarUsuario" class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="txtRegistroUsuario">Usuario</label>
                        <input type="text" class="form-control" id="txtRegistroUsuario" required>
                        <div class="valid-feedback">
                            Correcto!
                        </div>
                        <div class="invalid-feedback">
                            Verifica tu usuario
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtRegistroPassword">Contraseña</label>
                        <input type="password" class="form-control" id="txtRegistroPassword" required>
                        <div class="valid-feedback">
                            Correcto!
                        </div>
                        <div class="invalid-feedback">
                            Verifica tu contraseña
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="txtRegistroEmail">Correo</label>
                        <input type="email" class="form-control" id="txtRegistroEmail" required>
                        <div class="valid-feedback">
                            Correcto!
                        </div>
                        <div class="invalid-feedback">
                            Verifica tu correo
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="txtRegistroSoyEmpresa">
                                <label class="form-check-label text-primary" for="txtRegistroSoyEmpresa">
                                    Soy una empresa
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-between">
                    <button id="yaTengoUnaCuenta" class="btn btn-transparent btn-sm text-secondary" type="button">
                        Ya tengo una cuenta
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Registrarme
                        <i class="fas fa-arrow-circle-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // DISPLAY DE FORMULARIOS DE BIENVENIDA
        $('#iniciarSesion').on('click', function() {
            $('#iniciarSesion').addClass("d-none");
            $('#contenedorFormularioIdentificar').removeClass("d-none");
        });
        $('#registrarme').on('click', function() {
            $('#contenedorFormularioIdentificar').addClass("d-none");
            $('#contenedorFormularioRegistrar').removeClass("d-none");
        });
        $('#yaTengoUnaCuenta').on('click', function() {
            $('#contenedorFormularioIdentificar').removeClass("d-none");
            $('#contenedorFormularioRegistrar').addClass("d-none");
        });
    });

    // VALIDACION DE FORMULARIOS BIENVENIDA Y EVENTOS SUBMIT
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        event.preventDefault();
                        if (form.id == "formIdentificarUsuario") {
                            let txtEmail = $('#txtEmail').val();
                            let txtPassword = $('#txtPassword').val();
                            let txtSoyEmpresa = 0;
                            if ($('#txtSoyEmpresa').is(':checked')) {
                                txtSoyEmpresa = 2;
                            } else {
                                txtSoyEmpresa = 3;
                            }
                            $.ajax({
                                type: "POST",
                                url: "ajax/welcomeAjax.php",
                                data: {
                                    tipo: "identificacion",
                                    txtEmail,
                                    txtPassword,
                                    txtSoyEmpresa
                                },
                                error: function(data) {
                                    console.error(data);
                                },
                                success: function(data) {
                                    if (data == 1) {
                                        if (txtSoyEmpresa == 2) {
                                            location.href = "empresa";
                                        }
                                        if (txtSoyEmpresa == 3) {
                                            location.href = "usuario"
                                        }
                                    } else {
                                        alertify.error("Verifica tus datos!");
                                    }
                                }
                            });
                        } else if (form.id == "formRegistrarUsuario") {
                            let txtRegistroUsuario = $('#txtRegistroUsuario').val();
                            let txtRegistroPassword = $('#txtRegistroPassword').val();
                            let txtRegistroEmail = $('#txtRegistroEmail').val();
                            let txtRegistroSoyEmpresa = 0;
                            if ($('#txtRegistroSoyEmpresa').is(':checked')) {
                                txtRegistroSoyEmpresa = 2;
                            } else {
                                txtRegistroSoyEmpresa = 3;
                            }
                            $.ajax({
                                type: "POST",
                                url: "ajax/welcomeAjax.php",
                                data: {
                                    tipo: "registro",
                                    txtRegistroUsuario,
                                    txtRegistroPassword,
                                    txtRegistroEmail,
                                    txtRegistroSoyEmpresa
                                },
                                error: function(data) {
                                    console.error(data);
                                },
                                success: function(data) {
                                    if (data == "El mail de empresa ya existe!" || data == "El mail de usuario ya existe!") {
                                        alertify.error(data);
                                    } else {
                                        alertify.success(data);
                                    }
                                }
                            });
                        } else {
                            console.log("Formulario no encontrado");
                        }
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
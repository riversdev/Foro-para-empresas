<div id="app">
    <router-link to="/">Exit</router-link>
    <router-view></router-view>
</div>
<div id="welcome" class="row align-items-center justify-content-center" style="overflow-y: scroll; height: 100%;">
    <button id="iniciarSesion" class="btn btn-outline-primary btn-lg">
        Iniciar sesión
    </button>
    <div id="contenedorFormularioIdentificar" class="card border-primary mb-3 d-none" style="max-width: 20rem;">
        <div class="card-body text-primary">
            <h5 class="card-title text-center">Identifícate</h5>
            <form id="formIdentificarUsuario" class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="txtUsuario">Usuario</label>
                        <input type="text" class="form-control" id="txtUsuario" required>
                        <div class="valid-feedback">
                            Correcto!
                        </div>
                        <div class="invalid-feedback">
                            Verifica tu usuario
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtPassword">Contraseña</label>
                        <input type="password" class="form-control" id="txtPassword" required>
                        <div class="valid-feedback">
                            Correcto!
                        </div>
                        <div class="invalid-feedback">
                            Verifica tu contraseña
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
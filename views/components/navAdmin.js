Vue.component('navegacionadmin', {
    template: /*html*/`
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand d-flex justify-content-between align-items-center" href="/Foro-para-empresas/usuario">
                Foro
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <form class="form-inline my-2 my-lg-0">
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownUsuario">
                            <div class="dropdown-item-text text-center">
                                <h4>ADMIN</h4>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item text-right bg-danger text-white" id="salir">Cerrar sesión</div>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
    `
});
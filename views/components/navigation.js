Vue.component('navigation', {
    props: ['id', 'user', 'email', 'password'],
    template: /*html*/`
        <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
            <a class="navbar-brand text-white" href="/Foro-para-empresas">Foro</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <form class="form-inline my-2 my-lg-0">
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <div class="dropdown-item-text text-center">
                                <label>{{user}}</label>
                                <small>{{email}}</small>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item text-right" id="salir">Cerrar sesión</div>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
    `
});
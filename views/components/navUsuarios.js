Vue.component('navegacionusuarios', {
    props: ['nombre', 'correo'],
    template: /*html*/`
        <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
            <a class="navbar-brand d-flex justify-content-between align-items-center" href="/Foro-para-empresas/usuario">
                Foro
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <ul class="nav" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Información</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tripticos-tab" data-toggle="tab" href="#tripticos" role="tab" aria-controls="tripticos" aria-selected="false">Tripticos</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos" role="tab" aria-controls="videos" aria-selected="false">Videos</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="chat-tab" data-toggle="tab" href="#chat" role="tab" aria-controls="chat" aria-selected="false">Chat</a>
                        </li>
                    </ul>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownUsuario">
                            <div class="dropdown-item-text text-center">
                                <h4>{{nombre}}</h4>
                                <label>{{correo}}</label>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item text-right bg-danger text-white" id="salir">Cerrar sesión</div>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
    `,
    computed: {
        ...Vuex.mapState([''])
    }
});
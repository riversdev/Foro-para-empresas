Vue.component('navegacionusuarios', {
    props: ['nombre', 'correo'],
    template: /*html*/`
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <a class="navbar-brand d-flex justify-content-between align-items-center" href="/Foro-para-empresas/usuario">
                Foro
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <div class="nav d-flex justify-content-center align-items-center" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">Información</a>
                        <a class="nav-item nav-link" id="nav-tripticos-tab" data-toggle="tab" href="#nav-tripticos" role="tab" aria-controls="nav-tripticos" aria-selected="false">Tripticos</a>
                        <a class="nav-item nav-link" id="nav-videos-tab" data-toggle="tab" href="#nav-videos" role="tab" aria-controls="nav-videos" aria-selected="false">Videos</a>
                        <a class="nav-item nav-link" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Chat</a>
                    </div>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <div class="dropdown">
                        <button class="btn btn-outline-warning dropdown-toggle" type="button" id="dropdownUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right bg-primary rounded mt-4" aria-labelledby="dropdownUsuario">
                            <div class="dropdown-item-text text-center">
                                <h4 class="text-light">{{nombre}}</h4>
                                <label class="text-light">{{correo}}</label>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item bg-primary text-center">
                                <button id="salir" type="button" class="btn btn-sm btn-danger">Cerrar sesión</button>
                            </div>
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
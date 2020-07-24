Vue.component('navegacionempresas', {
    props: ['id', 'user', 'email', 'password', 'tipo', 'logoinicial'],
    template: /*html*/`
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand d-flex justify-content-between align-items-center" href="/Foro-para-empresas/home">
                <div id="contenedorLogoPrincipal" class="bg-light">
                    <img v-bind:src="logoinicial" style="height: 40px;">
                </div>
                <span class="px-1"></span>
                {{empresa}}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <div class="nav justify-content-center" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">Información</a>
                        <a class="nav-item nav-link" id="nav-tripticos-tab" data-toggle="tab" href="#nav-tripticos" role="tab" aria-controls="nav-tripticos" aria-selected="false">Tripticos</a>
                        <a class="nav-item nav-link" id="nav-videos-tab" data-toggle="tab" href="#nav-videos" role="tab" aria-controls="nav-videos" aria-selected="false">Videos</a>
                        <a class="nav-item nav-link" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Chat</a>
                    </div>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <div v-if="tipo === '2'" class="px-3">
                        <botonEditarContenido :idEmpresa="id"></botonEditarContenido>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownUsuario">
                            <div class="dropdown-item-text text-center">
                                <h4>{{empresa}}</h4>
                                <div id="contenedorLogoMenu" class="my-1 d-flex align-items-center justify-content-center">
                                    <img v-bind:src="logoinicial" style="height: 40px;">
                                </div>
                                <label>{{email}}</label>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item text-right" data-toggle="modal" data-target="#modalAgregarTriptico">Agregar triptico</div>
                            <div class="dropdown-item text-right" data-toggle="modal" data-target="#modalAgregarVideo">Agregar video</div>
                            <div class="dropdown-item text-right bg-danger text-white" id="salir">Cerrar sesión</div>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
    `,
    computed: {
        ...Vuex.mapState(['empresa'])
    }
});
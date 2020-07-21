Vue.component('botonEditarContenido', {
    props: ['idEmpresa'],
    template:/*html*/
        `
        <div class="dropdown">
            <button v-on:click="obtenerInformacion(idEmpresa)" class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownEditar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Editar información
            </button>
            <div class="dropdown-menu dropdown-menu-right border-primary" aria-labelledby="dropdownEditar" style="width:60vh;">
                <form id="formEditarInformacion" class="needs-validation p-3" novalidate enctype="multipart/form-data">
                    <input type="text" class="d-none" v-bind:value="idEmpresa">
                    <div class="form-row">
                        <div class="col col-12 mb-3">
                            <h6 class="font-weight-lighter text-dark">Empresa</h6>
                            <input type="text" class="form-control form-control-sm" id="txtEmpresaNombre" v-bind:value="empresa" required style="width:100%;">
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica el nombre!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col col-12 mb-3">
                            <h6 class="font-weight-lighter text-dark">Cambiar logo</h6>
                            <input type="file" class="form-control form-control-sm" id="txtEmpresaLogo" style="width:100%;">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col col-12 mb-3">
                            <h6 class="font-weight-lighter text-dark">Productos o servicios</h6>
                            <textarea class="form-control form-control-sm" id="txtEmpresaPS" v-bind:value="productos" rows="2" required style="width:100%;"></textarea>
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica el contenido!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col col-6 mb-3">
                            <h6 class="font-weight-lighter text-dark">Misión</h6>
                            <textarea class="form-control form-control-sm" id="txtEmpresaMision" v-bind:value="mision" rows="4" required style="width:100%;"></textarea>
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica tu misión!
                            </div>
                        </div>
                        <div class="col col-6 mb-3">
                            <h6 class="font-weight-lighter text-dark">Visión</h6>
                            <textarea class="form-control form-control-sm" id="txtEmpresaVision" v-bind:value="vision" rows="4" required style="width:100%;"></textarea>
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica tu misión!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col col-6 mb-3">
                            <h6 class="font-weight-lighter text-dark">Fundador</h6>
                            <input type="text" class="form-control form-control-sm" id="txtEmpresaFundador" v-bind:value="fundador" required style="width:100%;">
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica el nombre!
                            </div>
                        </div>
                        <div class="col col-6 mb-3">
                            <h6 class="font-weight-lighter text-dark">CEO</h6>
                            <input type="text" class="form-control form-control-sm" id="txtEmpresaCEO" v-bind:value="CEO" required style="width:100%;">
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica el nombre!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col col-12 form-group justify-content-end">
                            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    `,
    computed: {
        ...Vuex.mapState(['empresa', 'productos', 'mision', 'vision', 'fundador', 'CEO'])
    },
    methods: {
        ...Vuex.mapActions(['obtenerInformacion'])
    }
});
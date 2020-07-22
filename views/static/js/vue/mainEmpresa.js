const store = new Vuex.Store({
    state: {
        empresa: "",
        correo: "",
        contrasenia: "",
        productos: "",
        mision: "",
        vision: "",
        fundador: "",
        CEO: "",
        campos: [],
        tripticos: []
    },
    mutations: {
        llenarCampos(state, data) {
            let decodificado = JSON.parse(data);
            let empresa = decodificado[0];
            state.empresa = empresa['nombre'];
            state.correo = empresa['correo'];
            state.contrasenia = empresa['contrasenia'];
            state.productos = empresa['productosServicios'];
            state.mision = empresa['mision'];
            state.vision = empresa['vision'];
            state.fundador = empresa['fundador'];
            state.CEO = empresa['CEO'];
            console.log("Campos llenos");
        },
        recuperarCampos(state) {
            state.campos = [];
            state.campos.push({ empresa: $('#txtEmpresaNombre').val(), productos: $('#txtEmpresaPS').val(), mision: $('#txtEmpresaMision').val(), vision: $('#txtEmpresaVision').val(), fundador: $('#txtEmpresaFundador').val(), CEO: $('#txtEmpresaCEO').val() });
            console.log(state.campos);
        },
        llenarTripticos(state, data) { }
    },
    actions: {
        obtenerInformacion({ commit }, id) {
            $.ajax({
                type: "POST",
                url: "ajax/empresasAjax.php",
                data: {
                    tipoPeticion: "unico",
                    idEmpresa: id
                },
                error: function (data) {
                    console.error(data);
                },
                success: function (data) {
                    commit('llenarCampos', data);
                }
            });
        },
        guardarInformacion({ commit }, id) {
            console.log("Empresa lista para guardar:" + this.state.campos[0]['empresa']);
            $.ajax({
                type: "POST",
                url: "ajax/empresasAjax.php",
                data: {
                    tipoPeticion: "guardar",
                    idEmpresa: id,
                    empresa: this.state.campos[0]['empresa'],
                    productos: this.state.campos[0]['productos'],
                    mision: this.state.campos[0]['mision'],
                    vision: this.state.campos[0]['vision'],
                    fundador: this.state.campos[0]['fundador'],
                    CEO: this.state.campos[0]['CEO']
                },
                error: function (data) {
                    console.error(data);
                },
                success: function (data) {
                    if (data == "Información guardada!") {
                        alertify.success(data);
                    } else {
                        console.error(data);
                    }
                    store.dispatch('obtenerInformacion', id);
                }
            });
        },
        obtenerTripticos({ commit }, id) {
            $.ajax({
                type: "POST",
                url: "ajax/empresasAjax.php",
                data: {
                    tipoPeticion: "obtenerTripticos",
                    idEmpresa: id
                },
                error: function (data) {
                    console.error(data);
                },
                success: function (data) {
                    //commit('llenarTripticos', data);
                    console.log("TRIPTICOS:" + data);
                }
            });
        }
    }
});

var appEmpresa = new Vue({
    el: '#appEmpresa',
    store,
    data: {
        videoDeInicio: true,
        video: "",
        id: ""
    },
    mounted() {
        prepararValidacionFormularios();
        store.dispatch('obtenerInformacion', this.id);
        store.dispatch('obtenerTripticos', this.id);
    },
    methods: {
        editarInformacion(id) {
            store.commit('recuperarCampos');
            store.dispatch('guardarInformacion', id);
        }
    },
    computed: {
        ...Vuex.mapState(['empresa', 'productos', 'mision', 'vision', 'fundador', 'CEO'])
    }
});
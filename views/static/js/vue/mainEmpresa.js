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
        campos: []
    },
    mutations: {
        llenarCampos(state, data) {
            let decodificado = JSON.parse(data);
            let empresa = decodificado[0];
            //console.log(empresa);
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
            state.campos.push({ empresa: state.empresa, productos: state.productos, mision: state.mision, vision: state.vision, fundador: state.fundador, CEO: state.CEO });
            console.log("Campos recuperados");
        }
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
        guardarInformacion({ commit }, datos) {
            console.log(this.state.empresa);
            console.log(this.state.campos[0]['empresa']);
            console.log(this.state.campos[0]['productos']);
            console.log(this.state.campos[0]['mision']);
            console.log(this.state.campos[0]['vision']);
            console.log(this.state.campos[0]['fundador']);
            console.log(this.state.campos[0]['CEO']);
            $.ajax({
                type: "POST",
                url: "ajax/empresasAjax.php",
                data: {
                    tipoPeticion: "guardar",
                    idEmpresa: datos.id,
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
                    console.log(data);
                    store.dispatch('obtenerInformacion', datos.id);
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
        video: ""
    },
    mounted() {
        prepararValidacionFormularios();
    },
    methods: {
        editarInformacion(id) {
            store.commit('recuperarCampos');
            store.dispatch('guardarInformacion', { id });
        }
    }
});
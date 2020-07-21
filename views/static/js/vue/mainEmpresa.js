const store = new Vuex.Store({
    state: {
        empresa: "",
        productos: "",
        mision: "",
        vision: "",
        fundador: "",
        CEO: ""
    },
    mutations: {
        llenarCampos(state, data) {
            let decodificado = JSON.parse(data);
            let empresa = decodificado[0];
            state.empresa = empresa['nombre'];
            state.productos = empresa['productosServicios'];
            state.mision = empresa['mision'];
            state.vision = empresa['vision'];
            state.fundador = empresa['fundador'];
            state.CEO = empresa['CEO'];
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
                    console.log("CORRECTO!");
                    commit('llenarCampos', data);
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
    mounted: function () {
        prepararValidacionFormularios();
    },
    methods: {
        fun() {
            console.log("FUNCIONA");
        }
    }
});
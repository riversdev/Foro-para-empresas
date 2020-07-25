
var appUsuario = new Vue({
    el: '#appUsuario',
    store,
    data: {
        saludo: "Cuenta de usuario VUE !!!",
        items: [],
        idEmpresaU: "",
        empresaU: "",
        correoU: "",
        logoU: "",
        productosU: "",
        misionU: "",
        visionU: "",
        fundadorU: "",
        CEOU: ""
    },
    mounted() {
        store.dispatch('obtenerEmpresas');
    },
    methods: {
        dameElActive(id) {
            dameElActive('item' + id, this.items);
        },
        getTripticos(id) {
            store.dispatch('obtenerTripticos', id);
        }
    },
    computed: {
        ...Vuex.mapState(['empresas', 'tripticos', 'videos'])
    }
});
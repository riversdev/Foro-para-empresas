
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
        }
    },
    computed: {
        ...Vuex.mapState(['empresas'])
    }
});
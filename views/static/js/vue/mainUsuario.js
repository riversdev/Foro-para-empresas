
var appUsuario = new Vue({
    el: '#appUsuario',
    store,
    data: {
        nombreUsuario: "VUE",
        items: [],
        listaTripticos: [],
        listaVideos: [],
        idEmpresaU: "",
        empresaU: "",
        correoU: "",
        logoU: "",
        productosU: "",
        misionU: "",
        visionU: "",
        fundadorU: "",
        CEOU: "",
        tripticoSeleccionado: "",
        videoSeleccionado: ""
    },
    mounted() {
        prepararValidacionFormularios();
        store.dispatch('obtenerEmpresas');
    },
    methods: {
        dameElActive(id) {
            dameElActive('item' + id, this.items);
        },
        dameElActiveVideo(id) {
            dameElActiveVideo('listaVideos' + id, this.listaVideos);
        },
        dameElActiveTriptico(id) {
            dameElActiveTriptico('listaTripticos' + id, this.listaTripticos);
        },
        getTripticos(id) {
            store.dispatch('obtenerTripticos', id);
        },
        getVideos(id) {
            store.dispatch('obtenerVideos', id);
        }
    },
    computed: {
        ...Vuex.mapState(['empresas', 'tripticos', 'videos'])
    }
});
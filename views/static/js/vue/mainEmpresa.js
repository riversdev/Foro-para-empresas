
var appEmpresa = new Vue({
    el: '#appEmpresa',
    store,
    data: {
        id: "",
        tripticoDeInicio: true,
        idTriptico: "",
        nombreTriptico: "",
        descripcionTriptico: "",
        imagenTriptico: "data:image/jpeg;base64,",
        videoDeInicio: true,
        idVideo: "",
        nombreVideo: "",
        linkVideo: ""
    },
    mounted() {
        prepararValidacionFormularios();
        store.dispatch('obtenerInformacion', this.id);
        store.dispatch('obtenerTripticos', this.id);
        store.dispatch('obtenerVideos', this.id);
    },
    methods: {
        editarInformacion(id) {
            store.commit('recuperarCampos');
            store.dispatch('guardarInformacion', id);
        },
        obtenerTripticos() {
            store.dispatch('obtenerTripticos', this.id);
        },
        eliminarTriptico(idTrip, nomTrip) {
            confirmacionEliminarTriptico(idTrip, nomTrip);
        },
        obtenerVideos() {
            store.dispatch('obtenerVideos', this.id);
        },
        eliminarVideo(idVid, nomVid) {
            confirmacionEliminarVideo(idVid, nomVid);
        },
        tabTrip({ commit }) {
            tabularTripticos();
        }
    },
    computed: {
        ...Vuex.mapState(['empresa', 'correo', 'productos', 'mision', 'vision', 'fundador', 'CEO', 'tripticos', 'videos'])
    }
});
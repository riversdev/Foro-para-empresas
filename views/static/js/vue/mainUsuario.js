
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
        store.dispatch('obtenerEmpresas');
    },
    methods: {
        prepararValidacionForms() {
            prepararValidacionFormularios()
        },
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
        },
        getChat(id) {
            function ajax() {
                var req = new XMLHttpRequest();
                req.onreadystatechange = function () {
                    if (req.readyState == 4 && req.status == 200) {
                        document.getElementById('chatContainer').innerHTML = req.responseText;
                    }
                }
                req.open('GET', 'ajax/chatAjax.php', true);
                req.send();
            }
            setInterval(function () {
                ajax();
            }, 1000);
        }
    },
    computed: {
        ...Vuex.mapState(['empresas', 'tripticos', 'videos'])
    }
});

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
        linkVideo: "",
        mensaje: ""
    },
    mounted() {
        prepararValidacionFormularios();
        this.getChat();
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
        },
        getChat() {
            repetir();
            let idEmpresa = this.id;
            function obtenerChat() {
                $.ajax({
                    type: "POST",
                    url: "ajax/chatAjax.php",
                    data: {
                        tipoPeticion: "leer",
                        tipoAcceso: "empresa",
                        idEmpresa
                    },
                    error: function (data) {
                        console.error(data);
                    },
                    success: function (data) {
                        $('#chatContainer').empty();
                        $('#chatContainer').append(data);
                    }
                });
            }

            function repetir() {
                if (this.bucle == undefined) {
                    this.bucle = setInterval(function () {
                        obtenerChat();
                    }, 1000);
                } else {
                    clearInterval(this.bucle);
                    this.bucle = setInterval(function () {
                        obtenerChat();
                    }, 1000);
                }
            }
        }
    },
    computed: {
        ...Vuex.mapState(['empresa', 'correo', 'productos', 'mision', 'vision', 'fundador', 'CEO', 'tripticos', 'videos'])
    }
});
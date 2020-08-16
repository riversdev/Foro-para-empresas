
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
        nombreTriptico: "",
        descripcionTriptico: "",
        videoSeleccionado: "",
        nombreVideo: "",
        mensaje: "",
        bucle: undefined
    },
    mounted() {
        store.dispatch('obtenerEmpresas');
    },
    methods: {
        prepararValidacionForms() {
            prepararValidacionForms()
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
            repetir();

            function obtenerChat(idEmpresa) {
                $.ajax({
                    type: "POST",
                    url: "ajax/chatAjax.php",
                    data: {
                        tipoPeticion: "leer",
                        tipoAcceso: "usuario",
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
                        obtenerChat(id);
                    }, 1000);
                } else {
                    clearInterval(this.bucle);
                    this.bucle = setInterval(function () {
                        obtenerChat(id);
                    }, 1000);
                }
            }
        }
    },
    computed: {
        ...Vuex.mapState(['empresas', 'tripticos', 'videos'])
    }
});

let x = 0; // NI IDEA PERO FUNCIONA XD

function prepararValidacionForms() {
    // console.log("preparando valid"); // NI IDEA PERO FUNCIONA XD
    x++; // NI IDEA PERO FUNCIONA XD
    if (x == 2) { // NI IDEA PERO FUNCIONA XD
        // console.log("validacion leida"); // NI IDEA PERO FUNCIONA XD
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                    if (form.id == "formChatUsuario") {
                        guardarMensaje($('#idEmpresaChatUsuario').val(), "usuario");
                        $('#mensajeChatUsuario').val('');
                    }
                    else {
                        console.log("Formulario no encontrado 2");
                    }
                }
                form.classList.add('was-validated');
            }, false);
        });
    } // NI IDEA PERO FUNCIONA XD
}
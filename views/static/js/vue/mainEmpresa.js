const store = new Vuex.Store({
    state: {},
    mutations: {},
    actions: {}
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
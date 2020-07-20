
var appEmpresa = new Vue({
    el: '#appEmpresa',
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
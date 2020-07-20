
var appUsuario = new Vue({
    el: '#appUsuario',
    data: {
        saludo: "Cuenta de usuario VUE !!!"
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
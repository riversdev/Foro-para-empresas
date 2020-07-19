var app = new Vue({
    el: '#app',
    data: {
        saludo: "YA Estamos dentro !!!"
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
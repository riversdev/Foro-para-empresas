var appAdmin = new Vue({
    el: "#appAdmin",
    store,
    data: {
        mensaje: "HOLA VUE"
    },
    mounted() {
        prepararValidacionFormularios();
    },
});

var appUsuario = new Vue({
    el: '#appUsuario',
    store,
    data: {
        saludo: "Cuenta de usuario VUE !!!"
    },
    mounted() {
        store.dispatch('obtenerEmpresas');
    },
    computed: {
        ...Vuex.mapState(['empresas'])
    }
});
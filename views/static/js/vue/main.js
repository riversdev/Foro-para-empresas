const routes = [
    { path: '/', component: welcome },
    { path: '/home', component: home }
]

const router = new VueRouter({
    routes
})

var app = new Vue({
    el: '#app',
    router,
    data: {
        saludo: "HOLA VUE"
    },
    mounted: function () {
        prepararValidacionFormularios();
    },
    methods: {
        fun() {
            console.log("FUNCIONA");
            router.push('home');
        }
    }
});
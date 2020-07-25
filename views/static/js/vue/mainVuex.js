const store = new Vuex.Store({
    state: {
        empresa: "",
        correo: "",
        contrasenia: "",
        productos: "",
        mision: "",
        vision: "",
        fundador: "",
        CEO: "",
        campos: [],
        tripticos: [],
        videos: [],
        empresas: []
    },
    mutations: {
        llenarCampos(state, data) {
            let decodificado = JSON.parse(data);
            let empresa = decodificado[0];
            state.empresa = empresa['nombre'];
            state.correo = empresa['correo'];
            state.contrasenia = empresa['contrasenia'];
            state.productos = empresa['productosServicios'];
            state.mision = empresa['mision'];
            state.vision = empresa['vision'];
            state.fundador = empresa['fundador'];
            state.CEO = empresa['CEO'];
        },
        recuperarCampos(state) {
            state.campos = [];
            state.campos.push({ empresa: $('#txtEmpresaNombre').val(), productos: $('#txtEmpresaPS').val(), mision: $('#txtEmpresaMision').val(), vision: $('#txtEmpresaVision').val(), fundador: $('#txtEmpresaFundador').val(), CEO: $('#txtEmpresaCEO').val() });
        },
        llenarTripticos(state, data) {
            let decodificado = JSON.parse(data);
            state.tripticos = [];
            for (let i = 0; i < decodificado.length; i++) {
                state.tripticos[i] = { id: decodificado[i].id, idEmpresa: decodificado[i].idEmpresa, nombre: decodificado[i].nombre, descripcion: decodificado[i].descripcion, imagen: decodificado[i].triptico };
            }
            console.log(state.tripticos);
        },
        llenarVideos(state, data) {
            let decodificado = JSON.parse(data);
            state.videos = [];
            for (let i = 0; i < decodificado.length; i++) {
                state.videos[i] = { id: decodificado[i].id, idEmpresa: decodificado[i].idEmpresa, nombre: decodificado[i].nombre, link: decodificado[i].link };
            }
        },
        llenarEmpresas(state, data) {
            let decodificado = JSON.parse(data);
            state.empresas = [];
            for (let i = 0; i < decodificado.length; i++) {
                state.empresas[i] = { id: decodificado[i].id, nombre: decodificado[i].nombre, correo: decodificado[i].correo, logo: 'data:image/jpeg;base64,' + decodificado[i].logo, productosServicios: decodificado[i].productosServicios, mision: decodificado[i].mision, vision: decodificado[i].vision, fundador: decodificado[i].fundador, CEO: decodificado[i].CEO };
            }
        }
    },
    actions: {
        obtenerInformacion({ commit }, id) {
            $.ajax({
                type: "POST",
                url: "ajax/empresasAjax.php",
                data: {
                    tipoPeticion: "unico",
                    idEmpresa: id
                },
                error: function (data) {
                    console.error(data);
                },
                success: function (data) {
                    commit('llenarCampos', data);
                }
            });
        },
        guardarInformacion({ commit }, id) {
            $.ajax({
                type: "POST",
                url: "ajax/empresasAjax.php",
                data: {
                    tipoPeticion: "guardar",
                    idEmpresa: id,
                    empresa: this.state.campos[0]['empresa'],
                    productos: this.state.campos[0]['productos'],
                    mision: this.state.campos[0]['mision'],
                    vision: this.state.campos[0]['vision'],
                    fundador: this.state.campos[0]['fundador'],
                    CEO: this.state.campos[0]['CEO']
                },
                error: function (data) {
                    console.error(data);
                },
                success: function (data) {
                    if (data == "Información guardada!") {
                        alertify.success(data);
                    } else {
                        console.error(data);
                    }
                    store.dispatch('obtenerInformacion', id);
                }
            });
        },
        obtenerTripticos({ commit }, id) {
            $.ajax({
                type: "POST",
                url: "ajax/empresasAjax.php",
                data: {
                    tipoPeticion: "obtenerTripticos",
                    idEmpresa: id
                },
                error: function (data) {
                    console.error(data);
                },
                success: function (data) {
                    if (data == 0) {
                        store.state.tripticos = null;
                    } else {
                        commit('llenarTripticos', data);
                    }
                }
            });
        },
        obtenerVideos({ commit }, id) {
            $.ajax({
                type: "POST",
                url: "ajax/empresasAjax.php",
                data: {
                    tipoPeticion: "obtenerVideos",
                    idEmpresa: id
                },
                error: function (data) {
                    console.error(data);
                },
                success: function (data) {
                    if (data == 0) {
                        store.state.videos = null;
                    } else {
                        commit('llenarVideos', data);
                    }
                }
            });
        },
        obtenerEmpresas({ commit }) {
            $.ajax({
                type: "POST",
                url: "ajax/usuariosAjax.php",
                data: {
                    tipoPeticion: "obtenerEmpresas"
                },
                error: function (data) {
                    console.error(data);
                },
                success: function (data) {
                    if (data == 0) {
                        store.state.empresas = null;
                    } else {
                        commit('llenarEmpresas', data);
                    }
                }
            });
        }
    }
});
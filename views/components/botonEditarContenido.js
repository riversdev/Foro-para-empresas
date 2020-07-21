Vue.component('botonEditarContenido', {
    template:/*html*/
        `
        <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownEditar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Editar información
            </button>
            <div class="dropdown-menu dropdown-menu-right border-primary" aria-labelledby="dropdownEditar" style="width:60vh;">
                <form class="needs-validation p-3" novalidate>
                    <div class="form-row">
                        <div class="col col-12 mb-3">
                            <h6 class="font-weight-lighter text-dark">Empresa</h6>
                            <input type="text" class="form-control form-control-sm" id="txtEmpresaNombre" required style="width:100%;">
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica el nombre!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col col-12 mb-3">
                            <h6 class="font-weight-lighter text-dark">Productos o servicios</h6>
                            <textarea class="form-control form-control-sm" id="txtEmpresaPS" rows="2" required style="width:100%;"></textarea>
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica el contenido!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col col-6 mb-3">
                            <h6 class="font-weight-lighter text-dark">Misión</h6>
                            <textarea class="form-control form-control-sm" id="txtEmpresaMision" rows="4" required style="width:100%;"></textarea>
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica tu misión!
                            </div>
                        </div>
                        <div class="col col-6 mb-3">
                            <h6 class="font-weight-lighter text-dark">Visión</h6>
                            <textarea class="form-control form-control-sm" id="txtEmpresaVision" rows="4" required style="width:100%;"></textarea>
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica tu misión!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col col-6 mb-3">
                            <h6 class="font-weight-lighter text-dark">Fundador</h6>
                            <input type="text" class="form-control form-control-sm" id="txtEmpresaFundador" required style="width:100%;">
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica el nombre!
                            </div>
                        </div>
                        <div class="col col-6 mb-3">
                            <h6 class="font-weight-lighter text-dark">CEO</h6>
                            <input type="text" class="form-control form-control-sm" id="txtEmpresaCEO" required style="width:100%;">
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Verifica el nombre!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col col-12 form-group justify-content-end">
                            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    `
});
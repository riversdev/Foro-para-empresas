Vue.component('vaciousuarios', {
    props: ['cat'],
    template:/*html*/
        `
        <div class="row px-5 pt-3 d-flex justify-content-center pt-5 mt-5">
            <div class="card bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-body text-white">
                    <h6 class="card-title text-center">No existen {{cat}}</h6>
                    <p class="card-text text-justify">
                        <small>
                            Esta empresa no ha registrado {{cat}} aún. Ponte en contacto con ella mediante el chat o usando su correo electrónico visible en la sección <i>información</i>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    `
});
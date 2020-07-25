Vue.component('vacio', {
    props: ['cat'],
    template:/*html*/
        `
        <div class="card bg-warning mb-3" style="max-width: 18rem;">
            <div class="card-body text-white">
                <h6 class="card-title text-center">No existen {{cat}}</h6>
                <p class="card-text text-justify">
                    <small>
                        Dirigete al panel de usuario en la parte superior derecha para actualizar la información de tu empresa.
                    </small>
                </p>
            </div>
        </div>
    `
});
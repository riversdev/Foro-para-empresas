<div class="row align-items-center justify-content-center" style="overflow-y: scroll; height: 100%;">
    <button class="btn btn-outline-primary btn-lg d-none">Iniciar sesión</button>
    <div class="card border-primary mb-3" style="max-width: 18rem;">
        <div class="card-body text-primary">
            <h5 class="card-title text-center">Identifícate</h5>
            <form class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="txtUsuario">Usuario</label>
                        <input type="text" class="form-control" id="txtUsuario" required>
                        <div class="valid-feedback">
                            Correcto!
                        </div>
                        <div class="invalid-feedback">
                            Verifica tu usuario
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtPassword">Last name</label>
                        <input type="password" class="form-control" id="txtPassword" required>
                        <div class="valid-feedback">
                            Correcto!
                        </div>
                        <div class="invalid-feedback">
                            Verifica tu contraseña
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
        </div>
    </div>
</div>



<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
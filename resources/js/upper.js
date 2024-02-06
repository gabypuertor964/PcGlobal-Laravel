/**
 * Convertir a mayuscula el contenido de todos los campos de texto
*/
document.addEventListener('DOMContentLoaded', function () {
    var inputs = document.querySelectorAll('input[type="text"]');

    /* Listado de campos que no deben ser convertidos a mayusculas */
    var excludedInputs = ['email', 'password', 'password_confirmation']; 

    inputs.forEach(function (campo) {
        campo.addEventListener('input', function () {
            
            /* Verificacion pertenencia a lista de exclusion */
            if (!excludedInputs.includes(campo.name)) {
                convertToUpper(this);
            }
        });
    });

    function convertToUpper(input) {
        input.value = input.value.toUpperCase();
    }
});
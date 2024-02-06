$(document).ready(function () {
            
    /* Al oprimir el boton con el id Browse, ejecutar el evento onclic de el elemento con id photo */
    $("#browse").click(function () {
        $("#photo").click();
    });

    /* Previsualizar la imagen antes de subirla y validar que sea una imagen */
    $("#photo").change(function () {

        /* Ejecución validacion de extensione */
        if (ValidateExtension(this)) {
            readURL(this);
        } else {

            /* Mensaje de error en caso de que la imagen no tenga el formato valido */
            alert("Por favor, selecciona un archivo de imagen válido (jpeg, png, jpg, svg).");
        }
    });

    /**
     * Visualizar la imagen cargada
    */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#photo_preview').attr('src', e.target.result);
                $('#photo_preview').attr('style', 'width: 100%; height: 100%')
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    /**
     * Validar que la imagen tenga una extension valida
     * @param {*} fileInput 
     * @returns 
     */
    function ValidateExtension(fileInput) {
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.svg)$/i;
        return allowedExtensions.test(fileInput.value);
    }
});
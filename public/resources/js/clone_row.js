/**
 * @abstract Clonar el primer item de un elemento padre y añadirlo al final
 * 
 * @param {*} parentId -> Identificador del elemento padre
 * @returns Void
*/
function addChildToParent(parentId) {
    var parent = document.getElementById(parentId);
    var firstChildClone = parent.children[0].cloneNode(true);

    // Limpiar los contenidos del elemento clonado
    firstChildClone.querySelectorAll('input, textarea, select').forEach(function(element) {
        element.value = '';
    });

    // Ocultar los botones en todos los elementos anteriores
    var allElements = parent.children;
    for (var i = 0; i < allElements.length; i++) {
        var createButton = allElements[i].querySelector('#btnCreate');
        var deleteButton = allElements[i].querySelector('#btnDelete');

        createButton.classList.add('d-none');
        deleteButton.classList.add('d-none');

        createButton.setAttribute('disabled', true);
        deleteButton.setAttribute('disabled', true);
    }

    parent.appendChild(firstChildClone);

    // Mostrar ambos botones en el último elemento
    var createButton = firstChildClone.querySelector('#btnCreate');
    var deleteButton = firstChildClone.querySelector('#btnDelete');
    createButton.classList.remove('d-none');
    deleteButton.classList.remove('d-none');

    createButton.removeAttribute('disabled');
    deleteButton.removeAttribute('disabled');
}

/**
 * @abstract Eliminar el ultimo item de un elemento padre
 * 
 * @param {*} parentId -> Identificador del elemento padre
 * @returns Void
*/
function removeLastChild(parentId) {
    var parent = document.getElementById(parentId);

    if (parent && parent.children.length > 1) {
        var lastChild = parent.lastElementChild;
        parent.removeChild(lastChild);
    }

    // Mostrar ambos botones en el nuevo último elemento
    var newLastChild = parent.lastElementChild;
    var createButton = newLastChild.querySelector('#btnCreate');
    var deleteButton = newLastChild.querySelector('#btnDelete');

    createButton.classList.remove('d-none');
    deleteButton.classList.remove('d-none');

    createButton.removeAttribute('disabled');
    deleteButton.removeAttribute('disabled');

    // Ocultar el botón de eliminar si solo hay un hijo
    if (parent.children.length === 1) {
        deleteButton.classList.add('d-none');
    }
}

/**
 * @abstract Actualizar la visibilidad de los botones según la posicion de los elementos
 * 
 * @param {string} parentId - Identificador del elemento padre
 * @returns {void}
 */
function updateButtonsVisibility(parentId) {
    var parent = document.getElementById(parentId);
    var allElements = parent.children;

    for (var i = 0; i < allElements.length; i++) {

        var createButton = allElements[i].querySelector('#btnCreate');
        var deleteButton = allElements[i].querySelector('#btnDelete');

        // Ocultar ambos botones si el elemento no es el último
        if (i !== allElements.length - 1) {
            createButton.classList.add('d-none');
            deleteButton.classList.add('d-none');
            createButton.setAttribute('disabled', true);
            deleteButton.setAttribute('disabled', true);
        } else {
            // Mostrar botón de añadir en el último elemento
            createButton.classList.remove('d-none');
            createButton.removeAttribute('disabled');

            // Mostrar botón de eliminar solo si hay más de un elemento
            if (allElements.length > 1) { 
                deleteButton.classList.remove('d-none');
                deleteButton.removeAttribute('disabled');
            } else {
                deleteButton.classList.add('d-none');
                deleteButton.setAttribute('disabled', true);
            }
        }
    }
}
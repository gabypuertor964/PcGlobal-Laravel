/**
 * @abstract Clonar el primer item de un elemento padre y añadirlo al final
 *
 * @param {*} parentId -> Identificador del elemento padre
 * @returns Void
 */
function addChildToParent(parentId) {
    let parent = document.getElementById(parentId);
    let firstChildClone = parent.children[0].cloneNode(true);

    // Limpiar los contenidos del elemento clonado
    firstChildClone
        .querySelectorAll("input, textarea, select")
        .forEach(function (element) {
            element.value = "";
        });

    // Ocultar los botones en todos los elementos anteriores
    let allElements = parent.children;
    for (let i = 0; i < allElements.length; i++) {
        let createButton = allElements[i].querySelector("#btnCreate");
        let deleteButton = allElements[i].querySelector("#btnDelete");

        createButton.classList.add("d-none");
        deleteButton.classList.add("d-none");

        createButton.setAttribute("disabled", true);
        deleteButton.setAttribute("disabled", true);
    }

    parent.appendChild(firstChildClone);

    // Mostrar ambos botones en el último elemento
    let createButton = firstChildClone.querySelector("#btnCreate");
    let deleteButton = firstChildClone.querySelector("#btnDelete");
    createButton.classList.remove("d-none");
    deleteButton.classList.remove("d-none");

    createButton.removeAttribute("disabled");
    deleteButton.removeAttribute("disabled");
}

/**
 * @abstract Eliminar el ultimo item de un elemento padre
 *
 * @param {*} parentId -> Identificador del elemento padre
 * @returns Void
 */
function removeLastChild(parentId) {
    let parent = document.getElementById(parentId);

    if (parent && parent.children.length > 1) {
        let lastChild = parent.lastElementChild;
        parent.removeChild(lastChild);
    }

    // Mostrar ambos botones en el nuevo último elemento
    let newLastChild = parent.lastElementChild;
    let createButton = newLastChild.querySelector("#btnCreate");
    let deleteButton = newLastChild.querySelector("#btnDelete");

    createButton.classList.remove("d-none");
    deleteButton.classList.remove("d-none");

    createButton.removeAttribute("disabled");
    deleteButton.removeAttribute("disabled");

    // Ocultar el botón de eliminar si solo hay un hijo
    if (parent.children.length === 1) {
        deleteButton.classList.add("d-none");
    }
}

/**
 * @abstract Actualizar la visibilidad de los botones según la posicion de los elementos
 *
 * @param {string} parentId - Identificador del elemento padre
 * @returns {void}
 */
function updateButtonsVisibility(parentId) {
    let parent = document.getElementById(parentId);
    let allElements = parent.children;

    for (let i = 0; i < allElements.length; i++) {
        let createButton = allElements[i].querySelector("#btnCreate");
        let deleteButton = allElements[i].querySelector("#btnDelete");

        // Ocultar ambos botones si el elemento no es el último
        if (i !== allElements.length - 1) {
            createButton.classList.add("d-none");
            deleteButton.classList.add("d-none");
            createButton.setAttribute("disabled", true);
            deleteButton.setAttribute("disabled", true);
        } else {
            // Mostrar botón de añadir en el último elemento
            createButton.classList.remove("d-none");
            createButton.removeAttribute("disabled");

            // Mostrar botón de eliminar solo si hay más de un elemento
            if (allElements.length > 1) {
                deleteButton.classList.remove("d-none");
                deleteButton.removeAttribute("disabled");
            } else {
                deleteButton.classList.add("d-none");
                deleteButton.setAttribute("disabled", true);
            }
        }
    }
}

function addSpecRow() {
    let specTable = document.getElementById("specRegisters");
    let lastRow = specTable.lastElementChild.cloneNode(true);

    // Limpiar los contenidos del elemento clonado
    lastRow.querySelectorAll("input").forEach(function (element) {
        element.value = "";
    });

    // Ocultar los botones en todos los elementos anteriores
    let allRows = specTable.children;
    for (let i = 0; i < allRows.length; i++) {
        let createButton = allRows[i].querySelector(".btn-success");
        let deleteButton = allRows[i].querySelector(".btn-danger");

        createButton.classList.add("d-none");
        deleteButton.classList.add("d-none");

        createButton.setAttribute("disabled", true);
        deleteButton.setAttribute("disabled", true);
    }

    specTable.appendChild(lastRow);

    // Mostrar ambos botones en el último elemento
    let createButton = lastRow.querySelector(".btn-success");
    let deleteButton = lastRow.querySelector(".btn-danger");
    createButton.classList.remove("d-none");
    deleteButton.classList.remove("d-none");

    createButton.removeAttribute("disabled");
    deleteButton.removeAttribute("disabled");
}

function removeSpecRow(button) {
    let specTable = document.getElementById("specRegisters");
    let rowToRemove = button.closest(".specRegister");

    if (specTable && specTable.children.length > 1) {
        specTable.removeChild(rowToRemove);
    }

    // Mostrar ambos botones en el nuevo último elemento
    let newLastRow = specTable.lastElementChild;
    let createButton = newLastRow.querySelector(".btn-success");
    let deleteButton = newLastRow.querySelector(".btn-danger");

    createButton.classList.remove("d-none");
    deleteButton.classList.remove("d-none");

    createButton.removeAttribute("disabled");
    deleteButton.removeAttribute("disabled");

    // Ocultar el botón de eliminar si solo hay un hijo
    if (specTable.children.length === 1) {
        deleteButton.classList.add("d-none");
    }
}

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

// Función para agregar una nueva fila de imagen al formulario
function addImageRow() {
    // Obtener el elemento que contiene las filas de imágenes
    let imageRows = document.getElementById("image-rows");

    // Crear un nuevo elemento de fila (tr)
    let newRow = document.createElement("tr");

    // Establecer la clase de la nueva fila
    newRow.className = "image-row";

    // Establecer el contenido HTML de la nueva fila
    newRow.innerHTML = `
        <td class="col-9">
            <input type="file" name="new_images[]" accept=".jpeg, .png, .jpg, .svg, .webp" required>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger" onclick="removeImageRow(this, 'new')">Eliminar</button>
        </td>
    `;

    // Agregar la nueva fila al contenedor de filas de imágenes
    imageRows.appendChild(newRow);

    // Actualizar el valor del input oculto para nuevas imágenes
    updateHiddenInputValue("new");
}

// Función para eliminar la fila de imagen actual
function removeImageRow(button, imageType) {
    // Obtener la fila actual que contiene la imagen
    let row = button.closest(".image-row");

    // Eliminar la fila del DOM
    row.parentNode.removeChild(row);

    // Actualizar el valor del input oculto correspondiente
    updateHiddenInputValue(imageType);
}

// Función para actualizar el valor del input oculto
document.addEventListener("DOMContentLoaded", function () {
    updateHiddenInputValue("existing");
});
function updateHiddenInputValue(imageType) {
    // Obtener todas las filas de imágenes existentes y nuevas
    let existingRows = document.querySelectorAll(".image-row");
    let newRows = document.querySelectorAll('input[name="new_images[]"]');

    // Obtener las URLs de las imágenes existentes y actualizar el input oculto correspondiente
    let existingImageUrls = Array.from(existingRows).map(
        (row) => row.querySelector("img").src
    );
    document.getElementById("existing-images").value =
        JSON.stringify(existingImageUrls);

    // Obtener los nombres de las nuevas imágenes y actualizar el input oculto correspondiente
    let newImageNames = Array.from(newRows).map((input) =>
        input.value.split("\\").pop()
    );
    document.getElementById("new-images").value = JSON.stringify(newImageNames);
}

import algoliasearch from "algoliasearch/lite";
import instantsearch from "instantsearch.js";
import { configure, hits, searchBox } from "instantsearch.js/es/widgets";

const searchClient = algoliasearch(
    "R61XSY42T9",
    "458a8c1d0a7a3676c3f9b82ccde75087"
);

const search = instantsearch({
    searchClient,
    indexName: "sales_invoices",
    insights: true,
    future: {
        preserveSharedStateOnUnmount: true,
    },
});

search.addWidgets([
    searchBox({
        container: "#searchbox",
        showSubmit: false,
        placeholder: "Busca una factura",
        showLoadingIndicator: true,
        autoFocus: true,
        searchAsYouType: false, // Desactivamos la búsqueda automática para realizarla manualmente
    }),
    hits({
        container: "#hits",
        templates: {
            item: (hit, { html }) => {
                // Verifica si el estado es "Pendiente por entregar"
                if (hit.state === "Pendiente por entregar") {
                    // Si es "Pendiente por entregar", muestra el resultado
                    return html`
                        <a href="${route("admin.facturation.show", hit.slug)}">
                            <article
                                class="transition bg-white text-slate-700 my-1 rounded p-2 shadow-md 500 flex justify-between items-center"
                            >
                                <h1 class="text-sm md:text-lg font-medium">
                                    ${hit.name} - ${hit.state}
                                </h1>
                                <p class="text-xs md:text-base">${hit.date}</p>
                            </article>
                        </a>
                    `;
                } else {
                    // Si no es "Pendiente por entregar", no muestra el resultado
                    return "";
                }
            },
            empty: '<div class="no-results transition bg-white text-slate-700 my-1 rounded p-2 shadow-md">No se encontraron resultados</div>',
        },
        cssClasses: {
            root: "instantsearch-results",
        },
        show: true,
    }),
    configure({
        hitsPerPage: 3,
    }),
]);

search.start();

const searchBoxElement = document.querySelector("#searchbox");
const hitsContainerElement = document.querySelector("#hits");

// Oculta los resultados al principio
hitsContainerElement.style.display = "none";

// Escucha el evento de entrada de texto en el cuadro de búsqueda
searchBoxElement.addEventListener("input", (event) => {
    const query = event.target.value;

    // Muestra los resultados solo si la cadena de búsqueda no está vacía
    if (query.trim() !== "") {
        hitsContainerElement.style.display = "block";

        // Realiza la búsqueda en Algolia
        search.helper.setQuery(query).search();
    } else {
        hitsContainerElement.style.display = "none";
    }
});

document.addEventListener("click", (event) => {
    if (
        !searchBoxElement.contains(event.target) &&
        !hitsContainerElement.contains(event.target)
    ) {
        hitsContainerElement.style.display = "none";
    }
});

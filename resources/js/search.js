import algoliasearch from "algoliasearch/lite";
import instantsearch from "instantsearch.js";
import { configure, hits, searchBox } from "instantsearch.js/es/widgets";

function formatNumber(number) {
    return new Intl.NumberFormat("es-ES", { style: "decimal" }).format(number);
}

const searchClient = algoliasearch(
    "R61XSY42T9",
    "458a8c1d0a7a3676c3f9b82ccde75087"
);

const search = instantsearch({
    searchClient,
    indexName: "products",
    insights: true,
    future: {
        preserveSharedStateOnUnmount: true,
    },
});

search.addWidgets([
    searchBox({
        container: "#searchbox",
        showSubmit: false,
        placeholder: "Busca un producto",
        showLoadingIndicator: true,
        autoFocus: true,
        searchAsYouType: true,
    }),
    hits({
        container: "#hits",
        templates: {
            item: (hit, { html }) =>
                html`
                    <a href="${route("product.show", hit.slug)}">
                        <article
                            class="transition bg-white text-slate-700 my-1 rounded p-2 shadow-md hover:ring-2 hover:ring-sky-500 hover:scale-95"
                        >
                            <h1 class="text-lg font-medium">${hit.name}</h1>
                            <p>Marca: ${hit.brand}</p>
                            <p>Unidades: ${hit.stock}</p>
                            <p>Precio: $${formatNumber(hit.price)}</p>
                        </article>
                    </a>
                `,
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
hitsContainerElement.style.display = "none";

searchBoxElement.addEventListener("click", () => {
    hitsContainerElement.style.display = "block";
});

document.addEventListener("click", (event) => {
    if (
        !searchBoxElement.contains(event.target) &&
        !hitsContainerElement.contains(event.target)
    ) {
        hitsContainerElement.style.display = "none";
    }
});

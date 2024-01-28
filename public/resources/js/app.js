// Imports for functions
import { initScroll } from "./scroll";
import { initNavbar} from "./navbar";

document.addEventListener("DOMContentLoaded", () => {
    initScroll();
});

initNavbar({$btnMenu: 'boton-menu-responsive', $menu: 'menu-responsive'});
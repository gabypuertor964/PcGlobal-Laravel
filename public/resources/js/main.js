// Imports for functions
import { initScroll } from "./scroll";
import { initNavbar} from "./navbar";

document.addEventListener("DOMContentLoaded", () => {
    initScroll();
});

initNavbar({$btnMenu: 'menu-responsive', $menu: 'menu'});
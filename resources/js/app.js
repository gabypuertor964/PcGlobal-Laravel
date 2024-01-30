/**
 * @abstract Importacion de dependencias y ejecucion por defecto
*/
import { initScroll } from "./scroll";
import { initNavbar} from "./navbar";

document.addEventListener("DOMContentLoaded", () => {
    initScroll();
});

initNavbar({$btnMenu: 'menu-responsive', $menu: 'menu'});
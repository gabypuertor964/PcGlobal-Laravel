/**
 * @abstract Funcionalidad responsive del navbar
 * 
 * @param {string} $btnMenu ID del botón que activa el menú
 * @param {string} $menu ID del menú
 */
function initNavbar({$btnMenu, $menu}) {
    const $btnMenuResponsive = document.getElementById($btnMenu);
    const $menuResponsive = document.getElementById($menu);
    
    const toggleNavMenu = () => {
        $menuResponsive.classList.toggle("active");
    }

    const hideNavMenuOnResize = () => {
        if (window.innerWidth > 1024) {
            $menuResponsive.classList.remove("active");
        }
    };

    $btnMenuResponsive.addEventListener('click', toggleNavMenu);
    window.addEventListener('resize', hideNavMenuOnResize);
}

initNavbar({$btnMenu: 'menu-responsive', $menu: 'menu'});
/**
 * @abstract Funcionalidad responsive del navbar
 * 
 * @param {string} btnMenu ID del botón que activa el menú
 * @param {string} menu ID del menú
 */
function initNavbar({btnMenu, menu}) {
    const btnMenuResponsive = document.getElementById(btnMenu)
    const menuResponsive = document.getElementById(menu)
    
    btnMenuResponsive.addEventListener('click', () => {
        menuResponsive.classList.toggle('active')
    })
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) {
            menuResponsive.classList.remove('active')
        }
    });
}

function toggleDropdown({btnDropdown, dropdwon}) {
    const buttonDropdown = document.getElementById(btnDropdown);
    const dropd = document.getElementById(dropdwon)

    buttonDropdown.addEventListener('click', () => {
        dropd.classList.toggle('active')
    })
    document.addEventListener('click', (e) => {
        if (!e.target.matches(`#${btnDropdown}`) && !e.target.closest(`#${btnDropdown}`)) {
            if (dropd.classList.contains('active')) {
                dropd.classList.remove('active')
            }
        }
    })
}

initNavbar({btnMenu: 'menu-responsive', menu: 'menu'})
toggleDropdown({btnDropdown: 'dropdownButton', dropdwon: 'dropdownMenu'})
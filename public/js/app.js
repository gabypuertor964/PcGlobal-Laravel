const $btnMenuResponsive = document.getElementById('boton-menu-responsive');

document.addEventListener("DOMContentLoaded", () => {
    let isScrolling = false;

    function scrollToTarget(target) {
        isScrolling = true;
        
        let $target = target.getAttribute("href");
        let offset = document.querySelector($target).offsetTop;
        
        function scrollStep() {
            let distance = offset - window.scrollY;
            let step = distance / 20;
            
            if (Math.abs(step) > 1) {
                window.scrollBy(0, step);
                requestAnimationFrame(scrollStep);
            } else {
                window.scrollTo(0, offset);
                isScrolling = false;
            }
        }
        
        requestAnimationFrame(scrollStep);
    }

    document.querySelectorAll('nav li a[href^="#"]').forEach(function (navLink) {
        navLink.addEventListener('click', function (e) {
            e.preventDefault();
            if (isScrolling) return;
            
            scrollToTarget(this);
        });
    });
});

$btnMenuResponsive.addEventListener('click', () =>{
    const $menuResponsive = document.getElementById('menu-responsive');
    $menuResponsive.classList.toggle("hidden");
    $btnMenuResponsive.classList.toggle("fa-bars");
    $btnMenuResponsive.classList.toggle("fa-xmark");
});
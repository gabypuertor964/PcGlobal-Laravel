/**
 * @abstract Funcionalidad de scroll suave en link de categorias
*/
export default function initScroll() {
    let isScrolling = false;

    function scrollToTarget(target) {
        isScrolling = true;

        let $target = target.getAttribute("href");
        let offset = document.querySelector($target).offsetTop;

        const scrollStep = () => {
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
}
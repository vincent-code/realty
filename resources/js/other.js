document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.nav-mobile')[0].addEventListener('click', mobileMenu);
});

function mobileMenu() {
    let menu = document.querySelectorAll('.mobile-menu')[0];
    let fadeIn = 'animate__fadeInRight';
    let fadeOut = 'animate__fadeOutRight';

    if (menu.classList.contains('hide')) {
        menu.classList.remove('hide');
    } else {
        if (menu.classList.contains(fadeIn)) {
            menu.classList.remove(fadeIn);
            menu.classList.add(fadeOut);
        } else if (menu.classList.contains(fadeOut)) {
            menu.classList.remove(fadeOut);
            menu.classList.add(fadeIn);
        }
    }
}


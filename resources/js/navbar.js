// navbar.js
window.addEventListener('scroll', function () {
    const navbar = document.getElementById('mainNavbar');
    if (window.scrollY > 50) {
        navbar.classList.add('navbar-transparent');
    } else {
        navbar.classList.remove('navbar-transparent');
    }
});

// Hamburger Menu JavaScript for Sub-sites

document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenuMobile = document.querySelector('.nav-menu-mobile');
    const body = document.body;
    
    if (menuToggle && navMenuMobile) {
        // Toggle menu on button click
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            menuToggle.classList.toggle('active');
            navMenuMobile.classList.toggle('active');
            body.classList.toggle('menu-open');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.navbar') && !event.target.closest('.nav-menu-mobile')) {
                menuToggle.classList.remove('active');
                navMenuMobile.classList.remove('active');
                body.classList.remove('menu-open');
            }
        });
        
        // Close menu when clicking a menu link
        const mobileLinks = navMenuMobile.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                menuToggle.classList.remove('active');
                navMenuMobile.classList.remove('active');
                body.classList.remove('menu-open');
            });
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Get all the nav links within the ul list
    const navLinks = document.querySelectorAll("nav ul li a");
    const dashboardLink = document.querySelector('a[href="profile.php?page=dashboard"]');

    // Set the Dashboard link as active by default
    dashboardLink.classList.add('active');

    // Get the current URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const currentPage = urlParams.get('page');

    // Loop through the nav links to find the active one
    let isActiveSet = false;
    navLinks.forEach(link => {
        const linkPage = new URL(link.href).searchParams.get('page');
        if (linkPage === currentPage) {
            // Remove active class from the Dashboard link
            dashboardLink.classList.remove('active');
            // Set the active class to the current link
            link.classList.add('active');
            isActiveSet = true;
        }
    });

    // If no active link is set, keep Dashboard link as active
    if (!isActiveSet) {
        dashboardLink.classList.add('active');
    }
});
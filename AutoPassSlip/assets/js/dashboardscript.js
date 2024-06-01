document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.nav-link');
    const logoutButton = document.getElementById('logout-button');

    function loadContent(url) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                const html = xhr.responseText;
                const mainContentStart = html.indexOf('<div class="main-content" id="main-content">');
                const mainContentEnd = html.indexOf('</div>', mainContentStart) + 6;
                const newContent = html.slice(mainContentStart, mainContentEnd);
                document.getElementById('main-content').innerHTML = newContent;
            } else {
                console.error('Error loading content');
            }
        };

        xhr.onerror = function() {
            console.error('Request error');
        };

        xhr.send();
    }

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            loadContent(url);
        });
    });

    logoutButton.addEventListener('click', function(e) {
        e.preventDefault();
    });
});

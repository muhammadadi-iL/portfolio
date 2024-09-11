document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('toggle-theme');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');
    const darkThemeLinks = document.querySelectorAll('[id^="theme-dark"]');
    const whiteThemeLinks = document.querySelectorAll('[id^="theme-white"]');
    const darkThemeJs = document.querySelectorAll('[id^="theme-dark-js"], [id^="theme-dark-"]');
    const whiteThemeJs = document.querySelectorAll('[id^="theme-white-js"], [id^="theme-white-js"]');
    const darkFavIcon = document.getElementById('theme-dark-fav-icon');
    const whiteFavIcon = document.getElementById('theme-white-fav-icon');
    const topDarkLogo = document.getElementById('theme-dark-top-logo');
    const topWhiteLogo = document.getElementById('theme-white-top-logo');
    const footerDarkLogo = document.getElementById('theme-dark-footer-logo');
    const footerWhiteLogo = document.getElementById('theme-white-footer-logo');
    const body = document.body;

    function switchTheme(isWhiteTheme) {
        darkThemeLinks.forEach(link => link.disabled = isWhiteTheme);
        whiteThemeLinks.forEach(link => link.disabled = !isWhiteTheme);
        darkThemeJs.forEach(script => script.disabled = isWhiteTheme);
        whiteThemeJs.forEach(script => script.disabled = !isWhiteTheme);

        // Update icons
        sunIcon.style.display = isWhiteTheme ? 'none' : 'inline-block';
        moonIcon.style.display = isWhiteTheme ? 'inline-block' : 'none';

        // Switch favicon and logos
        darkFavIcon.disabled = isWhiteTheme ? 'none' : 'block';
        whiteFavIcon.disabled = isWhiteTheme ? 'block' : 'none';
        topDarkLogo.style.display = isWhiteTheme ? 'none' : 'block';
        topWhiteLogo.style.display = isWhiteTheme ? 'block' : 'none';
        footerDarkLogo.style.display = isWhiteTheme ? 'none' : 'block';
        footerWhiteLogo.style.display = isWhiteTheme ? 'block' : 'none';

        // Switch body class with a slight delay
        setTimeout(() => {
            if (isWhiteTheme) {
                body.classList.add('white-version');
                body.classList.remove('dark-version');
            } else {
                body.classList.remove('white-version');
                body.classList.add('dark-version');
            }

            // Remove the transition class after transition
            setTimeout(() => {
                body.classList.remove('theme-transition');
            }, 500); // Duration of the transition effect
        }, 500); // Initial delay
    }

    // Initial theme setup
    const isWhiteTheme = body.classList.contains('white-version');
    switchTheme(isWhiteTheme);

    toggleButton.addEventListener('click', () => {
        const isWhiteTheme = body.classList.contains('white-version');
        switchTheme(!isWhiteTheme);
    });
});

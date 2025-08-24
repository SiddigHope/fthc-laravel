// Theme switcher
document.addEventListener('DOMContentLoaded', function() {
    const themeSwitch = document.getElementById('theme-switch');
    const icon = themeSwitch.querySelector('i');
    const tooltip = document.querySelector('[data-bs-toggle="tooltip"]');

    // Function to update theme
    function updateTheme(theme) {
        document.documentElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);

        // Update button icon and tooltip
        if (theme === 'dark') {
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid');
            themeSwitch.title = document.documentElement.lang === 'ar' ? 'الوضع النهاري' : 'Light Mode';
        } else {
            icon.classList.remove('fa-solid');
            icon.classList.add('fa-regular');
            themeSwitch.title = document.documentElement.lang === 'ar' ? 'الوضع الليلي' : 'Dark Mode';
        }

        // Reinitialize tooltip
        if (tooltip) {
            var bsTooltip = bootstrap.Tooltip.getInstance(tooltip);
            if (bsTooltip) {
                bsTooltip.dispose();
            }
            new bootstrap.Tooltip(tooltip);
        }
    }

    // Initialize theme
    const storedTheme = localStorage.getItem('theme') || 'light';
    updateTheme(storedTheme);

    // Handle theme switch click
    themeSwitch.addEventListener('click', function() {
        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        updateTheme(newTheme);
    });
});

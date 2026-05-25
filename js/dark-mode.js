document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('theme-toggle');
    if (!toggleButton) return;
    
    // Check saved preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
        toggleButton.innerHTML = '&#9788;';
    } else {
        document.body.classList.remove('dark-mode');
        toggleButton.innerHTML = '&#9790;';
    }

    toggleButton.addEventListener('click', (e) => {
        e.preventDefault();
        document.body.classList.toggle('dark-mode');
        
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
            toggleButton.innerHTML = '&#9788;';
        } else {
            localStorage.setItem('theme', 'light');
            toggleButton.innerHTML = '&#9790;';
        }
    });
});

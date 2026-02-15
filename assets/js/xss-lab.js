document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('searchForm');
    const input = document.getElementById('searchBar');
    const display = document.getElementById('queryDisplay');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const val = input.value;
        
        display.innerHTML = val; 
    });
});
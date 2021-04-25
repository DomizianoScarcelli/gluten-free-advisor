$('#searchbar').on('input', function (e) {
    const searchbar = document.getElementById('searchbar');
    if (searchbar.value == '' && document.getElementById("searchButton")) {
        $('#searchButton').hide(300);
        setTimeout(() => {
            $(document.getElementById("searchButton")).remove();
        }, 300)

    }
    else if (searchbar.value != '' && !document.getElementById("searchButton")) {
        if (location.pathname == '/index.php') {
            let button = `<button class="btn search-btn" style="display:none;" id="searchButton" onclick='search()'>Ricerca</button>`;
            $(button).appendTo(document.getElementById("search-container")).show(300);
        }
        else {
            let button = `<button class="btn search-btn invert-btn" style="display:none;" id="searchButton" onclick='search()'>Ricerca</button>`;
            $(button).appendTo(document.getElementById("header")).show(300);
        }

    }
});

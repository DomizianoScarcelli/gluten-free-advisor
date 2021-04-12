/*Rimuove la classe row-cols-3 dal top-restaurants-nearby se la larghezza della finestra è minore di 580 pixel in quanto creava un bug */
$(window).on('resize', function () {
    var win = $(this); //this = window
    if (win.width() < 580) { $('#nearby-suggestions-card-list').removeClass('row-cols-3'); }
});
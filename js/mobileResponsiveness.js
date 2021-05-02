/*Rimuove la classe row-cols-3 dal top-restaurants-nearby se la larghezza della finestra è minore di 580 pixel in quanto creava un bug */
$(window).on('resize', () => {
    var win = $(this); //this = window
    if (win.width() < 980) {
        // $('#nearby-suggestions-card-list').removeClass('row-cols-3');

        //Rendi la larghezza dell'header e del suo contenuto 100% e responsive

        //Reponsiveness per i filtri
        if (!$('#filter-container-after').length) {
            $('#Panini').after('<div class="row" id="filter-container-after">');
            $('#filter-container').css('justify-content', 'space-evenly');
        }
        //Responsiveness per 'i nostri consigli'
        $('#our-suggestions').css('text-align', 'center');

        //Responsiveness per 'i ristoranti vicino a te'
        $('#nearby-suggestions').css('text-align', 'center');
        $('#nearby-suggestions').css('padding-left', '');
        $('#nearby-suggestions-container').removeClass('row');
        $('#nearby-suggestions-description-container').css('width', '100%');
        $('#nearby-suggestions-card-list').removeClass('row-cols-3');
        $('#nearby-suggestions-card-list').addClass('row-cols-auto');
        $('.col.last').css('padding-top', '');

    }

    //Reset fitri
    if (win.width() > 980) {
        if ($('#filter-container-after').length) {
            $('#filter-container-after').remove();
            $('#filter-container').css('justify-content', 'space-around');
        }
        //Reset per 'i nostri consigli'
        $('#our-suggestions').css('text-align', '');

        //Responsiveness per 'i ristoranti vicino a te'
        $('#nearby-suggestions').css('text-align', '');
        $('#nearby-suggestions').css('padding-left', '6rem');
        $('#nearby-suggestions-container').addClass('row');
        $('#nearby-suggestions-description-container').css('width', '18rem');
        $('#nearby-suggestions-card-list').removeClass('row-cols-auto');
        $('#nearby-suggestions-card-list').addClass('row-cols-3');
        $('.col.last').css('padding-top', '2rem');

    }

});
/*  Qui c'è il codice relativo al pulsante (e relativo form) della pagina del ristorante
che permette l'aggiunta di una nuova recensione. L'interazione con il db verrà gestita da una
opportuna pagina php.   */

const submitReviewButton = document.getElementById('submit-review-button');
const closeButton = document.getElementById('close-button');
const modalBody = document.getElementById('modal-body');
const originalHtml = modalBody.innerHTML;

submitReviewButton.addEventListener('click', function () {
    //Se il pulsante è già stato premuto, allora chiudi il form modale e resetta i campi.
    if (submitReviewButton.value == 'Chiudi') {
        location.reload();
    }
    else {

        /*Altrimenti invia i dati tramite il submit. 
        if ($('#review-title').val() == '' || $('#review-date').val() == '' || $('#review-text').val() == '') {
            alert('Titolo, data e descrizione sono obbligatori!');
            return;
        }

        if ($('#username').val() == '') {
            alert('Stai inviando la recensione in forma anonima.');
        }*/

        console.log('recensione aggiunta');
        submit();
        submitReviewButton.removeAttribute('data-dismiss');
        submitReviewButton.removeAttribute('Aria-label');
    }
});

closeButton.addEventListener('click', () => {
    location.reload();
});

function submit() {
    console.log('Added');
    sendReviewData();
    modalBody.innerHTML = `
        <p style="text-align:center;" >Grazie per il tuo contributo, la recensione è stata aggiunta al profilo del ristorante!</p>
    `;
    submitReviewButton.value = 'Chiudi';
    submitReviewButton.innerHTML = 'Chiudi';
}

function sendReviewData() {
    var formData = new FormData();

    //Prendo il valore dei campi di input del form
    var id_ristorante = document.getElementsByName('restaurant-div')[0].id;
    var title = $('#review-title').val();
    var text = $('#review-text').val();
    var radiovalues = document.getElementsByName('inlineRadioOptions');
    for (var i = 0; i < radiovalues.length; i++) {
        if (radiovalues[i].checked) {
            var rating = radiovalues[i].value;
        }
    }
    var date = $('#review-date').val();
    var username = $('#username').val();

    //Setta username ad "anonimo" se l'utente non ha modificato il campo username
    if ($('#username').val() == '') {
        username = "anonimo";
    }

    //Li inserisco dentro l'oggetto formData
    formData.append('id_ristorante', id_ristorante)
    formData.append('title', title);
    formData.append('text', text);
    formData.append('rating', rating);
    formData.append('date', date);
    formData.append('username', username);

    //Faccio la post con il metodo $.ajax() di JQuery
    $.ajax({
        type: 'POST',
        url: 'dbManager/dbAddReview.php',
        data: formData,
        contentType: false,
        processData: false,
        success: (data) => {
            console.log(data);
        },
    });
}
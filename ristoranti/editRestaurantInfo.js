/*  Qui c'è il codice relativo al pulsante (e relativo form) per modificare i dati
relativi al ristorante (aggiungere descrizione, immagini etc). L'interazione con il db verrà gestita
da una opportuna pagina php.   */

const submitEditsButton = document.getElementById('edit-info-button');
const closeButton = document.getElementById('close-button-2');
const modalBody = document.getElementById('modal-body-2');
const originalHtml = modalBody.innerHTML;


submitEditsButton.addEventListener('click', function () {
    //Se il pulsante è già stato premuto, allora chiudi il form modale e resetta i campi.
    if (submitEditsButton.value == 'Chiudi') {
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

        console.log('modifiche salvate');
        submit();
        submitEditsButton.removeAttribute('data-dismiss');
        submitEditsButton.removeAttribute('Aria-label');
    }
});

closeButton.addEventListener('click', () => {
    location.reload();
});
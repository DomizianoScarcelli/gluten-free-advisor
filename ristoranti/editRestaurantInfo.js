/*  Qui c'è il codice relativo al pulsante (e relativo form) per modificare i dati
relativi al ristorante (aggiungere descrizione, immagini etc). L'interazione con il db verrà gestita
da una opportuna pagina php.   */

const submitEditsButton = document.getElementById('edit-info-button');
const closeButton2 = document.getElementById('close-button-2');
const modalBody2 = document.getElementById('modal-body-2');
const originalHtml2 = modalBody2.innerHTML;


submitEditsButton.addEventListener('click', function () {
    //Se il pulsante è già stato premuto, allora chiudi il form modale e resetta i campi.
    if (submitEditsButton.value == 'Chiudi') {
        location.reload();
    }
    else {
        /*Se viene premuto per la prima volta, invia i dati tramite il submit. 
        if ($('#review-title').val() == '' || $('#review-date').val() == '' || $('#review-text').val() == '') {
            alert('Titolo, data e descrizione sono obbligatori!');
            return;
        }

        if ($('#username').val() == '') {
            alert('Stai inviando la recensione in forma anonima.');
        }*/

        console.log('modifiche salvate');
        submit2();
        submitEditsButton.removeAttribute('data-dismiss');
        submitEditsButton.removeAttribute('Aria-label');
    }
});

closeButton2.addEventListener('click', () => {
    location.reload();
});

function submit2() {
    console.log('Saved');
    sendEditsData();
    modalBody2.innerHTML = `
        <p style="text-align:center;" >Grazie per aver aggiunto le tue informazioni, le modifiche sono state salvate!</p>
    `;
    submitEditsButton.value = 'Chiudi';
    submitEditsButton.innerHTML = 'Chiudi';
}

function sendEditsData() {

    var formData2 = new FormData();

    var id_ristorante = document.getElementsByName('restaurant-div')[0].id;
    var description = $('#restaurant-description-2').val();
    var tags = [];
    for (checkbox of document.getElementsByClassName('modal-form-checkbox')) {
        if (checkbox.checked) {
            tags.push(checkbox.value);
        }
    }

    //insert into formData
    formData2.append('id_ristorante', id_ristorante);
    formData2.append('description', description);
    formData2.append('tags', tags);
    //Caricamento delle immagini
    var files = $('#restaurant-image-2')[0].files;
    for (file of files) {
        formData2.append('file[]', file);
    }
    //Codice per ispezionare formData2 nella console del browser
    for (var pair of formData2.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    //Faccio la post con il metodo $.ajax() di JQuery
    $.ajax({
        type: 'POST',
        url: 'dbEditRestaurantInfo.php',
        data: formData2,
        contentType: false,
        processData: false,
        success: (data) => {
            //console.log("success");
            console.log(data);
        }
    });

}
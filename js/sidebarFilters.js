const consegnaDomicilio = document.getElementById('consegna-domicilio');
const asporto = document.getElementById('asporto');
const consumazionePosto = document.getElementById('consumazione-posto');
const cucinaSeparata = document.getElementById('cucina-separata');
var urlParams = new URLSearchParams(location.search)



//Guarda quali piatti sono stati selezionati e li checka
var piatti = urlParams.getAll('piatti');
for (var i = 0; i < piatti.length; i++) {
    document.getElementById(piatti[i]).checked = true;
}



consegnaDomicilio.addEventListener('change', () => {
    if (consegnaDomicilio.checked) {
        urlParams.append('consegna domicilio', 'true');
        location.search = urlParams;
    }
    else {
        urlParams.delete('consegna domicilio')
        location.search = urlParams;
    }
});
asporto.addEventListener('change', () => {
    if (asporto.checked) {
        urlParams.append('asporto', 'true');
        location.search = urlParams;
    }
    else {
        urlParams.delete('asporto')
        location.search = urlParams;
    }
});



// $('#form').submit(() => {
// 	sendMail();
// });

function sendMail() {
	formData = new FormData();
	name = $('#name')[0].value;
	subject = $('#subject')[0].value;
	email = $('#email')[0].value;
	message = $('#message')[0].value;

	if (name == '' || subject == '' || email == '' || message == '') {
		alert('Tutti i campi sono obbligatori!');
	}
	formData.set('name', name);
	formData.set('subject', subject);
	formData.set('email', email);
	formData.set('message', message);
	$.ajax({
		type: 'POST',
		url: 'dbSendMail.php',
		data: formData,
		contentType: false,
		processData: false,
		success: function (response) {
			console.log(response);
			//Modifica il form mostrando un messaggio di corretto invio della mail
			document.getElementById('form-container').innerHTML = `
			<div class="card-post-container">
				<div class="card-post">
					<div class="contact-form-title post-title">Grazie per averci contattato, il tuo messaggio è stato inviato correttamente, il Team risponderà appena possibile!</div>
				</div>
            </div>
			`;
		},
	});
}

//Event Handlers
$('#back-icon').click(() => {
	location.href = '/';
});
$('#back-icon').mouseover(() => {
	$('#back-text').show(300);
});
$('#back-icon').mouseout(() => {
	$('#back-text').hide(300);
});
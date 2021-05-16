function doEvent(element) {
	var urlParams = new URLSearchParams();
	urlParams.append('id', element.id);
	let url = new URL(location.origin + '/ristoranti/ristoranti.php?' + urlParams);
	location.href = url;
}

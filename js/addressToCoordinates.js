// Create the script tag, set the appropriate attributes
var script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBmqK5XJ_5rt1y9jHSZQdfq1h-Hm-4rLHk&callback=initMap';
script.async = true;

// Attach your callback function to the `window` object
window.initMap = function () {
    locate('Via di casal selce, 294');
};

const locate = (address) => {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': address }, (results, status) => {

        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            console.log(latitude, longitude);
        }
    });
}

// Append the 'script' element to 'head'
document.head.appendChild(script);

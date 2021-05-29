//Apre lo slideshow modale
function openModalSlideshow() {
    document.getElementById("modalslides").style.display = "block";
}

//Chiude lo slideshow modale
function closeModalSlideshow() {
    document.getElementById("modalslides").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

//Controllo tramite i bottoni next/previous
function plusSlides(n) {
    showSlides(slideIndex += n);
}

//Controllo selezionando un indicatore
function currentSlide(n) {
    showSlides(slideIndex = n);
}

//Funzione che permette lo scorrimento delle slides
function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("slides");
    var dots = document.getElementsByClassName("demo");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}
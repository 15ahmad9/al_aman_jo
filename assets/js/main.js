document.addEventListener('DOMContentLoaded', function(){

    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');

    menuToggle.addEventListener('click', function(){
        navLinks.classList.toggle('active');
    });

});


const slides = document.querySelectorAll('.slide');

let currentSlide = 0;

function changeSlide() {

    slides[currentSlide].classList.remove('active');

    currentSlide++;

    if(currentSlide >= slides.length){
        currentSlide = 0;
    }

    slides[currentSlide].classList.add('active');
}

setInterval(changeSlide, 5000);
// Showcase slider
const slide = document.querySelectorAll('.slide');
const intervalTime = 5000;

const nextSlide = () => {
    const current = document.querySelector('.current');
    current.classList.remove('current')
    if(current.nextElementSibling) {
        current.nextElementSibling.classList.add('current')
    } else {
        slide[0].classList.add('current')
    }
}

setInterval(nextSlide, intervalTime)

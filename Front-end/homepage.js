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

// Menu-button
const menu = document.getElementsByClassName('main-menu-hidden')[0]
const menu_btn = document.getElementsByClassName('fa-bars')[0]

menu_btn.addEventListener('click', () => {
    menu.classList.toggle('show')
    menu_btn.classList.toggle('fa-bars')
    menu_btn.classList.toggle('fa-times')
})
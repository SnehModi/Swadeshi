const main_img = document.querySelector('.main-img')
const sm_img = document.getElementsByClassName('sm-img')


for(let i = 0; i<sm_img.length; i++) {
    sm_img[i].addEventListener('click', () => {
        main_img.src = sm_img[i].src
    })
}


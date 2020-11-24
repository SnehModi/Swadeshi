// Image-shocase
const main_img = document.querySelector('.main-img')
const sm_img = document.getElementsByClassName('sm-img')

for(let i = 0; i<sm_img.length; i++) {
    sm_img[i].addEventListener('click', () => {
        main_img.src = sm_img[i].src
    })
}

// Add to cart ajax
let qty = document.getElementById('qty-select')
let size = document.getElementById('size-select')
let color = document.getElementById('color-select')

const addToCart = (prodId) => {
    qty = qty!=null ? qty.value : null
    size = size!=null ? size.value : null
    color = color!=null ? color.value : null

    var data = "prodId=" + prodId + "&color=" + color +"&size=" + size +"&qty=" + qty

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 

    xhr.onreadystatechange = () => {
        
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("add-to-cart").innerHTML = '<i class="fas fa-check"></i> Added to Cart';
            console.log(xhr.responseText)
        }
    };

    xhr.open("POST", "addtocart.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(data);
}


const addToWishlist = (prodId) => {

    var data = "prodId=" + prodId;

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 

    xhr.onreadystatechange = () => {
        
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("add-to-wish").innerHTML = '<i class="fas fa-check"></i> Added to Wishlist';
            console.log(xhr.responseText)
        }
    };

    xhr.open("POST", "addtowishlist.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(data);
}
const clearCart = () => {
    document.cookie = "cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    location = location;
}

function placeOrder() {
    window.location.assign("cartpage.php?order")
}

const removeItem = (id) => {
    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 

    xhr.onreadystatechange = () => {
        
        if (xhr.readyState == 4 && xhr.status == 200) {
            window.location.assign("cartpage.php")
        }
    };

    xhr.open("POST", "addtocart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`delete=${id}`);
}
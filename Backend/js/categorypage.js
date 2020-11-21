const filter = document.querySelector('.filter');
const filter_menu = document.querySelector('.filter-menu');
const filter_close = document.querySelector('.close-filter');
let offset = 0;
const starsTotal = 5;

try {
    filter.addEventListener('click', () => {
        filter_menu.style.transform = "translateX(0px)";
    })
    
    filter_close.addEventListener('click', () => {
        filter_menu.style.transform = "translateX(-1000px)";
    })
} catch (error) {
    
}



// Product Card
const createCard = (jsonData, ROOT_URL) => {
    var html = '';
    var data;
    jsonData.forEach(product => {
        const starPercentage = (product['rating'] / starsTotal) * 100;
        // Round to nearest 10
        const starPercentageRounded = Math.round(starPercentage / 10) * 10;
        data = `
            <div class="card">
                <a href=${ ROOT_URL + "productpage.php?id=" +  product['id'] }>
                    <img src=${ product['thumbnail'] } width="196px" height="196px">
                    <p class="description">${ product['shortDis'] }</p>
                </a>
                <p>by <span class="product-company">${ product['manufacturer'] }</span></p>
                <div>
                    <div class="review">
                        <div class="stars-outer">
                            <div class="stars-inner" style="width: ${starPercentageRounded}%;"></div>
                        </div>
                        <span class="number-rating"> ${product['rating']} </span>
                        <span class="count">(${product['review']})</span>
                    </div>
                    <br>
                    <div class="price">$${ product['price'] }</div>
                </div>
            </div>
        `;

        html += data;
    });

    return html;
}

// Select checked

const getSelectedItems = (list) => {
    var checked = [];
    list.forEach(item => {
        if(item.checked){
            checked.push(item.value);
        }
    })
    return checked;
}

// Filter and Show More
const filter_brand = document.querySelectorAll('.filter-brand input[type="checkbox"]');
const filter_rating = document.querySelectorAll('.filter-rating input[type="radio"]');
const filter_price = document.querySelectorAll('.filter-price input[type="checkbox"]');

var category;
var brand = getSelectedItems(filter_brand);
var rating = getSelectedItems(filter_rating)[0] || null;
var price = getSelectedItems(filter_price);
const grid = document.querySelector('.product-grid');
const ajax_msg = document.querySelector('#ajax-msg');


const getProducts = (search, ROOT_URL, apply) => {
    category = [search];
    if(apply){
        offset = 0;
        brand = getSelectedItems(filter_brand);
        rating = getSelectedItems(filter_rating)[0] || null;
        price = getSelectedItems(filter_price);
    }
    else{
        offset+=2;
    }

    var filter_options = {
        offset : offset,
        search : category,
        brand : brand.length>0 ? brand : null,
        rating : rating,
        price : price.length>0 ? price : null,
    }
    // console.log(filter_options)
    var data = JSON.stringify(filter_options);
    // console.log(data)
    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 

    xhr.onreadystatechange = () => {
        
        if (xhr.readyState == 4 && xhr.status == 200) {
            // console.log(xhr.responseText)
            jsonData = JSON.parse(xhr.responseText)
            // console.log(jsonData)
            if(jsonData.length > 0){
                document.querySelector('#load-more-btn').style.display = "block";
                let html = createCard(jsonData, ROOT_URL);
                ajax_msg.innerHTML = '';
                if(apply){
                    grid.innerHTML = html
                } else {
                    grid.innerHTML += html
                }
            } else {
                document.querySelector('#load-more-btn').style.display = "none";
                if(apply){
                    grid.innerHTML = '';
                    ajax_msg.innerHTML = "Sorry :( No matches found";
                } else {
                    ajax_msg.innerHTML = "That's it :)"
                }
                
            }   
        }
    };

    xhr.open("POST", "loadproducts.php", true);
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.send(data);
}

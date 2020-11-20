<?php
    require_once('config/db.php');
    require_once('config/config.php');
?>

<div class="nav-block">

    <div id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>

    <div class="sign-in">
        Login
    </div>

    <ul class="main-menu-hidden">
        <li class="search-box">
            <form action="<?php echo ROOT_URL . 'categorypage.php' ?>"  method="GET">
                <i class="fas fa-search fa-1x" ></i>
                <div class="search-wrap">
                    <input type="text" placeholder="Search" name="s" onkeyup="suggest(this.value)">
                    <div class="suggestion">
                    </div>
                </div> 
            </form>
        </li>
        <li>
            <a href="">My Account</a>
        </li>
        <li>
            <a href="">Categories</a>
        </li>
        <li>
            <a href="">My Cart</a>
        </li>
        <li>
            <a href="">About us</a>
        </li>
    </ul>

    <nav class="nav-container">
        <div class="nav-bar">

            <a href="<?php echo ROOT_URL . 'homepage.php' ?>"><img class = "navicon" src="images/swadeshi_logo.png"></a>

            <form action="<?php echo ROOT_URL . 'categorypage.php' ?>"  method="GET">
                <ul class="search-box">
                    <input type="text" placeholder="Search" name="s" onkeyup="suggest(this.value)">
                    <div class="suggestion">
                    </div>
                    <button type="reset">Cancel</button>
                </ul>
            </form>

            <ul class="main-menu">
                <li>
                    <a href="#search" alt="search">
                        <i class="fas fa-search fa-1x"></i>
                    </a>
                </li>
                <li>
                    <a href="#cart" alt="cart">
                        <i class="fas fa-shopping-cart fa-1x"></i>
                    </a>
                </li>
                <li>
                    <a href="#login">
                        <i class="fas fa-user-circle fa-1x"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    
</div>

<script>
    const suggest_box = document.querySelectorAll('.suggestion');
    const suggest = (search) => {
        // console.log(search)
        if(search != ''){
            var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 
            var data = `s=${search}`;
            xhr.onreadystatechange = () => {
                
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // console.log(xhr.responseText)
                    jsonData = JSON.parse(xhr.responseText)
                    // console.log(jsonData)
                    if(jsonData.length > 0){
                        suggest_box[0].innerHTML = suggest_box[1].innerHTML = '';
                        jsonData.forEach(match => {
                            var pattern = new RegExp(search, 'i');
                            var text = match.replace(pattern, '<span style="font-weight: 600; text-transform: lowercase;">' + search + '</span>')
                            suggest_box[0].innerHTML = suggest_box[1].innerHTML += '<a href="<?php echo ROOT_URL . "categorypage.php?s=" ?>' + match +'">' + text + '</a>';
                        })
                    } else {
                        suggest_box[0].innerHTML = suggest_box[1].innerHTML = '';
                    }
                }
            };

            xhr.open("POST", "searchsuggestion.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(data);
        } else {
            suggest_box[0].innerHTML = suggest_box[1].innerHTML = '';
        }
    }

</script>
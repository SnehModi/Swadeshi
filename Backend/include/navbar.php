<?php
    require_once('config/db.php');
    require_once('config/config.php');
?>

<div class="nav-block">

    <div id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>

    <div class="sign-in">
        <?php if(isset($_SESSION['user'])): ?>  
            <a href="">Logout</a>       
        <?php else: ?>
            <a href="">Login</a> 
        <?php endif; ?>
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
            <?php if(isset($_SESSION['user'])): ?>  
                <a href="">My Account</a>       
            <?php else: ?>
                <a href="">Login</a> 
            <?php endif; ?>
        </li>
        <li>
            <a href="<?php echo ROOT_URL . 'categorypage.php' ?>">Categories</a>
        </li>
        <li>
            <a href="<?php echo ROOT_URL . 'cartpage.php' ?>">My Cart</a>
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
                    <a href="<?php echo ROOT_URL . 'cartpage.php' ?>" alt="cart">
                        <i class="fas fa-shopping-cart fa-1x"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ROOT_URL . 'myaccount.php' ?>">
                        <i class="fas fa-user-circle fa-1x"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    
</div>

<script>
    // Menu-button
    const menu = document.getElementsByClassName('main-menu-hidden')[0]
    const menu_btn = document.getElementsByClassName('fa-bars')[0]

    menu_btn.addEventListener('click', () => {
        menu.classList.toggle('show')
        menu_btn.classList.toggle('fa-bars')
        menu_btn.classList.toggle('fa-times')
    })

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
<!-- The file that has the header and footer sections -->

<!DOCTYPE html>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/CSS/base.css">
        <?= $this->renderSection('css_title')?>
    </head>

    <body>
        <header>
            <h1>avenue</h1>

            <?php if(isset($_SESSION['firstname'])): ?> <!-- If the user has logged in, show :-->
                    <!-- put all this inside a nav -->

                <!-- The link for the all_products page -->
                <a class = "dashboard text-reset" href = "/dashboard/viewProducts">Clothes</a> 

                <!-- Shopping cart icon and size -->
                <a href = "/user/viewCart">
                    <div class = "cart_icon_size" id = "cart_icon_size" onmouseover = 'changeColorOnHoverInDiv("cart_icon_size")' onmouseout = 'changeColorOnExitInDiv("cart_icon_size")'>
                        <svg id = "cart_icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                    
                        <!-- For initial page load / refresh, it uses PHP. After adding/removing items, value is managed by JS-->
                        <?php if(isset($_SESSION['shopping_cart'])): ?> 
                            <p id = "cart_size" class = "cart_size"><?=count($_SESSION['shopping_cart'])?></p>
                        <?php else: ?>
                            <p id = "cart_size" class = "cart_size">0</p>
                        <?php endif; ?>
                        
                    </div>
                </a>

                <!-- Username -->
                <p class = "username"><?= $_SESSION['firstname']?></p>

                <!-- Settings icon -->
                <button class="setting_btn_outline" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <svg onmouseover = 'changeColorOnHover("setting_btn")' onmouseout = 'changeColorOnExit("setting_btn")' xmlns="http://www.w3.org/2000/svg" id = "setting_btn" width="20" height="20" fill="white" class="bi bi-gear setting_btn" viewBox="0 0 16 16">
                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                    </svg>
                
                </button>

                <!-- Off-canvas -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h3 id="offcanvasRightLabel">Settings</h3>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    
                    <div class="offcanvas-body">
                        <!-- Wallet icon and link -->
                        <a href = "/user/viewWallet">
                            <div class = "svg_link" onmouseover = 'changeColorOnHoverInDiv("wallet_div")' onmouseout = 'changeColorOnExitInDiv("wallet_div")' id = "wallet_div">
                                <svg xmlns="http://www.w3.org/2000/svg" id = "wallet_icon" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                                </svg>
                                <p>Your Wallet</p>
                            </div>
                        </a>

                        <!-- Purchase history icon and link -->
                        <a href = "/user/viewPurchaseHistory">
                            <div class = "svg_link" onmouseover = 'changeColorOnHoverInDiv("history_div")' onmouseout = 'changeColorOnExitInDiv("history_div")' id = "history_div">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                <p>Purchase History</p>
                            </div>
                        </a>

                        <!-- Edit Profile icon and link -->
                        <a href = "/user/editUser">
                            <div class = "svg_link" onmouseover = 'changeColorOnHoverInDiv("profile_div")' onmouseout = 'changeColorOnExitInDiv("profile_div")' id = "profile_div">
                                <svg id = "profile_icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>                           
                                <p>Edit Profile</p>
                            </div>
                        </a>

                        <!-- Logout icon and Link -->
                        <a href = "/user/logout">
                            <div class = "svg_link" onmouseover = 'changeColorOnHoverInDiv("logout_div")' onmouseout = 'changeColorOnExitInDiv("logout_div")' id = "logout_div">
                                <svg xmlns="http://www.w3.org/2000/svg" id = "logout_icon" width="18" height="18" fill="white" class="bi bi-door-open" viewBox="0 0 16 16">
                                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                                    <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                                </svg>
                                <p>Log Out</p>
                            </div>
                        </a>
                    </div>
                </div>

            <?php elseif(isset($display_header_links)): ?> <!-- To display on the landing page -->
                <a class = "login text-reset header_link" href = "/user/login">Log In</a>
                <a class = "register text-reset header_link" href = "/user/register">Sign Up</a>
            <?php else: ?> <!-- Make sure that the login and register links don't show when the user has logged in and they have not accessed Home/index() -->
                <?php $display_header_links = NULL;?>
            <?php endif; ?>            
        </header>

        <main>
            <!-- Where the code for the views is placed -->
            <?= $this -> renderSection('content')?> 
        </main>

        <footer>
            <p>Connect with us!</p>
            <ul>
                <li><a href = "instagram.com/avenue" class = "link-primary text-decoration-none">Instagram</a></li>
                <li><a href = "twitter.com/avenue" class = "link-primary text-decoration-none">Twitter</a></li>
                <li><a href = "tiktok.com/avenue" class = "link-primary text-decoration-none">Tik Tok</a></li>
            </ul>

            <p class = "copyright">2021 avenue.com. All Rights Reserved.</p>           
        </footer>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script src = "/assets/JS/validate.js"></script> <!--JS Validation Form-->
        <?= $this -> renderSection('js')?> <!-- Where JS is placed -->

        <script type = "text/javascript">
            function changeColorOnHover(id) // Change the setting icon to orange when hovering over it
            {
                const btn = document.getElementById(id);
                btn.setAttribute("fill", "orange");
            }  
            
            function changeColorOnHoverInDiv(div_id) // For the off-canvas links - to change the color of both the svg and the link/p to orange when hovering over them
            {
                const div = document.getElementById(div_id);
                const svg = div.children[0]; 
                const link_p = div.children[1].style.color = "orange";
                svg.setAttribute("fill", "orange");
            }
            
            function changeColorOnExit(id) // Change the setting icon to white when exiting it
            {
                const btn = document.getElementById(id);
                btn.setAttribute("fill", "white");
            }  

            function changeColorOnExitInDiv(div_id) // For the off-canvas links - to change the color of both the svg and the link/p back to white when exiting the div
            {
                const div = document.getElementById(div_id);
                const svg = div.children[0]; 
                const link_p = div.children[1].style.color = "white";
                svg.setAttribute("fill", "white");
            }
        </script>

    </body>

</html>
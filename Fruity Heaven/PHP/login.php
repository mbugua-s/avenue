<!DOCTYPE html>
<html>
    <head>
        <title>Fruity Heaven | Login</title>
        <style><?php include '../CSS/base.css'?></style>
        <style><?php include '../CSS/login.css'?></style>
    </head>

    <body>
        <header>
            <h1>Fruity Heaven</h1>
        </header>
        
        <main>
            <h2>Login Page</h2>

            <form method = "POST" action = "login_action.php">
                <fieldset>
                    <legend: Login Page></legend:>

                    <label for = "uname">Username: </label>
                    <input type = "name" id = "uname" name = "u_name" class = "details"><br><br>

                    <label for = "pword">Password: </label>
                    <input type = "password" id = "pword" name = "p_word" class = "details"><br><br>

                    <input type = "submit" name = "login" id = "login_details" value = "LOGIN" class = "button">
                    <input type = "reset" name = "reset" id = "reset_details" value = "RESET" class = "button">

                    <p>Don't have an existing account?</p><br>
                    <a href = "register.php" class = "sign_up">Sign up</a>

                </fieldset>    
            </form>
        </main>

        <footer>
            <p>Connect with us!</p>
            <ul>
                <li><a href = "instagram.com/fruity_heaven">Instagram</a></li>
                <li><a href = "twitter.com/fruity_heaven">Twitter</a></li>
                <li><a href = "snapchat.com/fruity_heaven">Snapchat</a></li>
            </ul>

            <a href = "About Us.html">About Us</a><br>
            <a href = "FAQ.html">FAQ</a>

            <p class = "copyright">2021 Fruity Heaven. All rights reserved.</p>
        </footer>
    </body>
</html>
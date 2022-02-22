<!DOCTYPE html>

<html>
    <head>
        <title>avenue | Home</title>
    </head>

    <body>
        <header>
            <h1>avenue</h1>

            <?php if(isset($_SESSION['first_name'])): ?>
                <p class = "username"><?=$_SESSION['first_name']?></p>
            <?php else: ?>
                <a class = "login" href = "/user/login">Log In</a>
                <a class = "register" href = "/user/register">Sign Up</a>
            <?php endif; ?>            
        </header>

    <main>
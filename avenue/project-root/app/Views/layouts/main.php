<!-- The file that has the header and footer sections -->

<!DOCTYPE html>

<html>
    <head>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="/assets/CSS/base.css">
        <?php foreach($files as $name) :?>
        <link rel="stylesheet" href="/assets/CSS/<?=$name?>.css">
        <?php endforeach; ?>
        <title>avenue | <?=$title?></title>
    </head>

    <body>
        <header>
            <h1>avenue</h1>

            <?php if(isset($_SESSION['firstName'])): ?>
                <p class = "username"><?= $_SESSION['firstName']?></p>
            <?php else: ?>
                <a class = "login" href = "/user/login">Log In</a>
                <a class = "register" href = "/user/register">Sign Up</a>
            <?php endif; ?>            
        </header>

        <main>
            <?= $this -> renderSection('content')?>
        </main>

        <footer>
            <p>Connect with us!</p>
            <ul>
                <li><a href = "instagram.com/avenue">Instagram</a></li>
                <li><a href = "twitter.com/avenue">Twitter</a></li>
                <li><a href = "tiktok.com/avenue">Tik Tok</a></li>
            </ul>

            <p class = "copyright">2021 avenue.com. All Rights Reserved.</p>           
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <!--JS Validation Form--><script src = "/assets/JS/validate.js"></script>
    <?= $this -> renderSection('js')?>


    </body>

</html>
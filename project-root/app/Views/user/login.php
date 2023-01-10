<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/user_login.css">
    <title>avenue | Login</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Login</h2>
<form id = "login" method = "POST" action = "/user/login">
    <div>
        <h3>Enter your details below</h3>

        <label for = "login_email">Email Address : </label>
        <input type = "mail" name = "login_email" id = "login_email"><br>

        <label for = "login_password">Password : </label>
        <input type = "password" name = "login_password" id = "login_password"><br>

        <input type = "submit" value = "LOG IN" name = "submit" class = "btn"><br>

        <p>Don't have an account?</p>
        <a href = "/user/register">REGISTER</a>
    </div>
</form>

<?= $this -> endSection() ?>

<?= $this -> section('js')?>
    <!-- <script src = "/assets/JS/login_ajax.js"></script> -->
<?= $this -> endSection() ?>
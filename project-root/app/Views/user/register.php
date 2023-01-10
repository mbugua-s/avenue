<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/user_login.css">
    <title>avenue | Register</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Register</h2>
<form id = "register" method = "POST" action = "/user/register">
    <div>
        <h3>Enter your details below</h3>

        <label for = "reg_email">Email Address : </label>
        <input type = "mail" name = "reg_email" id = "reg_email"><br>

        <label for = "reg_firstname">First Name : </label>
        <input type = "text" name = "reg_firstname" id = "reg_firstname"><br>

        <label for = "reg_lastname">Last Name : </label>
        <input type = "text" name = "reg_lastname" id = "reg_lastname"><br>

        <label for = "reg_ini_password">New Password : </label>
        <input type = "password" name = "reg_ini_password" id = "reg_ini_password"><br>

        <label for = "reg_password">Confirm Password : </label>
        <input type = "password" name = "reg_password" id = "reg_password"><br>


        <div class = radio>
            <label for = "reg_male">Male: </label>
            <input type = "radio" name = "reg_gender" value = "male" id = "r_male">

            <label for = "reg_female">Female: </label>
            <input type = "radio" name = "reg_gender" value = "female" id = "r_female"><br>           
        </div>

        <input type = "submit" value = "REGISTER" name = "submit" class = "btn">                  

        <p>Already have an account?</p>
        <a href = "/user/login">LOG IN</a>
    </div>
</form>

<?= $this -> endSection() ?>

<?= $this -> section('js')?>
    <!-- <script src = "/assets/JS/register_ajax.js"></script> -->
<?= $this -> endSection() ?>
<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/user_login.css">
    <title>avenue | Add Users</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Add User</h2>
<form id = "add_user" method = "POST" action = "/admin/addUsers">
    <div>
        <h3>Enter user details below</h3>

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


        <div class = "radio">
            <label for = "reg_male">Male: </label>
            <input type = "radio" name = "reg_gender" value = "male" id = "r_male">

            <label for = "reg_female">Female: </label>
            <input type = "radio" name = "reg_gender" value = "female" id = "r_female"><br>           
        </div>

        <div class = "radio">
            <label for = "r_customer">Customer: </label>
            <input type = "radio" name = "reg_usertype" value = 1 id = "r_customer">

            <label for = "r_admin">Admin: </label>
            <input type = "radio" name = "reg_usertype" value = 2 id = "r_admin"><br>           
        </div>

        <input type = "submit" value = "REGISTER" name = "submit" class = "btn">                  
    </div>
</form>

<?= $this -> endSection() ?>

<?= $this -> section('js')?>
    <!-- <script src = "/assets/JS/register_ajax.js"></script> -->
<?= $this -> endSection() ?>
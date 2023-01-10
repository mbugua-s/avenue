<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/user_login.css">
    <title>avenue | Edit Users</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Edit Details</h2>
<form id = "edit_details" method = "POST" action = "/admin/editUsers">
    <div>
        <h3>Current Details</h3>
        <input type = "hidden" name = "reg_ID" value = <?=$details['userID']?>>

        <label for = "reg_email">Email Address : </label>
        <input type = "mail" name = "reg_email" id = "reg_email" value = <?=$details['email_address']?>><br>

        <label for = "reg_firstname">First Name : </label>
        <input type = "text" name = "reg_firstname" id = "reg_firstname" value = <?=$details['firstname']?>><br>

        <label for = "reg_lastname">Last Name : </label>
        <input type = "text" name = "reg_lastname" id = "reg_lastname" value = <?=$details['lastname']?>><br>

        <div class = "radio">
            <label for = "reg_male">Male: </label>
            <input type = "radio" name = "reg_gender" value = "male" id = "r_male" <?php if($details['gender'] == "male"){ echo "checked"; } ?>>

            <label for = "reg_female">Female: </label>
            <input type = "radio" name = "reg_gender" value = "female" id = "r_female" <?php if($details['gender'] == "female"){ echo "checked"; } ?>><br>           
        </div>

        <div class = "radio">
            <label for = "r_customer">Customer: </label>
            <input type = "radio" name = "reg_usertype" value = 1 id = "r_customer" <?php if($details['role'] == 1){ echo "checked"; } ?>>

            <label for = "r_admin">Admin: </label>
            <input type = "radio" name = "reg_usertype" value = 2 id = "r_admin" <?php if($details['role'] == 2){ echo "checked"; } ?>><br>           
        </div>

        <input type = "submit" value = "SAVE CHANGES" name = "save_edit" class = "btn">
    </div>
</form>

<?= $this -> endSection() ?>

<?= $this -> section('js')?>
    <!-- <script src = "/assets/JS/register_ajax.js"></script> -->
<?= $this -> endSection() ?>
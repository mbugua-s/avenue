<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/user_login.css">
    <title>avenue | Add Category</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Add Category</h2>
<form id = "add_category" method = "POST" action = "/admin/addCategory">
    <div>
        <h3>Enter category details below</h3>

        <label for = "cat_name">Category Name : </label>
        <input type = "text" name = "cat_name" id = "cat_name"><br>

        <input type = "submit" value = "ADD CATEGORY" name = "cat_add" class = "btn">                  
    </div>
</form>

<?= $this -> endSection() ?>

<?= $this -> section('js')?>
    <!-- <script src = "/assets/JS/register_ajax.js"></script> -->
<?= $this -> endSection() ?>
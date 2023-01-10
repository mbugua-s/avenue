<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/user_login.css">
    <title>avenue | Edit Category</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Edit Category</h2>
<form id = "edit_category" method = "POST" action = "/admin/editCategory">
    <div>
        <h3>Current Category Details</h3>

        <input type = "hidden" value = <?=$details['category_id']?> name = "cat_id">

        <label for = "cat_name">Category Name : </label>
        <input type = "text" name = "cat_name" id = "cat_name" value = <?=$details['category_name']?>><br>

        <input type = "submit" value = "EDIT CATEGORY" name = "cat_edit" class = "btn">
    </div>
</form>

<?= $this -> endSection() ?>

<?= $this -> section('js')?>
    <!-- <script src = "/assets/JS/register_ajax.js"></script> -->
<?= $this -> endSection() ?>
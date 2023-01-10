<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/user_login.css">
    <title>avenue | Add Sub-Category</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Add Sub Category</h2>
<form id = "add_subcategory" method = "POST" action = "/admin/addSubcategory">
    <div>
        <h3>Enter sub category details below</h3>

        <label for = "subcat_name">Sub Category Name : </label>
        <input type = "text" name = "subcat_name" id = "subcat_name"><br>

        <label for = "subcat_cat">Category : </label>
        <select name = "subcat_cat" id = "subcat_cat">
            <?php foreach($categories as $key => $val) :?>
                <option value = <?=$val['category_id']?>>
                    <?=$val['category_name']?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <input type = "submit" value = "ADD SUBCATEGORY" name = "subcat_add" class = "btn">                  
    </div>
</form>

<?= $this -> endSection() ?>

<?= $this -> section('js')?>
    <!-- <script src = "/assets/JS/register_ajax.js"></script> -->
<?= $this -> endSection() ?>
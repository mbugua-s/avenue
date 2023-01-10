<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/user_login.css">
    <title>avenue | Edit Sub Category</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Edit Sub Category</h2>
<form id = "edit_subcategory" method = "POST" action = "/admin/editSubcategory">
    <div>
        <h3>Current sub-category details</h3>

        <input type = "hidden" value = <?=$subcat_details['subcategory_id']?> name = "subcat_id">

        <label for = "subcat_name">Sub Category Name : </label>
        <input type = "text" name = "subcat_name" id = "subcat_name" value = <?=$subcat_details['subcategory_name']?>><br>

        <label for = "subcat_cat">Category : </label>
        <select name = "subcat_cat" id = "subcat_cat">
            <?php foreach($cat_details as $key => $val) :?>
                <option value = <?=$val['category_id']?>>
                    <?=$val['category_name']?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <input type = "submit" value = "EDIT SUBCATEGORY" name = "subcat_edit" class = "btn">                  
    </div>
</form>

<?= $this -> endSection() ?>

<?= $this -> section('js')?>
    <!-- <script src = "/assets/JS/register_ajax.js"></script> -->
<?= $this -> endSection() ?>
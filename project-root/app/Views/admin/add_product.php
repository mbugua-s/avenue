<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/user_login.css">
    <title>avenue | Add Product</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Add Products</h2>
<form id = "add_product" method = "POST" action = "/admin/addProduct" enctype = "multipart/form-data">
    <div>
        <h3>Enter the product's details below</h3>

        <label for = "prod_name">Product Name : </label>
        <input type = "text" name = "prod_name" id = "prod_name"><br>

        <label for = "prod_description">Product Description : </label>
        <textarea rows = "4" cols = "40" name = "prod_description" id = "prod_description"></textarea><br><br><br>

        <label for = "prod_price">Product Price : </label>
        <input type = "number" name = "prod_price" id = "prod_price"><br>

        <label for = "prod_subcat">Sub Category : </label>
        <select name = "prod_subcat" id = "prod_subcat">
            <?php foreach($category_details as $cat_key => $cat_val) :?>
                <optgroup label = <?=$cat_val['category_name']?>>
                    <?php foreach($subcategory_details as $subcat_key => $subcat_val) :?>
                        <?php if($cat_val['category_id'] == $subcat_val['category_id']) :?>
                            <option value = <?=$subcat_val['subcategory_id']?>>
                                <?=$subcat_val['subcategory_name']?>
                            </option>                      
                        <?php endif; ?>
                    <?php endforeach; ?>
                </optgroup>
            <?php endforeach; ?>
        </select><br>

        <label for = "prod_quantity">Available Quantity : </label>
        <input type = "number" name = "prod_quantity" id = "prod_quantity"><br>

        <label for = "prod_image">Product Image : </label>
        <input type = "file" name = "prod_image" id = "prod_image"><br>

        <input type = "hidden" value = <?=$_SESSION['userID']?> name = "prod_added_by">

        <input type = "submit" value = "ADD PRODUCT" name = "prod_add" class = "btn">                  
    </div>
</form>

<?= $this -> endSection() ?>

<?= $this -> section('js')?>
    <!-- <script src = "/assets/JS/register_ajax.js"></script> -->
<?= $this -> endSection() ?>
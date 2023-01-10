<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/user_login.css">
    <title>avenue | Edit Product</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Edit Products</h2>
<form id = "edit_product" method = "POST" action = "/admin/editProduct" enctype = "multipart/form-data">
    <div>
        <h3>Current Product Details : </h3>
        
        <img src = <?="/assets/uploaded_images/".$product_details['product_image']?> class = "current_image"><br>
        
        <label for = "prod_name">Product Name : </label>
        <input type = "text" name = "prod_name" id = "prod_name" value = <?=$product_details['product_name']?>><br>
        
        <label for = "prod_description">Product Description : </label>
        <textarea rows = "4" cols = "40" name = "prod_description" id = "prod_description"><?=$product_details['product_description']?></textarea><br><br><br>
        
        <label for = "prod_price">Product Price : </label>
        <input type = "number" name = "prod_price" id = "prod_price" value = <?=$product_details['unit_price']?>><br>
        
        <label for = "prod_subcat">Sub Category : </label>
        <select name = "prod_subcat" id = "prod_subcat">
            <?php foreach($all_categories as $cat_key => $cat_val) :?>
                <optgroup label = <?=$cat_val['category_name']?>>
                    <?php foreach($all_subcategories as $subcat_key => $subcat_val) :?>
                        <?php if($cat_val['category_id'] == $subcat_val['category_id']) :?>
                            <option value = <?=$subcat_val['subcategory_id']?> <?php if($product_details['subcategory_id'] == $subcat_val['subcategory_id']) { echo "selected"; }?>>
                                <?=$subcat_val['subcategory_name']?>
                            </option>                      
                        <?php endif; ?>
                    <?php endforeach; ?>
                </optgroup>
            <?php endforeach; ?>
        </select><br>
        
        <label for = "prod_quantity">Available Quantity : </label>
        <input type = "number" name = "prod_quantity" id = "prod_quantity" value = <?=$product_details['available_quantity']?>><br>
        
        <label for = "prod_image">Product Image : </label>
        <input type = "file" name = "prod_image" id = "prod_image"><br>
        
        <!-- <label for = "prod_currentimage">Current Image : </label> -->

        <input type = "hidden" value = <?=$_SESSION['userID']?> name = "prod_added_by">
        <input type = "hidden" value = <?=$product_details['product_id']?> name = "prod_id">
        <input type = "hidden" value = <?=$productimage_details['productimages_id']?> name = "prodimage_id">
        
        <input type = "submit" value = "EDIT PRODUCT" name = "prod_edit" class = "btn">
        <input type = "submit" value = "DELETE PRODUCT" name = "prod_delete" class = "btn btn-danger">                
    </div>
</form>

<?= $this -> endSection() ?>

<?= $this -> section('js')?>
    <!-- <script src = "/assets/JS/register_ajax.js"></script> -->
<?= $this -> endSection() ?>
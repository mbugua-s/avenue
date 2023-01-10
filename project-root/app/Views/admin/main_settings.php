<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/main_settings.css">
    <title>avenue | Main Settings</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Admin Settings</h2>
<div class = "main_buttons">
    <div class = "label_button_group">
        <h3>Users</h3>
        <a class = "btn" href = "/admin/addUsers">Add Users</a><br>
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
        Edit Users
        </button>
    
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Search for user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form method = "POST" action = "/admin/editUsers">
                        <div class="modal-body">
                            <label for = "search_email">Enter their email address below:</label><br>
                            <input type = "mail" id = "search_email" name = "search_email">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value = "Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class = "label_button_group">
        <h3>Categories</h3>
        <a class = "btn" href = "/admin/addCategory">Add Categories</a><br>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
            Edit Categories
        </button>
        
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Search for category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form method = "POST" action = "/admin/editCategory">
                        <div class="modal-body">
                            <label for = "search_cat">Enter the category name below:</label><br>
                            <select name = "cat_name" id = "cat_name">
                                <?php foreach($all_categories as $key => $val) :?>
                                    <option value = <?=$val['category_name']?>>
                                        <?=$val['category_name']?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value = "Search" name = "submit_cat_search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class = "label_button_group">
        <h3>Sub-categories</h3>
        <a class = "btn" href = "/admin/addSubcategory">Add Sub-categories</a><br>
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3">
        Edit Sub-categories
        </button>

        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Choose sub-category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method = "POST" action = "/admin/editSubcategory">
                        <div class="modal-body">
                            <label for = "search_subcat">Choose the sub-category below:</label><br>
                            <select name = "subcat_id" id = "subcat_id">

                                <?php foreach($all_categories as $cat_key => $cat_val) :?>

                                    <optgroup label = <?=$cat_val['category_name']?>>
                                        <?php foreach($all_subcategories as $subcat_key =>$subcat_val) :?>

                                            <?php if($cat_val['category_id'] == $subcat_val['category_id']) :?>
                                                <option value = <?=$subcat_val['subcategory_id']?> name = "subcategory_id">
                                                    <?=$subcat_val['subcategory_name']?>
                                                </option>                                              
                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>

                            </select>
                        </div>
                            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value = "Search" name = "submit_subcat_search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class = "label_button_group">
        <h3>Product</h3>
        <a class = "btn" href = "/admin/addProduct">Add Products</a><br>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal4">
        Edit Products
        </button>

        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4">Choose product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method = "POST" action = "/admin/editProduct">
                        <div class="modal-body">
                            <label for = "search_prod">Choose the product to edit below:</label><br>
                            <select name = "prod_id" id = "prod_id">
                                <?php foreach($all_categories as $cat_key => $cat_val) :?>
                                    <?php foreach($all_subcategories as $subcat_key =>$subcat_val) :?>
                                        <?php if($subcat_val['category_id'] == $cat_val['category_id']) :?>                                           
                                            <optgroup label = "<?=$cat_val['category_name'].' - '.$subcat_val['subcategory_name']?>">
                                                <?php foreach($all_products as $prod_key => $prod_val) :?>
                                                    <?php if($prod_val['subcategory_id'] == $subcat_val['subcategory_id']) :?>
                                                        <option value = <?=$prod_val['product_id']?> name = "product_id">
                                                            <?=$prod_val['product_name']?>
                                                        </option>                                              
                                                    <?php endif; ?>                                              
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value = "Search" name = "submit_prod_search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>   
</div>

<?= $this -> endSection() ?>
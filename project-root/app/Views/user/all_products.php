<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/all_products.css">
    <title>avenue | All Clothes</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>All Clothes</h2>

<h3>Filters</h3>
<!-- Displaying the filters. The category and subcategory dropdowns use data from the db -->

<!-- Category filter -->
<div class = "filter_label_select">
    <label for = "filter_category" class = "filter_label">Category : </label>
    <select name = "filter_category" id = "filter_category" class = "filter_select">
        <option>empty</option>
        <?php foreach($all_categories as $category_key => $category_val) :?> 
            <option><?=$category_val?></option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Subcategory filter -->
<div class = "filter_label_select">
    <label for = "filter_subcategory" class = "filter_label">Sub-category : </label>
    <select name = "filter_subcategory" id = "filter_subcategory" class = "filter_select">
        <option>empty</option>
        <?php foreach($all_subcategories as $subcategory_key => $subcategory_val) :?> 
            <option><?=$subcategory_val['subcategory_name']?></option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Price filter -->
<div class = "filter_label_select">
    <label for = "filter_price" class = "filter_label">Price : </label>
    <select name = "filter_price" id = "filter_price" class = "filter_select">
        <option>empty</option>
        <option value = "H2L">Highest to lowest</option>
        <option value = "L2H">Lowest to highest</option>
    </select>
</div><br>

<!-- To submit the filters -->
<button class = "btn btn-primary button" id = "filter_submit">Filter</button> 

<!-- Display the products. First time uses PHP, other page loads use JS -->
<div id = "all_products"> 
    <?php foreach($all_details as $prod_key => $prod_val) :?>
        <div class="card col-12 col-sm-6 col-md-4"> <!-- The product card with its details and image -->
            <img src=<?="/assets/uploaded_images/".$prod_val['product_image']?> class="card-img-top" alt="...">
    
            <div class="card-body">
                <h5 class="card-title"><?= $prod_val['category_name']." - ".$prod_val['subcategory_name'] ?></h5>
                <p class="card-text"><?=$prod_val['product_name']?></p>
                <p class="card-text price">Ksh. <?=$prod_val['unit_price']?></p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToCartModal" class="btn btn-primary" onclick = 'addProductID(<?=$prod_val["product_id"]?>)'>
                    Add To Cart
                </button>
            </div>
        </div>

    <?php endforeach; ?>
</div>
    
<!-- Modal to add the selected item to the shopping cart -->
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToCartModalLabel">Add To Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <label for = "cart_item_quantity">Quantity : </label>
                <input type = "number" min = 1 id = "cart_item_quantity" name = "cart_item_quantity">                              
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal" onclick = "removeProductID()">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id = "add_to_cart_submit" onclick = "addToCart()">Add To Cart</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast to notify user that product has been added -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>

        <div class="toast-body">
           Product added to cart successfully.
        </div>
    </div>
</div>


<?= $this -> endSection() ?>

<?= $this -> section('js')?>

<script type = "text/javascript">   
    $("#filter_submit").click(function() //Submitted the filters
    {
        var category = $('#filter_category').find(":selected").text();
        var subcategory = $('#filter_subcategory').find(":selected").text();
        var price = $('#filter_price').find(":selected").val();
        
        $.ajax // Send the filters selected by the user to dashboard/filterProducts
        ({
            method: 'GET',
            url: "/dashboard/filterProducts?filter_category="+category+"&filter_subcategory="+subcategory+"&filter_price="+price,
            dataType: "json",
            success: function(data)
            {
                filterProducts(data);
            }
        });
    })
    
    function filterProducts(data)
    {
        // Remove all product divs
        var products_wrapper = $('#all_products');
        var products = products_wrapper.children();
        products.remove();
        
        if(data === null) // If no products that match the filtering criteria exist, add text to inform the user
        {
            var no_products_div = $('<div class = "no_products"></div>');
            $('<h3>No Products Found</h3>').appendTo(no_products_div);
            $('<p>We don\'t have products that match your criteria, but we\'ll add them eventually!</p>').appendTo(no_products_div);
            
            no_products_div.appendTo(products_wrapper);
        }
        
        else //For every product returned by dashboard/filterProducts, create its divs and add them to the #all_products div
        {
            for(i = 0; i < data['all_details'].length; i++)
            {
                //Make the card and the img, add the img to the card
                
                var card = $('<div class = "card col-12 col-sm-6 col-md-4"></div>');
                $('<img class = "card-img-top" src = "/assets/uploaded_images/' + data['all_details'][i]['product_image'] + '">').appendTo(card);
                
                /* Make the card body and its h5, p and a elements. Append the elements to the card body, then add the card body to the card,
                then add the card to the all_products div */
                
                var card_body = $('<div class = "card-body"></div>');
                $('<h5 class = "card-title">'+data['all_details'][i]['category_name'] + " - " + data['all_details'][i]['subcategory_name']+'</h5>').appendTo(card_body);
                $('<p class = "card-text">'+data['all_details'][i]['product_name']+'</p>').appendTo(card_body);
                $('<p class =" card-text price">Ksh. '+data['all_details'][i]['unit_price']+'</p>').appendTo(card_body);
                $('<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToCartModal" class="btn btn-primary" onclick = "addProductID('+data['all_details'][i]['product_id']+')">Add To Cart</button>').appendTo(card_body);
                // $('<a class = "btn btn-primary">Add To Cart</a>').appendTo(card_body);
                card_body.appendTo(card);
                card.appendTo(products_wrapper);
            }
        }
    }
    
    function addProductID(product_id) //Add the product_id to the add_to_cart modal
    {
        $('<input id = "cart_item_product_id" type = "hidden" name = "cart_item_product_id" value ="' + product_id + '">').appendTo('.modal-body');
    }
    
    function removeProductID() //Remove the hidden product_id input when the add_to_cart modal is closed without submitting.
    {
        $('#cart_item_product_id').remove();
    }
    
    function addToCart() //Send the product_id and quantity to Dashboard/addToCart through AJAX, then update the cart counter
    {
        var product_id = $('#cart_item_product_id').val();
        var quantity = $('#cart_item_quantity').val();
        
        $.ajax
        ({
            method: 'GET',
            url: '/user/addToCart?cart_item_quantity='+quantity+'&cart_item_product_id='+product_id,
            dataType: 'json',
            success: function(data)
            {
                incrementCartCounter(data);
            }
        });
        
        $('#cart_item_product_id').remove();
    }
    
    function incrementCartCounter(data) //Increment the shopping cart counter in the nav
    {
        if(data == true)
        {
            var cart_size_string = $('#cart_size').text();
            cart_size_int = parseInt(cart_size_string);
            cart_size_int++;
            $('#cart_size').html(cart_size_int);
        }
    }
    
    // Initialising the toast
    var toastTrigger = document.getElementById('add_to_cart_submit');
    var toastLiveExample = document.getElementById('liveToast');
    
    toastTrigger.addEventListener('click', function()
    {
        var toast = new bootstrap.Toast(toastLiveExample);
        toast.show();
    })

    
</script>

<?= $this -> endSection() ?>
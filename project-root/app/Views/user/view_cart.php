<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/view_cart.css">
    <title>avenue | Cart</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<div class = "main_content">
    <h2>Your Shopping Cart</h2>

    <?php if(isset($_SESSION['shopping_cart'])): ?> <!-- If the cart has at least one item-->
        <table class = "table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Sub-Category</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price (Ksh)</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Cost (Ksh)</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
    
            <tbody>
                <?php $count = 1; foreach($_SESSION['shopping_cart'] as $cart_key => $cart_val) :?> <!-- $count = numbering the rows, $total = total cost of all products-->
                    <form method = "POST" action = "/user/deleteCartItem"> <!-- Every row is a form-->
                        <tr class = "align-middle">
                            <td><?=($count)?></td>
                        
                            <?php foreach($cart_val as $cart_item_key => $cart_item_val) :?>
                                <?php if($cart_item_key == "product_id") :?>
                                    <input type = "hidden" value = "<?=$cart_key?>" name = "cart_item_id">                 
                                <?php else: ?>
                                    <td><?=$cart_item_val?></td>                       
                                <?php endif; ?>
                            <?php endforeach; ?>
                        
                            <td><?= ($cart_val['unit_price']*$cart_val['quantity']);?></td> <!-- Price * Quantity-->
                            <td class = "align-middle">
                                <input type = "submit" class = "btn btn-primary cart_delete" value = "DELETE" name = "cart_delete">
                            </td>
                        </tr>
                    </form>
                <?php $count++; endforeach; ?>
            </tbody>
        </table><br>

        <div class = "purchase_details">
            <h3 class = "total_cost" id = "purchase_details_amount">Amount In Wallet : <?='Ksh . '.$wallet_details['amount_available']?></h3><br>
            <h3 class = "total_cost" id = "purchase_details_cost">Total Cost :  <?='Ksh. '.$total?></h3><br>
            <h3 class = "total_cost" id = "purchase_details_balance">Balance After Purchase :  <?='Ksh. '.($wallet_details['amount_available'] - $total)?></h3><br>
        </div>

        <a href = "/dashboard/viewProducts" class = "btn btn-primary cart_continue_shopping">CONTINUE SHOPPING</a>

        <!-- Modal for when the wallet has an insufficient balance / confirming purchase -->
        <button type="button" class="btn btn-primary cart_checkout" data-bs-toggle="modal" data-bs-target="#exampleModal">
            PAY (VIA WALLET)
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                <?php if(($wallet_details['amount_available'] - $total) >= 0): ?> <!-- User has sufficient balance -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Comfirm Purchase</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        Press the confirm button to complete your purchase
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary orange_button" data-bs-dismiss="modal">GO BACK TO CART</button>
                        <a href = "/user/purchaseItems" type="button" class="btn btn-primary green_button">CONFIRM PURCHASE</a>
                    </div>
                <?php else: ?> <!-- User has insufficient balance -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Insufficient Balance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        You have an insufficient balance to complete this purchase. Please add at least Ksh. <?=($wallet_details['amount_available'] - $total) * -1?> to your wallet to continue.
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary orange_button" data-bs-dismiss="modal">CLOSE</button>
                        <a href = "/user/viewWallet" type="button" class="btn btn-primary green_button">TOP UP WALLET</a>
                    </div>              
                <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: ?> <!-- The cart is empty-->
        <h3>Your shopping cart is empty!</h3>
        <p>You haven't added any item to your cart, but you can check out all our products now that you're here!</p><br>
        <a href = "/dashboard/viewProducts" class = "btn btn-primary cart_continue_shopping">VIEW ALL CLOTHES</a>
    <?php endif; ?>


</div>

<?= $this -> endSection() ?>

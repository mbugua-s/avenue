<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/view_cart.css">
    <title>avenue | Purchase Receipt</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<div class = "main_content">
    <h2>Purchase Successful</h2>

    <h3>Here are the details of the purchase you just made : </h3>
    <table class = "table receipt_table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Sub-Category</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price (Ksh)</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Cost (Ksh)</th>
            </tr>
        </thead>

        <tbody>
            <?php $count = 1; foreach($_SESSION['shopping_cart'] as $cart_key => $cart_val) :?> <!-- $count = numbering the rows, $total = total cost of all products-->
                <tr class = "align-middle">
                    <td><?=($count)?></td>
                
                    <?php foreach($cart_val as $cart_item_key => $cart_item_val) :?>
                        <?php if($cart_item_key == "product_id") :?>
                            <td class = "hidden_cell">$cart_item_val</td>              
                        <?php else: ?>
                            <td><?=$cart_item_val?></td>                       
                        <?php endif; ?>
                    <?php endforeach; ?>
                
                    <td><?= ($cart_val['unit_price']*$cart_val['quantity']);?></td> <!-- Price * Quantity-->
                </tr>
            <?php $count++; endforeach; ?>
        </tbody>
    </table><br>

    <h3 class = "total_cost" id = "purchase_details_cost">Total Cost :  <?='Ksh. '.$total?></h3><br>
    <a href = "/user/viewPurchaseHistory" class = "btn btn-primary blue_button">VIEW PURCHASE HISTORY</a>
</div>

<?= $this -> endSection() ?>
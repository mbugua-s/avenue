<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/view_cart.css">
    <title>avenue | Purchase Receipt</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<div class = "main_content">
    <h2>Purchase History</h2>

    <?php foreach($all_purchases as $order_id => $all_orders) :?> <!-- For every order -->
        <div class = "purchase">
            <h3><?=$all_orders[0]['updated_at']?></h3>
            <h4>Total Cost : Ksh. <?=$all_orders[0]['order_amount']?></h4>
            <h4>Paid Via : Wallet</h4> <!-- Default is wallet (no other payment methods available for now)-->
            
            <table class = "table receipt_table history_table"> <!-- Every order has its own table -->
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
                    <?php $count = 1;foreach($all_orders as $order_key => $order_detail) :?> <!-- For every order detail array-->
                        <tr class = "align-middle"> <!-- Every row is an order detail -->
                            <td><?=($count)?></td> <!-- $count = numbering the rows -->

                            <?php foreach($order_detail as $order_detail_key => $order_detail_val) :?> <!-- For every order detail -->
                                <?php if($order_detail_key == "updated_at" || $order_detail_key == "order_id" || $order_detail_key == "order_amount" || $order_detail_key == "paymenttype_name"): ?>
                                    <td class = "hidden_cell"><?=$order_detail_val?></td> <!-- Hide unnecessary cells -->
                                <?php else: ?>
                                    <td><?=$order_detail_val?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tr>
                    <?php $count++; endforeach; ?>
                </tbody>
            </table><br>
        </div>
    <?php endforeach; ?>

</div>

<?= $this -> endSection() ?>
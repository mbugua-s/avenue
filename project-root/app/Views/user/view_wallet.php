<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/view_cart.css">
    <title>avenue | Your Wallet</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>


<div class = "main_content">
    <h2>Your Wallet</h2>

    <h3 class = "balance">Current Balance : Ksh. <?=$wallet_details['amount_available']?></h3>
    
    <form method = "POST" action = "/user/addMoneyToWallet" class = "add_money_form">
        <h4>Add Money To Your Wallet</h4>
        <label>Enter amount : </label>
        <input type = "number" min = "0" max = "20000" name = "wallet_add_amount"><br><br>

        <input type = "submit" value = "ADD MONEY" name = "wallet_add_submit" class = "btn btn-primary green_button">
    </form>

    <div class = "bottom_links">
        <a class = "btn btn-primary blue_button">VIEW PURCHASE HISTORY</a><br>
        <a href = "/dashboard/viewProducts" class = "btn btn-primary purple_button">GO SHOPPING</a>
    </div>
</div>

<?= $this -> endSection() ?>
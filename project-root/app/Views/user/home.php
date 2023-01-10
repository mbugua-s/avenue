<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/home.css">
    <title>avenue | Home</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Need clothes? We got you.</h2>
<a class = "get_started" href = "/user/login">Get Started</a><br><br><br><br>

<div class = "article one">
    <h3>Wide variety offered!</h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni illo temporibus iste quo qui nulla, atque fuga distinctio, 
        nobis culpa tempora, praesentium perferendis aperiam repellat ipsa unde saepe sunt quae.</p>
    <img src = "/assets/images/clothes.jpg">
</div>

<div class = "article two">            
    <h3>Not satisfied? We'll refund.</h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni illo temporibus iste quo qui nulla, atque fuga distinctio, 
        nobis culpa tempora, praesentium perferendis aperiam repellat ipsa unde saepe sunt quae.</p>
    <img src = "/assets/images/refund.jpg">
</div>

<div class = "article three">            
    <h3>Deals for days!</h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni illo temporibus iste quo qui nulla, atque fuga distinctio, 
        nobis culpa tempora, praesentium perferendis aperiam repellat ipsa unde saepe sunt quae.</p>
    <img src = "/assets/images/discount.png">
</div>

<?= $this -> endSection() ?>

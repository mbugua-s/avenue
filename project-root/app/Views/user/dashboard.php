<?= $this -> extend('layouts/main.php')?>

<?= $this -> section('css_title')?>
    <link rel = "stylesheet" href = "/assets/CSS/dashboard.css">
    <title>avenue | Dashboard</title>
<?= $this -> endSection() ?>

<?= $this -> section('content')?>

<h2>Featured Content</h2>
<div class="card mb-3" style="max-width: 1200px;">
    <div class="row g-0">
        <div class="col-md-2">
            <img src="/assets/images/november.jpg" class="img-fluid rounded-start" alt="...">
        </div>

        <div class="col-md-9">
            <div class="card-body">
                <h5 class="card-title">November 2021 Collection</h5>
                <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum enim eius fugit eaque harum repudiandae vel, quas fuga. 
                    Iure consectetur quaerat doloremque tenetur magnam explicabo, possimus placeat deserunt mollitia? Vel.</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3" style="max-width: 1200px;">
    <div class="row g-0">
        <div class="col-md-2">
            <img src="/assets/images/november.jpg" class="img-fluid rounded-start" alt="...">
        </div>

        <div class="col-md-9">
            <div class="card-body">
                <h5 class="card-title">October 2021 Collection</h5>
                <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum enim eius fugit eaque harum repudiandae vel, quas fuga. 
                    Iure consectetur quaerat doloremque tenetur magnam explicabo, possimus placeat deserunt mollitia? Vel.</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3" style="max-width: 1200px;">
    <div class="row g-0">
        <div class="col-md-2">
            <img src="/assets/images/november.jpg" class="img-fluid rounded-start" alt="...">
        </div>

        <div class="col-md-9">
            <div class="card-body">
                <h5 class="card-title">September 2021 Collection</h5>
                <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum enim eius fugit eaque harum repudiandae vel, quas fuga. 
                    Iure consectetur quaerat doloremque tenetur magnam explicabo, possimus placeat deserunt mollitia? Vel.</p>
            </div>
        </div>
    </div>
</div>

<button class = "btn">View All Clothes</button>

<?= $this -> endSection() ?>
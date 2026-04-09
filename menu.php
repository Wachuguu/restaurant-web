<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<div class="topbar">
    <a href="index.php" class="brand">🍽️ Rongai 5 Star</a>
    <a href="index.php" class="nav-home">← Home</a>
</div>

<div class="page">
<h1 style="color:white; text-align:center;">Our Menu</h1>

<div class="card-grid">

<?php
$menu = [
["name"=>"Hummus & Pita","price"=>950,"img"=>"Images/hummus&pita.jpeg"],
["name"=>"Beef Samosas","price"=>750,"img"=>"Images/beefsamosa.jpg"],
["name"=>"Hot Wings","price"=>1200,"img"=>"Images/hotwings.jpg"],
["name"=>"Fattouche Salad","price"=>900,"img"=>"Images/salad.jpg"],
["name"=>"Grilled Calamari","price"=>1500,"img"=>"Images/grilledcalamari.jpg"],
["name"=>"Ribeye Steak","price"=>3500,"img"=>"Images/ribeyesteak.jpg"],
["name"=>"Fillet Steak","price"=>2800,"img"=>"Images/filletesteak.jpg"],
["name"=>"Lamb Chops","price"=>2500,"img"=>"Images/lambchops.jpg"],
["name"=>"Pasta","price"=>2400,"img"=>"Images/pasta.jpg"],
["name"=>"Pork Ribs","price"=>2200,"img"=>"Images/porkrib.jpg"],
["name"=>"Grilled Tilapia","price"=>1800,"img"=>"Images/grilledtilapia.jpg"],
["name"=>"Prawn Curry","price"=>2600,"img"=>"Images/prawncurry.jpg"],
["name"=>"Grilled Chicken","price"=>1900,"img"=>"Images/grilledchicken.jpg"],
["name"=>"Mombasa Lobster","price"=>4500,"img"=>"Images/lobsters.jpg"],
["name"=>"Neapolitan Pizza","price"=>1600,"img"=>"Images/neopolitanpizza.jpg"],
["name"=>"Chicken Biryani","price"=>1400,"img"=>"Images/chicken biryani.jpg"],
["name"=>"Chocolate Waffle","price"=>950,"img"=>"Images/chocolatewaffle.jpg"],
["name"=>"Grilled Pineapple","price"=>700,"img"=>"Images/grilledpineapple.jpg"],
["name"=>"Passion Mocktail","price"=>500,"img"=>"Images/passionpocktail.jpg"],
["name"=>"Long Island","price"=>1600,"img"=>"Images/longisland.jpg"]
];

foreach($menu as $item){
    echo "
    <div class='food-card'>
        <div class='img-wrap'>
            <img src='{$item['img']}' alt='{$item['name']}'>
        </div>
        <div class='card-body'>
            <h3>{$item['name']}</h3>
        </div>
        <div class='card-footer'>
            <span class='price'>Ksh {$item['price']}</span>
            <a href='order.php?item=".urlencode($item['name'])."' class='btn'>Order</a>
        </div>
    </div>
    ";
}
?>

</div>
</div>

</body>
</html>

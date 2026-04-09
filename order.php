<!DOCTYPE html>
<html>
<head>
    <title>Order</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<div class="menu-container">
<h2>Place Order</h2>

<form method="POST" action="process_order.php">

<input type="text" name="name" placeholder="Your Name" required>

<select name="food" required>

<?php
$menu = [
"Hummus & Pita","Beef Samosas","Hot Wings","Fattouche Salad","Grilled Calamari",
"Ribeye Steak","Fillet Steak","Lamb Chops","pasta","Pork Ribs",
"Grilled Tilapia","Prawn Curry","Grilled Chicken","Mombasa Lobster",
"Neapolitan Pizza","Chicken Biryani","Chocolate Waffle","Grilled Pineapple",
"Passion Mocktail","Long Island"
];

$selected = $_GET['item'] ?? '';

foreach($menu as $item){
    $isSelected = ($item == $selected) ? "selected" : "";
    echo "<option value='$item' $isSelected>$item</option>";
}
?>

</select>

<input type="number" name="quantity" value="1" min="1">

<select name="payment">
    <option>M-Pesa</option>
    <option>Card</option>
    <option>Cash</option>
</select>

<button type="submit" class="btn">Confirm Order</button>

</form>
</div>

</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: menu.php");
    exit;
}

$name = $_POST['name'];
$food = $_POST['food'];
$quantity = (int)$_POST['quantity'];
$payment = $_POST['payment'];

$prices = [
    "Hummus & Pita"=>950,"Beef Samosas"=>750,"Hot Wings"=>1200,"Fattouche Salad"=>900,
    "Grilled Calamari"=>1500,"Ribeye Steak"=>3500,"Fillet Steak"=>2800,"Lamb Chops"=>2500,
    "Mbuzi Kauka"=>2400,"Pork Ribs"=>2200,"Grilled Tilapia"=>1800,"Prawn Curry"=>2600,
    "Grilled Chicken"=>1900,"Mombasa Lobster"=>4500,"Neapolitan Pizza"=>1600,
    "Chicken Biryani"=>1400,"Chocolate Waffle"=>950,"Grilled Pineapple"=>700,
    "Passion Mocktail"=>500,"Long Island"=>1600
];

if (!array_key_exists($food, $prices)) {
    die("Error: Item not found.");
}

$total = $prices[$food] * $quantity;

$stmt = $conn->prepare("INSERT INTO orders (name, food, quantity, total_price, payment_method) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $name, $food, $quantity, $total, $payment);

if (!$stmt->execute()) {
    die("ERROR: " . $stmt->error);
}

$order_id = rand(10000,99999);
$date = date("d M Y h:i A");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<div class="receipt-card">

    <div class="receipt-header">
        <h2>🧾 Rongai 5 Star</h2>
        <p>Kajiado, Kenya</p>
    </div>

    <div class="receipt-details">
        <div class="receipt-row"><span>Order ID:</span> <span class="receipt-val">#<?php echo $order_id; ?></span></div>
        <div class="receipt-row"><span>Date:</span> <span class="receipt-val"><?php echo $date; ?></span></div>
        <div class="receipt-row"><span>Name:</span> <span class="receipt-val"><?php echo htmlspecialchars($name); ?></span></div>
        <div class="receipt-row"><span>Food:</span> <span class="receipt-val"><?php echo htmlspecialchars($food); ?></span></div>
        <div class="receipt-row"><span>Qty:</span> <span class="receipt-val">x<?php echo $quantity; ?></span></div>
        <div class="receipt-row"><span>Payment:</span> <span class="receipt-val"><?php echo htmlspecialchars($payment); ?></span></div>
    </div>

    <div class="receipt-total">
        <div class="receipt-row">
            <span>TOTAL:</span>
            <span class="receipt-val">Ksh <?php echo number_format($total); ?></span>
        </div>
    </div>

    <?php if($payment == "M-Pesa" || $payment == "M-Pesa (Paybill)"): ?>
        <div class="mpesa-box">
            Paybill No: <strong>888555</strong><br>
            Account: <strong><?php echo $order_id; ?></strong>
        </div>
    <?php endif; ?>

    <div class="no-print actions">
        <button onclick="window.print()" class="btn">🖨 Print</button>
        <a href="menu.php" class="btn dark">← New Order</a>
    </div>

</div>

</body>
</html>
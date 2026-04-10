<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = trim($_POST['name']); // ✅ FIX 1: was $name, now $customer_name
    $food = $_POST['food'];
 .    $quantity = max(1, (int)$_POST['quantity']);
    $payment = $_POST['payment'];
    $prices = [
        "Hummus & Pita"=>950,"Beef Samosas"=>750,"Hot Wings"=>1200,"Fattouche Salad"=>900,
        "Grilled Calamari"=>1500,"Ribeye Steak"=>3500,"Fillet Steak"=>2800,"Lamb Chops"=>2500,
        "pasta"=>2400,"Pork Ribs"=>2200,"Grilled Tilapia"=>1800,"Prawn Curry"=>2600,
        "Grilled Chicken"=>1900,"Mombasa Lobster"=>4500,"Neapolitan Pizza"=>1600,
        "Chicken Biryani"=>1400,"Chocolate Waffle"=>950,"Grilled Pineapple"=>700,
        "Passion Mocktail"=>500,"Long Island"=>1600
    ];
    $errHeader = "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Error</title><link rel='stylesheet' href='CSS/style.css'></head><body><div class='page'>";
    $errFooter = "</div></body></html>";
    if (!array_key_exists($food, $prices)) {
        die($errHeader . "<div class='error-box'><h2>Invalid food item</h2><a href='menu.php' class='btn dark'>Go Back</a></div>" . $errFooter);
    }
    if (empty($customer_name)) { // ✅ FIX 2: was checking $customer_name but variable was $name
        die($errHeader . "<div class='error-box'><h2>Name required</h2><a href='menu.php' class='btn dark'>Go Back</a></div>" . $errFooter);
    }
    $total = $prices[$food] * $quantity;
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, items, quantity, total_price, payment_method) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssids", $customer_name, $food, $quantity, $total, $payment);
    if (!$stmt->execute()) {
        die($errHeader . "<div class='error-box'><h2>Database error</h2><p>" . htmlspecialchars($stmt->error) . "</p><a href='menu.php' class='btn dark'>Go Back</a></div>" . $errFooter);
    }
    $order_id = rand(10000,99999);
    $date = date("d M Y h:i A");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<div class="page">
    <div class="receipt-card">
        <div class="receipt-header">
            <h2>🧾 Rongai 5 Star</h2>
            <p>Kajiado, Kenya</p>
        </div>
        <div class="receipt-details">
            <div class="receipt-row"><span>Order ID</span><span>#<?php echo $order_id; ?></span></div>
            <div class="receipt-row"><span>Date</span><span><?php echo $date; ?></span></div>
            <div class="receipt-row"><span>Name</span><span><?php echo htmlspecialchars($customer_name); ?></span></div> <!-- ✅ FIX 3: was $name -->
            <div class="receipt-row"><span>Food</span><span><?php echo htmlspecialchars($food); ?></span></div>
            <div class="receipt-row"><span>Qty</span><span>x<?php echo $quantity; ?></span></div>
            <div class="receipt-row"><span>Payment</span><span><?php echo htmlspecialchars($payment); ?></span></div>
        </div>
        <div class="receipt-total">
            <div class="receipt-row">
                <strong>Total</strong>
                <strong>Ksh <?php echo number_format($total); ?></strong>
            </div>
        </div>
        <?php if($payment == "M-Pesa"): ?>
        <div class="mpesa-box">
            Paybill: <strong>888555</strong><br>
            Account: <strong><?php echo $order_id; ?></strong>
        </div>
        <?php endif; ?>
        <div class="no-print actions">
            <button onclick="window.print()" class="btn">🖨 Print</button>
            <a href="menu.php" class="btn dark">← New Order</a>
        </div>
    </div>
</div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>

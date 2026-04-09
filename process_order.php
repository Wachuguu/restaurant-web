<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    // 1. Restored the safety check to prevent fatal calculation errors
    if (array_key_exists($food, $prices)) {
        
        $total = $prices[$food] * $quantity;

        // 2. Your excellent prepared statement security
        $stmt = $conn->prepare("INSERT INTO orders (name, food, quantity, total_price, payment_method) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $name, $food, $quantity, $total, $payment);

        if (!$stmt->execute()) {
            die("ERROR: " . $stmt->error);
        }

        $order_id = rand(10000,99999);
        $date = date("d M Y h:i A");
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Receipt #<?php echo $order_id; ?></title>
            <link rel="stylesheet" href="CSS/style.css">
            <style>
                /* Restored the Flexbox layout so the receipt text aligns perfectly */
                .receipt-row {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 8px;
                }
                .receipt-val {
                    font-weight: bold;
                }
            </style>
        </head>
        <body>

        <div class="receipt-card">
            <div class="receipt-header">
                <h2>🧾 Rongai 5 Star</h2>
                <p style="margin: 5px 0; color: #666;">Kajiado, Kenya</p>
            </div>
            
            <div class="receipt-details">
                <div class="receipt-row"><span>Order ID:</span> <span class="receipt-val">#<?php echo $order_id; ?></span></div>
                <div class="receipt-row"><span>Date:</span> <span class="receipt-val"><?php echo $date; ?></span></div>
                <div class="receipt-row"><span>Name:</span> <span class="receipt-val"><?php echo htmlspecialchars($name); ?></span></div>
                <div class="receipt-row"><span>Food:</span> <span class="receipt-val"><?php echo htmlspecialchars($food); ?></span></div>
                <div class="receipt-row"><span>Qty:</span> <span class="receipt-val">x<?php echo $quantity; ?></span></div>
                <div class="receipt-row"><span>Payment:</span> <span class="receipt-val"><?php echo htmlspecialchars($payment); ?></span></div>
            </div>
            
            <div class="receipt-details receipt-total">
                <div class="receipt-row" style="font-size: 1.2rem; padding-top: 10px;">
                    <span>TOTAL:</span> 
                    <span class="receipt-val" style="color: #c0392b;">Ksh <?php echo number_format($total); ?></span>
                </div>
            </div>

            <?php if($payment == "M-Pesa" || $payment == "M-Pesa (Paybill)"): ?>
                <div style="background: #f8f9fa; padding: 15px; text-align: center; border: 1px solid #ddd; margin: 20px 0; border-radius: 5px; color: #333;">
                    <strong>M-Pesa Instructions:</strong><br>
                    Paybill No: <strong>888555</strong><br>
                    Account No: <strong><?php echo $order_id; ?></strong><br>
                </div>
            <?php endif; ?>

            <div class="no-print" style="text-align: center; margin-top: 30px;">
                <button onclick="window.print()" class="btn" style="margin-bottom: 15px;">🖨 Print</button>
                <a href="menu.php" class="btn" style="background: #333; color: white;">← New Order</a>
            </div>
        </div>

        </body>
        </html>

        <?php 
    } else {
        echo "Error: That item is not on the menu.";
    }
} else {
    echo "Please submit the order form properly.";
}

$stmt->close();
$conn->close();
?>
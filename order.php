<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order - Rongai 5 Star</title>
    <link rel="stylesheet" href="CSS/style.css?v=3.0"> 
</head>
<body>

<div class="page">
    <div class="menu-container form-card">
        
        <div class="receipt-header">
            <h2>🍽️ Place Your Order</h2>
            <p>Complete your details below</p>
        </div>

        <form method="POST" action="process_order.php">

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="e.g., Paul" required>
            </div>

            <div class="form-group">
                <label for="food">Select Item</label>
                <select id="food" name="food" required>
                <?php
                $menu = [
                    "Hummus & Pita","Beef Samosas","Hot Wings","Fattouche Salad","Grilled Calamari",
                    "Ribeye Steak","Fillet Steak","Lamb Chops","Mbuzi Kauka","Pork Ribs",
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
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" required>
                </div>

                <div class="form-group half">
                    <label for="payment">Payment Method</label>
                    <select id="payment" name="payment" required>
                        <option value="M-Pesa">M-Pesa</option>
                        <option value="Card">Card</option>
                        <option value="Cash">Cash</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-submit">Confirm Order</button>

        </form>
    </div>
</div>

</body>
</html>
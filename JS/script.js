

document.addEventListener('DOMContentLoaded', function() {
    const orderForm = document.getElementById('orderForm');

   
    if (orderForm) {
        orderForm.addEventListener('submit', function(event) {
            
   
            const foodItem = document.getElementById('food').value;
            const quantity = document.getElementById('quantity').value;
            const paymentMethod = document.getElementById('payment').value;
            
   
            const confirmMessage = `Are you sure you want to place this order?\n\nItem: ${foodItem}\nQuantity: ${quantity}\nPayment: ${paymentMethod}`;
            
   
            const isConfirmed = confirm(confirmMessage);
            
   
            if (!isConfirmed) {
                event.preventDefault();
            }
        });
    }
});
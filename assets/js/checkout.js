document.addEventListener("DOMContentLoaded", () => {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const shippingCost = 15;
    let totalPrice = 0;
  
    cart.forEach(item => {
        totalPrice += parseFloat(item.price) * item.quantity;
    });
  
    document.getElementById("summary-products").textContent = totalPrice.toFixed(2) + " €";
    document.getElementById("summary-total").textContent = (totalPrice + shippingCost).toFixed(2) + " €";
  
    // Confirm and Pay (temporary logic)
    document.getElementById("checkout-form").addEventListener("submit", function (e) {
        e.preventDefault();
      
      
        // Redirect to confirmation page
        window.location.href = "../pages/confirmation.html";
      });     
});
  
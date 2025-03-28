document.addEventListener("DOMContentLoaded", () => {
    const cartItemsContainer = document.getElementById("cart-items");
  
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
  
    function renderCart() {
        cartItemsContainer.innerHTML = "";
        let totalPrice = 0;
        const shippingCost = 15;
  
        cart.forEach((item, index) => {
        const itemTotal = parseFloat(item.price) * item.quantity;
        totalPrice += itemTotal;
  
        const div = document.createElement("div");
        div.classList.add("cart-item");
  
        div.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <div class="cart-item-info">
                <h3>${item.name}</h3>
                <p class="details">Size: ${item.size}</p>
                <div class="quantity-controls">
                    <button onclick="updateQuantity(${index}, -1)">–</button>
                    <input type="number" min="1" value="${item.quantity}" onchange="setQuantity(${index}, this.value)">
                    <button onclick="updateQuantity(${index}, 1)">+</button>
                </div>
                <p><strong>${itemTotal.toFixed(2)} €</strong></p>
            </div>
            <button class="remove-btn" onclick="removeItem(${index})">×</button>
            `;
  
        cartItemsContainer.appendChild(div);
        });
  
        // Update summary
        document.getElementById("summary-products").textContent = totalPrice.toFixed(2) + " €";
        document.getElementById("summary-total").textContent = (totalPrice + shippingCost).toFixed(2) + " €";
    }
  
    // Quantity up/down
    window.updateQuantity = (index, change) => {
        cart[index].quantity += change;
        if (cart[index].quantity < 1) cart[index].quantity = 1;
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
    };
  
    // Quantity by typing
    window.setQuantity = (index, value) => {
        const val = parseInt(value);
        if (!isNaN(val) && val >= 1) {
            cart[index].quantity = val;
            localStorage.setItem("cart", JSON.stringify(cart));
            renderCart();
        }
    };
  
    // Remove item
    window.removeItem = (index) => {
        cart.splice(index, 1);
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
    };
  
    renderCart();
});
  
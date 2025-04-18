document.addEventListener("DOMContentLoaded", () => {
    const itemsContainer = document.getElementById("confirmation-items");
    const totalEl = document.getElementById("confirmation-total");
  
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const shipping = 15;
    let total = 0;
  
    itemsContainer.innerHTML = "";
  
    cart.forEach(item => {
      const itemTotal = parseFloat(item.price) * item.quantity;
      total += itemTotal;
  
      const itemEl = document.createElement("div");
      itemEl.classList.add("confirmation-item");
  
      itemEl.innerHTML = `
        <img src="${item.image}" alt="${item.name}">
        <div class="confirmation-item-details">
          <p><strong>${item.name}</strong></p>
          <p>Size: ${item.size}</p>
          <p>Quantity: ${item.quantity}</p>
          <p>Subtotal: ${itemTotal.toFixed(2)} €</p>
        </div>
      `;
  
      itemsContainer.appendChild(itemEl);
    });
  
    totalEl.textContent = (total + shipping).toFixed(2) + " €";
  
    // Clear cart so user doesn't double order
    localStorage.removeItem("cart");
});
  
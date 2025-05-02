document.addEventListener("DOMContentLoaded", () => {
    const cartItemsContainer = document.getElementById("cart-items");
    const shippingCost = 15;
    const loggedIn = sessionStorage.getItem('loggedIn') === 'true';
  
    let cart = [];      // will fill later
  
    
    function render() {
      cartItemsContainer.innerHTML = "";
      let total = 0;
  
      cart.forEach((item, idx) => {
        const line = item.price * item.quantity;
        total += line;
  
        const div = document.createElement("div");
        div.className = "cart-item";
        div.innerHTML = `
          <img src="../${item.image}" alt="${item.name}">
          <div class="cart-item-info">
            <h3>${item.name}</h3>
            <p class="details">Size: ${item.size}</p>
            <div class="quantity-controls">
              <button onclick="updateQty(${idx},-1)">–</button>
              <input type="number" min="1" value="${item.quantity}" onchange="setQty(${idx},this.value)">
              <button onclick="updateQty(${idx},1)">+</button>
            </div>
            <p><strong>${line.toFixed(2)} €</strong></p>
          </div>
          <button class="remove-btn" onclick="removeItem(${idx})">×</button>`;
        cartItemsContainer.appendChild(div);
      });
  
      document.getElementById("summary-products").textContent = total.toFixed(2) + " €";
      document.getElementById("summary-total").textContent = (total + shippingCost).toFixed(2) + " €";
    }
  
    /* ---------------- Manipulation helpers ---------------- */
    window.updateQty = (index, change) => {
      cart[index].quantity = Math.max(1, cart[index].quantity + change);
      persist(cart[index]);
    };
  
    window.setQty = (index, value) => {
      const v = parseInt(value);
      if (!isNaN(v) && v >= 1) {
        cart[index].quantity = v;
        persist(cart[index]);
      }
    };
  
    window.removeItem = (index) => {
      const item = cart[index];
      cart.splice(index,1);
      if (loggedIn) dbDelete(item); else saveLocal();
      render();
    };
  
    /* ---------------- Persistence ---------------- */
    function persist(item) {
      if (loggedIn) dbUpsert(item);
      else saveLocal();
      render();
    }
  
    function saveLocal() {
      localStorage.setItem('cart', JSON.stringify(cart));
    }
  
    /* ---------- DB calls ---------- */
    function dbUpsert(item) {
      fetch('../pages/cart-update.php', {
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({action:'upsert', item})
      });
    }
    function dbDelete(item) {
      fetch('../pages/cart-update.php', {
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({action:'delete',
              product_id:item.product_id, size:item.size})
      });
    }
  
    /* ---------- Initial load ---------- */
    (async () => {
      if (loggedIn) {
        const res = await fetch('../pages/cart-fetch.php');
        if (res.ok) cart = await res.json();
        else cart = [];         // fallback
      } else {
        cart = JSON.parse(localStorage.getItem('cart')) || [];
      }
      render();
    })();
  });
  
/* 
 * Shared helpers
 */
function switchImage(thumbnail) {
  document.getElementById("mainImage").src = thumbnail.src;
}

function changeQuantity(amount) {
  const qtyEl  = document.getElementById("quantity");
  let current  = parseInt(qtyEl.textContent);
  if (!isNaN(current)) qtyEl.textContent = Math.max(1, current + amount);
}

/* 
 * Add-to-Cart handler
 */
function handleAddToCart() {
  const selectedSize   = document.getElementById("size").value;
  const selectedQty    = parseInt(document.getElementById("quantity").textContent);
  const loggedIn       = sessionStorage.getItem("loggedIn") === "true";

  // Build the cart item object the same way everywhere
  const product = {
    product_id : productData.id,
    name       : productData.name,
    price      : parseFloat(productData.price),
    size       : selectedSize,
    quantity   : selectedQty,
    image      : "../" + productData.img
  };

  /* ---- Persist ---- */
  if (loggedIn) {
    // Send to DB (creates or updates)
    fetch("../pages/cart-update.php", {
      method : "POST",
      headers: { "Content-Type": "application/json" },
      body   : JSON.stringify({ action: "upsert", item: product })
    }).catch(console.error);
  } else {
    // Guest → localStorage
    const local = JSON.parse(localStorage.getItem("cart") || "[]");
    local.push(product);
    localStorage.setItem("cart", JSON.stringify(local));
  }

  /* ---- Show slide-in panel ---- */
  openCartPanel(product);
}

/* 
 * Slide-in side panel
 */
function openCartPanel(item) {
  document.getElementById("cart-thumb").src           = item.image;
  document.getElementById("cart-name").textContent    = item.name;
  document.getElementById("cart-size").textContent    = "Size: " + item.size;
  document.getElementById("cart-price").textContent   =
        item.price.toFixed(2) + " € ×" + item.quantity;

  const panel = document.getElementById("cart-panel");
  panel.classList.remove("hidden");
  panel.classList.add("visible");
}

function closeCartPanel() {
  document.getElementById("cart-panel").classList.remove("visible");
}

/* Remove-item button inside the panel (guest only for now) */
document.querySelector(".remove-item-btn").addEventListener("click", () => {
  const local = JSON.parse(localStorage.getItem("cart") || "[]");
  local.pop();                       // simplistic: removes last
  localStorage.setItem("cart", JSON.stringify(local));
  closeCartPanel();
});





function switchImage(thumbnail) {
  document.getElementById("mainImage").src = thumbnail.src;
}

function changeQuantity(amount) {
  const quantityEl = document.getElementById("quantity");
  let current = parseInt(quantityEl.textContent);
  if (!isNaN(current)) {
    const newQty = Math.max(1, current + amount);
    quantityEl.textContent = newQty;
  }
}

function handleAddToCart() {
  const selectedSize = document.getElementById("size").value;
  const selectedQuantity = parseInt(document.getElementById("quantity").textContent);

  const product = {
    name: "Predator Elite FT FG Football Boots",
    price: "279.99",
    size: selectedSize,
    quantity: selectedQuantity,
    image: "../assets/img/product-details/bota-adidas-predator-elite-ft-fg-black-white-red-1.webp"
  };

  openCartPanel(product);
}

function openCartPanel(product) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  cart.push(product);
  localStorage.setItem("cart", JSON.stringify(cart));

  document.getElementById("cart-thumb").src = product.image;
  document.getElementById("cart-name").textContent = product.name;
  document.getElementById("cart-size").textContent = "Size: " + product.size;
  document.getElementById("cart-price").textContent = product.price + " € ×" + product.quantity;

  document.getElementById("cart-panel").classList.remove("hidden");
  document.getElementById("cart-panel").classList.add("visible");
}

function closeCartPanel() {
  document.getElementById("cart-panel").classList.remove("visible");
}






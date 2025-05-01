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
    id:    productData.id,
    name:  productData.name,
    price: productData.price,
    size:  selectedSize,
    quantity: selectedQuantity,
    image: "../" + productData.img
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

document.querySelector(".remove-item-btn").addEventListener("click", function () {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  // For now, just remove the last item added (you only have one product anyway)
  cart.pop();

  localStorage.setItem("cart", JSON.stringify(cart));

  // Hide the panel
  closeCartPanel();
});





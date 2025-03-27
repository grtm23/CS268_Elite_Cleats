function switchImage(thumbnail) {
    const main = document.getElementById("mainImage");
    main.src = thumbnail.src;
}
  
  function changeQuantity(amount) {
    const quantityElement = document.getElementById("quantity");
    let current = parseInt(quantityElement.textContent);
    let newQty = current + amount;
    if (newQty >= 1) {
      quantityElement.textContent = newQty;
    }
}

function openCartPanel(product) {
  // Save to localStorage
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  cart.push(product);
  localStorage.setItem("cart", JSON.stringify(cart));

  // Fill in popup info
  document.getElementById("cart-thumb").src = product.image;
  document.getElementById("cart-name").textContent = product.name;
  document.getElementById("cart-size").textContent = "Size: " + product.size;
  document.getElementById("cart-price").textContent = product.price + " €";

  // Show the panel
  document.getElementById("cart-panel").classList.add("visible");
  document.getElementById("cart-panel").classList.remove("hidden");
}

function closeCartPanel() {
  document.getElementById("cart-panel").classList.remove("visible");
}

function handleAddToCart() {
  const selectedSize = document.getElementById("size").value;

  const product = {
    name: "Predator Elite FT FG Football Boots",
    price: "279.99",
    size: selectedSize,
    image: "../assets/img/product-details/bota-adidas-predator-elite-ft-fg-black-white-red-1.webp"
  };

  openCartPanel(product);
}


document.querySelector(".remove-item-btn").addEventListener("click", function () {
  // Remove item from localStorage and UI
});

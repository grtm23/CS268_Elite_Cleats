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
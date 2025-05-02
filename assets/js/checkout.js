// Only small enhancement – confirmation pop-up
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("checkout-form").addEventListener("submit", e => {
      if (!confirm("Place order now?")) e.preventDefault();
    });
  });
  
  
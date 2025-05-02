window.addEventListener("DOMContentLoaded", () => {
  fetch("../components/navbar.php")   // ← changed
    .then(res => res.text())
    .then(data => document.getElementById("navbar").innerHTML = data);

  fetch("../components/footer.html")
    .then(res => res.text())
    .then(data => document.getElementById("footer").innerHTML = data);
});

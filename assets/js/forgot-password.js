document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("resetForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const email = document.getElementById("email").value.trim();

    if (email) {
        // Simulate confirmation – replace with PHP logic later
        alert(`If an account with ${email} exists, a reset link has been sent.`);
        window.location.href = "login.html";
    }
    });
});
  
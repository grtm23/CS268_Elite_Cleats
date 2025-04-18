// Toggle admin panel sections
function showSection(id) {
    document.querySelectorAll('.admin-section').forEach(section => {
      section.style.display = 'none';
    });
    document.getElementById(id).style.display = 'block';
  }
  

  
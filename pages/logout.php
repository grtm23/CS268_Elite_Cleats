<?php
session_start();
session_unset();
session_destroy();

// Also clear the JS flag for cart sync
echo "<script>
        sessionStorage.removeItem('loggedIn');
        sessionStorage.removeItem('userId');
        window.location = '../index.php';
      </script>";

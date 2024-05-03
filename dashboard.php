<?php
if (isset($_POST['admin_login'])) {
    header("Location: adminlogin.html");
    exit();
} elseif (isset($_POST['user_login'])) {
    header("Location: loginpage.html");
    exit();
} elseif (isset($_POST['data_provider_login'])) {
    header("Location: dplogin.html");
    exit();
} else {
    // Handle invalid requests or direct access to this page
    echo "Invalid request";
}
?>

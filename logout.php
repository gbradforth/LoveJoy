<?php
session_start();

if (isset($_SESSION['username'])) {
    session_destroy();

    header('Location: complexLoginForm.php');
    exit;
}
else {
    header('Location: complexLoginForm.php');
    exit;
}
?>
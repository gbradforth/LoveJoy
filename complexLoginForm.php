<?php
session_start();

echo "<head>";
echo "<link rel='stylesheet' href='./style.css' type='text/css' media='all' />";
echo "<script src='https://www.hCaptcha.com/1/api.js' async defer></script>";
echo "</head>";
echo "<h1><a href='index.php'>Lovejoy</a></h1>";

if (isset($_SESSION['username'])) {
    // User is logged in, so display their username
    echo "Hello, " . $_SESSION['username'] . "!";
    echo "<br /><a href=addItem.php>Home</a>";
}
else
{
    echo "<form action='complexLoginCheck.php' method='POST'>";
    echo "<h2> Log in </h2>";
    echo "Username";
    echo "<input name='txtUsername' type='text' required/>";
    echo "<br /> Password";
    echo "<input name='txtPassword' type='password'required/>";
    echo "<br /> <input type='submit' value='Login'>";
    echo "<a href='recoverForm.php'>Forgot password?</a>";
    
    echo "<div class='h-captcha' data-sitekey='6f9bf6f5-3b4a-4691-a3a6-93b0ee9b4718'></div>";
    echo "<br /><br />Not Registered Yet? Click <a href='registerForm.php'>HERE</a>";
    echo "</form>";
}
?>
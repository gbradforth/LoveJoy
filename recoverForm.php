<?php
echo "<link rel='stylesheet' href='./style.css' type='text/css' media='all' />";
echo "<h1><a href='index.php'>Lovejoy</a></h1>";
echo "<form action='recoverCheck.php' method='POST'>";
echo "<h2> Recover Password </h2>";
echo "Email:";
echo "<input name='txtEmail' type='text' required/>";
echo "<br /> <input type='submit' value='Reset password'>";
echo "</form>";
?>
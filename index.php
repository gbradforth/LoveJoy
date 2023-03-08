<?php

session_start();

echo "<link rel='stylesheet' href='./style.css' type='text/css' media='all' />";
echo "<h1><a href='index.php'>Lovejoy</a></h1>";

echo "<label>To add an item for evaluation,</label>";
echo "<a href='addItem.php'>Click Here!</a>";
if (isset($_SESSION['username'])){
    echo "<p> <a href='logout.php'>Logout</a> </p>";
    if ($_SESSION['user_id'] == "1")
    {
        echo "<a href='requestList.php'>Request List</a>";
    }
}
else
{
    echo "<p> <a href='complexLoginForm.php'>Login</a> </p>";
}
?>
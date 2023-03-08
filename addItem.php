<?php
session_start();

echo "<link rel='stylesheet' href='./style.css' type='text/css' media='all' />";
echo "<h1><a href='index.php'>Lovejoy</a></h1>";
echo "<h2>Evaluation Page</h2>";
if (isset($_SESSION['username'])){
    echo "<h3>Please use the form below to describe the product you wish to have evaluated.</h3>";
    echo "<form method='post' action='addItemCheck.php' ENCTYPE = 'multipart/form-data' >";
    echo "<label>Item Name</label>";
    echo "<input type='text' name='itemname' required>";
    echo "<br/><label>Description</label>";
    echo "<input type='text' name='description'>";
    echo "<br/>Prefered method of contact";
    echo "  <select name='contact' id='contact'>
                <option value='phone'>Phone</option>
                <option value='email'>Email</option>
            </select>";
	echo "<br/><input type='file' name='myfile' accept=''><br>";
    
    $token = $_SESSION['token'];
    $escaped_token = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

    echo "<input type='hidden' name='token' value='$escaped_token'>";

    echo "<button type='submit' value='upload' class='btn' name='addItem'>Submit</button>";
    echo "</form>";
}
else{
    echo "Please <a href='complexLoginForm.php'>log in</a>";
}
?>
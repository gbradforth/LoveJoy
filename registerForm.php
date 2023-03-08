<?php
echo "<link rel='stylesheet' href='./style.css' type='text/css' media='all' />";
echo "<h1><a href='index.php'>Lovejoy</a></h1>";
echo "<form action='registerFormCheck.php' method='POST'>";
echo "<h2> Please register your details below: </h3>";
echo "Type in your Username";
echo "      <input name='txtUsername' type='text' required/>";
echo "<br/>Type in your Email address";
echo "      <input name='txtEmail1' type='text' required/>";
echo "<br/>Type your email address again";
echo "      <input name='txtEmail2' type='text' required/>";
echo "<br/>Type your phone number";
echo "      <input name='txtPhone' type='text' required/>";
echo "<br/>Type in your password";
echo "      <input name='txtPassword1' type='password' required/>";
echo "<br/>Type your password again";
echo "      <input name='txtPassword2' type='password' required/>";
echo "<br/>Security Question";
echo "  <select name='securityQ' id='question'>
            <option value='mother'>What is your mother's maiden name?</option>
            <option value='car'>What was the make of your first car?</option>
            <option value='concert'>What was the first concert you attended?</option>
            <option value='parents'>In what city or town did your parents meet?</option>
        </select>";
echo "<br/> Answer";
echo "      <input name='securityA' type='text' required/>";
echo "<br/> <input type='submit' value='Register'>";
echo "</form>";
?>
<?php
$mysql_host="localhost";
$mysql_database="id19950772_loginsignup";
$mysql_user="id19950772_root";
$mysql_password="Z2}9Unor%SnjfxG&";

$connection = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die ("could not connect to database");
echo "<link rel='stylesheet' href='./style.css' type='text/css' media='all' />";
echo "<h1><a href='index.php'>Lovejoy</a></h1>";

$username = strip_tags(mysqli_real_escape_string($connection, trim($_POST['txtUsername'])));
$email1 = mysqli_real_escape_string($connection, trim($_POST['txtEmail1']));
$email2 = mysqli_real_escape_string($connection, trim($_POST['txtEmail2']));
$phone = mysqli_real_escape_string($connection, trim($_POST['txtPhone']));
$password1 = mysqli_real_escape_string($connection, trim($_POST['txtPassword1']));
$password2 = mysqli_real_escape_string($connection, trim($_POST['txtPassword2']));
$question = $_POST['securityQ'];
$answer = mysqli_real_escape_string($connection, trim($_POST['securityA']));

$errorOccurred = 0;

if ($username == "")
{
    echo "Username was blank! <br/>";
    $errorOccurred = 1;
}

if ($email1 == "" OR $email2 == "")
{
    echo "Email not provided! <br/>";
    $errorOccurred = 1;
}

if ($phone == "")
{
    echo "Phone number not provided! <br/>";
    $errorOccurred = 1;
}

if ($password1 == "" OR $password2 == "")
{
    echo "Password empty.";
    $errorOccurred = 1;
}

if ($answer == "")
{
    echo "Answer empty.";
    $errorOccurred = 1;
}

$userResult = $connection -> query("SELECT * FROM SystemUser");

while ($userRow = mysqli_fetch_array($userResult))
{
    if ($userRow['Username'] == $username)
    {
        echo "The username has already been used! <br />";
        $errorOccurred = 1;
    }
}

while ($userRow = mysqli_fetch_array($userResult))
{
    if ($userRow['Email'] == $email1)
    {
        echo "This email address has already been used. <br/>";
        $errorOccurred = 1;
    }
}

if (strlen($phone) != 10)
{
    echo "The phone number is not valid. <br/>";
    $errorOccurred = 1;
}

if (strpos($email1, "@") == false OR strpos($email2,"@") == false)
{
    echo "The email address is not valid. <br/>";
    $errorOccurred = 1;
}

if ($email1 != $email2)
{
    echo "Emails do not match <br/>";
    $errorOccurred = 1;
}

if (strcmp($password1,$password2) !== 0)
{
    echo "Passwords do not match <br/>";
    $errorOccurred = 1;
}

if (strlen($password1) < 8 OR !preg_match('/[A-Z]/', $password1) OR !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password1) OR !preg_match('/[0-9]/', $password1))
{
    echo "Passwords must contain at least 8 characters, at least one uppercase character, a special character and a numerical character";
    $errorOccurred = 1;
}

if ($errorOccurred == 0)
{
    $password1 = password_hash($password1,PASSWORD_DEFAULT);
    $answer = password_hash($answer,PASSWORD_DEFAULT);
    $sql = "INSERT INTO SystemUser (Username, Password, Email,Phone,Question,Answer) VALUES ('$username', '$password1', '$email1','$phone','$question','$answer')";
    if ($connection -> query($sql) == TRUE)
    {
        echo "Hello " .$username . "<br />";
        echo "Thank you for joining Lovejoy.";
        echo "<a href='complexLoginForm.php'>Return to login</a>";
    }
}

?>
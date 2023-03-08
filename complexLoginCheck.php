<?php
$servername = "localhost";
$rootUser = "id19950772_root";
$db="id19950772_loginsignup";
$rootPassword="Z2}9Unor%SnjfxG&";

$conn = mysqli_connect($servername, $rootUser, $rootPassword, $db) or die('Error connecting to MySQL server');
session_start();

$username = strip_tags(mysqli_real_escape_string($conn, trim($_POST['txtUsername'])));
$password = mysqli_real_escape_string($conn, trim($_POST['txtPassword']));;

$userQuery = "SELECT * FROM SystemUser";
$userResult = $conn->query($userQuery);

echo "<link rel='stylesheet' href='./style.css' type='text/css' media='all' />";
echo "<h1><a href='index.php'>Lovejoy</a></h1>";

$userFound = 0;

$data = array(
            'secret' => "0x7Ae64066aC23C0F4f21BFcC3c8288531Fc4F8Ea3",
            'response' => $_POST['h-captcha-response']
        );
$verify = curl_init();
curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
curl_setopt($verify, CURLOPT_POST, true);
curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($verify);
// var_dump($response);
$responseData = json_decode($response);

if($responseData->success) {
    echo "<table border = '1'>";
    if ($userResult -> num_rows > 0)
    {
        while ($userRow = $userResult -> fetch_assoc())
        {
            if ($userRow['Username'] == $username)
            {
                $userFound = 1;
                if (password_verify($password,$userRow['Password']))
                {
                    $_SESSION['user_id'] = $userRow['ID']; 
                    $_SESSION['username'] = $userRow['Username']; 
                    $_SESSION['token'] = bin2hex(random_bytes(35));
                
                    echo "Hi " . $username . "!";
                    echo "<br /> Welcome to Lovejoy.";
                    echo "<br /><a href=index.php>Home</a>";
                    
                }
                else
                {
                    echo "Wrong Password";
                }
            }
        }
    }
    echo "</table>";

    if ($userFound == 0)
    {
        echo "This user was not found in our database";
    }
} 
else {
   // return error to user; they did not pass
   echo "Captcha not completed";
}

?>
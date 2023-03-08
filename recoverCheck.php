<?php
$servername = "localhost";
$rootUser = "id19950772_root";
$db="id19950772_loginsignup";
$rootPassword="Z2}9Unor%SnjfxG&";

$conn = mysqli_connect($servername, $rootUser, $rootPassword, $db) or die('Error connecting to MySQL server');
echo "<link rel='stylesheet' href='./style.css' type='text/css' media='all' />";
echo "<h1><a href='index.php'>Lovejoy</a></h1>";

$email = mysqli_real_escape_string($conn,trim($_POST['txtEmail']));
$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);

define('ABS_URL', 'https://l0v3j0y.000webhostapp.com/');
$url = sprintf('%sreset.php?%s', ABS_URL, http_build_query([
    'selector' => $selector,
    'validator' => bin2hex($token)
]));

$expires = new DateTime('NOW');
$expires->add(new DateInterval('PT01H')); // 1 hour

$userQuery = "SELECT * FROM SystemUser";
$userResult = $conn->query($userQuery);

$userFound = 0;
if ($userResult -> num_rows > 0)
{
    while ($userRow = $userResult -> fetch_assoc())
    {
        if ($userRow['Email'] == $email)
        {
            $userFound = 1;
            
            $query = "DELETE FROM PasswordReset WHERE Email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();

            $hash = hash('sha256', $token);
            $timestamp = $expires->format('U');
            // Insert reset token into database
            $query = "INSERT INTO PasswordReset (Email, Selector, Token, Expires) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssi',$email,$selector,$hash,$timestamp);
            $stmt->execute();
            
            // Send the email
            $to = $email;
            
            // Subject
            $subject = 'Your password reset link';
            
            // Message
            $message = '<p>We recieved a password reset request. The link to reset your password is below. ';
            $message .= 'If you did not make this request, you can ignore this email</p>';
            $message .= '<p>Here is your password reset link:</br>';
            $message .= sprintf('<a href="%s">%s</a></p>', $url, $url);
            $message .= '<p>Thanks!</p>';
            
            // Headers
            $headers = "From: " . "Gwen" . " <" . "gcb28@sussex.ac.uk" . ">\r\n";
            $headers .= "Reply-To: " . "gcb28@sussex.ac.uk" . "\r\n";
            $headers .= "Content-type: text/html\r\n";
            
            // Send email
            $sent = mail($to, $subject, $message, $headers);
            
            echo "Email sent";
        }
    }
}
else
{
    echo "Error";
}

if ($userFound == 0)
{
    echo "No such email in our database.";
}

?>
<?php
$servername = "localhost";
$rootUser = "id19950772_root";
$db="id19950772_loginsignup";
$rootPassword="Z2}9Unor%SnjfxG&";

$connection = mysqli_connect($servername, $rootUser, $rootPassword, $db) or die('Error connecting to MySQL server');
session_start();
echo "<link rel='stylesheet' href='./style.css' type='text/css' media='all' />";
echo "<h1><a href='index.php'>Lovejoy</a></h1>";

$token = $_POST['token'];
if (!$token OR $token !== $_SESSION['token']) {
    echo "Token error";
    exit;
}
if(isset($_SESSION['username'])){
    $id = $_SESSION['user_id'];
    $name = strip_tags(mysqli_real_escape_string($connection, trim($_POST['itemname'])));
    $description = strip_tags(mysqli_real_escape_string($connection, trim($_POST['description'])));
    
    if (isset($_FILES['myfile']) && $_FILES['myfile'] != ""){
        $file = $_FILES['myfile'];
        $filepath = $_FILES['myfile']['tmp_name'];
        $fileSize = filesize($filepath);
        if ($fileSize== 0){
            $file = 'empty';
        }
        else{
            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $filetype = finfo_file($fileinfo, $filepath);
            $allowedTypes = [
               'image/png' => 'png',
               'image/jpeg' => 'jpg'
            ];
            if(!in_array($filetype, array_keys($allowedTypes))) {
               die("File not allowed.");
            }
        }
    }
    else
    {
        $file = 'empty';
    }
    
    $contact = $_POST['contact'];
    
    $errorOccurred = 0;
    
    if ($name == "")
    {
        echo "Name was blank! <br/>";
        $errorOccurred = 1;
    }
    
    if ($errorOccurred == 0)
    {
        $sql = "INSERT INTO Requests(userID, Name, Description,File,Contact) VALUES (?,?,?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('issbs',$id,$name,$description,$file,$contact);
        
        if ($stmt->execute() === TRUE)
        {
            echo "Thank you for submitting a request.";
            echo "<a href='index.php'>Return to home</a>";
        }
        else{
            echo "Failed";
        }
    }
}
else{
    header('Location: complexLoginForm.php');
}

?>
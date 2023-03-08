<?php
$servername = "localhost";
$rootUser = "id19950772_root";
$db="id19950772_loginsignup";
$rootPassword="Z2}9Unor%SnjfxG&";

$conn = mysqli_connect($servername, $rootUser, $rootPassword, $db) or die('Error connecting to MySQL server');
session_start();
echo "<link rel='stylesheet' href='./style.css' type='text/css' media='all' />";
echo "<h1><a href='index.php'>Lovejoy</a></h1>";
echo "<h2>Evaluation Page</h2>";

if (isset($_SESSION['user_id']) == 1){
    echo "<h3>List of requests for evaluation.</h3>";
    
    $userQuery = "SELECT * FROM Requests";
    $userResult = $conn->query($userQuery);
    
    echo "<table>";
    echo "<tr><th>ID</th><th>userID</th><th>Name</th><th>Description</th><th>Contact</th></tr>";
    if ($userResult -> num_rows > 0)
    {
        while ($userRow = $userResult -> fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . $userRow['ID'] . "</td>";
            echo "<td>" . $userRow['userID'] . "</td>";
            echo "<td>" . $userRow['Name'] . "</td>";
            echo "<td style='text-align:center;'>" . $userRow['Description'] . "</td>";
            echo "<td>" . $userRow['Contact'] . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    
}
else{
    echo "How did you get here. You are not the admin.";
}
?>
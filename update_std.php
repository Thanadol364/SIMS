

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "students";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $en_name = $_POST["en_name"];
    $en_surname = $_POST["en_surname"];
    $th_name = $_POST["th_name"];
    $th_surname = $_POST["th_surname"];
    $major_code = $_POST["major_code"];
    $email = $_POST["email"];

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }

    $sql = "UPDATE `std_info` SET `en_name`='$en_name', `en_surname`='$en_surname', `th_name`='$th_name', `th_surname`='$th_surname', `major_code`='$major_code', `email`='$email' WHERE `id`='$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<div style="text-align: center; background-color: #4CAF50; padding: 10px; border-radius: 5px; color: #fff;">';
        echo '<p style="font-size: 18px;">Record with ID ' . $id . ' has been updated successfully!</p>';
        echo '<a href="student.php" style="text-decoration: none; background-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 16px; margin-top: 10px; display: inline-block;">Back</a>';
        echo '</div>';
    } else {
        echo '<div style="text-align: center; background-color: #ff3333; padding: 10px; border-radius: 5px; color: #fff;">';
        echo '<p style="font-size: 18px;">Error updating record: ' . mysqli_error($conn) . '</p>';
        echo '<a href="student.php" style="text-decoration: none; background-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 16px; margin-top: 10px; display: inline-block;">Back</a>';
        echo '</div>';
    }
    
    

    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>



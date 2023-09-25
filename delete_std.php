<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "students";

// ตรวจสอบว่ามีรหัสนักเรียนที่ส่งมาในพารามิเตอร์ id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
        // สร้างการเชื่อมต่อกับฐานข้อมูล
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed " . mysqli_connect_error());
        }

        // สร้างคำสั่ง SQL สำหรับลบข้อมูล
        $sql = "DELETE FROM `std_info` WHERE `id` = $id";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="success-message">';
            echo "Record with ID $id has been deleted successfully!<br>";
            echo '<a href="student.php">Back</a>';
            echo '</div>';
        } else {
            echo '<div class="error-message">';
            echo "Error deleting record: " . mysqli_error($conn) . "<br>";
            echo '<a href="student.php">Back</a>';
            echo '</div>';
        }

        mysqli_close($conn);
    } else {
        // แสดงกล่องข้อความยืนยัน
        
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #ff0000; 
        }

        p {
            text-align: center;
            margin-bottom: 20px;
        }

        .confirm-button {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .confirm-button input[type="submit"] {
            background-color: #ff0000; 
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 20px;
        }

        .confirm-button a {
            text-decoration: none;
            color: #007bff; 
            font-size: 16px;
        }

        .confirm-button a:hover {
            text-decoration: underline;
        }
        
        .success-message {
            color: #00a000; 
        }

        .error-message {
            color: #ff0000; 
        }


    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Student Record</h2>
        <p>Are you sure you want to delete this record?</p>
        <form method="post" action="" class="confirm-button">
            <input type="submit" name="confirm" value="Confirm Delete">
            <a href="student.php">Cancel</a>
        </form>
    </div>
</body>
</html>


<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "students";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM `std_info` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $en_name = $row["en_name"];
        $en_surname = $row["en_surname"];
        $th_name = $row["th_name"];
        $th_surname = $row["th_surname"];
        $major_code = $row["major_code"];
        $email = $row["email"];
    } else {
        echo "No record found with ID $id.";
        mysqli_close($conn);
        exit;
    }

    mysqli_close($conn);
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Update Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            text-align: left; /* จัดข้อความชิดทางซ้าย */
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Update Student Information</h2>
    <form method="post" action="update_std.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="en_name">Name (EN):</label>
        <input type="text" id="en_name" name="en_name" value="<?php echo $en_name; ?>">
        <label for="en_surname">Surname (EN):</label>
        <input type="text" id="en_surname" name="en_surname" value="<?php echo $en_surname; ?>">
        <label for="th_name">ชื่อ:</label>
        <input type="text" id="th_name" name="th_name" value="<?php echo $th_name; ?>">
        <label for="th_surname">นามสกุล:</label>
        <input type="text" id="th_surname" name="th_surname" value="<?php echo $th_surname; ?>">
        <label for="major_code">Major:</label>
        <input type="text" id="major_code" name="major_code" value="<?php echo $major_code; ?>">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        <input type="submit" value="Update">
    </form>
</body>
</html>

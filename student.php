<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        th, td {
            border: 1px solid #007bff;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #cce0ff;
        }

        .insert-button {
            margin-top: 10px;
            text-align: center;
        }
        .insert-button a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .insert-button a:hover {
            background-color: #0056b3;
        }
        .insert-button a:active {
            background-color: #003e70;
        }

        .action-buttons a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin-right: 5px;
        }
        .action-buttons a:hover {
            background-color: #0056b3;
        }
        .action-buttons a:active {
            background-color: #003e70;
        }
    </style>
</head>
<body>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    $servername = "localhost";
    $username = "root";
    $password = "123456789";
    $dbname = "students";
    // create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }
    echo "Connected successfully</br>";
    $sql = "SELECT * FROM `std_info`";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>id</th><th>name</th><th>surname</th>";
            echo "<th>ชื่อ</th><th>นามสกุล</th>";
            echo "<th>Major</th><th>email</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["id"] . "</td>";
                echo "<td>" . $row["en_name"] . "</td>";
                echo "<td>" . $row["en_surname"] . "</td>";
                echo "<td>" . $row["th_name"] . "</td>";
                echo "<td>" . $row["th_surname"] . "</td>";
                echo "<td>" . $row["major_code"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                
                // เพิ่มลิงค์หรือปุ่มลบ
                echo '<td class="action-buttons">';
                echo "<a href='delete_std.php?id=" . $row["id"] . "'>Delete</a>";
                // เพิ่มลิงค์หรือปุ่มแก้ไข
                echo "<a href='update_std_form.php?id=" . $row["id"] . "'>Update</a>";
                echo '</td>';
                echo '</tr>';
            }
            echo "</table>";
        }
    }
    echo "<div class='insert-button'><a href='insert_std_form.html'>Insert new record</a></div>";
    mysqli_close($conn);
    ?>

</body>
</html>

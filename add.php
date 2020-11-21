<html>
<head>
    <title>Add a student</title>
    <link href="./style.css" rel="stylesheet"/>
</head>
<body>
    <?php
        include 'database.php';
        include 'global.php';

        // Tạo database và bảng nếu chưa có sẵn
        create_database($servername, $username, $password, $dbase);
        create_table_students($servername, $username, $password, $dbase);

        // Tạo kết nối với database
        $conn = connect_to_database($servername, $username, $password, $dbase);

        // Nếu là lệnh POST thì ghi thông tin vào database
        if (isset($_POST['msv']) && isset($_POST['name']) && isset($_POST['class'])) {
            $roll_number = mysqli_real_escape_string($conn, $_POST['msv']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $sql = "INSERT INTO students (roll_number, name, class)
                    VALUES ('$roll_number', '$name', '$class')";
            mysqli_query($conn, $sql);

            // Redirect về trang chủ
            header("Location: http://localhost/student/index.php");
        }

        mysqli_close($conn);
        
    ?>

    <h1>Thêm sinh viên</h1>
    <div class="form-wrapper">
        <form action="./add.php" method="POST">
            <div>
                <label for="">MSV: </label>
                <input type="text" name="msv">
            </div>
            <div>
                <label for="">Tên: </label>
                <input type="text" name="name">
            </div>
            <div>
                <label for="">Lớp: </label>
                <input type="text" name="class">
            </div>

            <button type="submit">Thêm sinh viên</button>
        </form>
    </div>
</body>
</html>
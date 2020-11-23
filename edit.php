<html>
<head>
    <title>Edit a student</title>
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

        // Nếu là lệnh POST thì chỉnh sửa thông tin sinh viên rổi redirect về trang chủ
        if (isset($_POST['id']) && isset($_POST['msv']) && isset($_POST['name']) && isset($_POST['class'])) {
            // Chỉnh sửa thông tin sinh viên
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $roll_number = mysqli_real_escape_string($conn, $_POST['msv']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $sql = "UPDATE students SET
                        roll_number = '$roll_number',
                        name = '$name',
                        class = '$class'
                    WHERE id = $id";
            echo $sql;
            mysqli_query($conn, $sql);
            
            // Redirect về trang chủ
            header("Location: http://localhost/student/index.php");
        }

        // Nếu trong lệnh GET biến id không tồn tại thì redirect về trang chủ
        // Eg: http://localhost/student/delete.php?id=6
        // Eg: http://localhost/student/delete.php -> redirect
        if (!isset($_GET['id'])) {
            header("Location: http://localhost/student/index.php");
        }

        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM students WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 0) {
            header("Location: http://localhost/student/index.php");
        }

        $student = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        
    ?>

    <h1>Chỉnh sửa thông tin sinh viên</h1>
    <div class="form-wrapper">
        <form action="./edit.php" method="POST">
            <div>
                <input type="hidden" name="id" value="<?php echo $student['id'] ?>">
            </div>
            <div>
                <label for="">MSV: </label>
                <input type="text" name="msv" value="<?php echo $student['roll_number'] ?>">
            </div>
            <div>
                <label for="">Tên: </label>
                <input type="text" name="name" value="<?php echo $student['name'] ?>">
            </div>
            <div>
                <label for="">Lớp: </label>
                <input type="text" name="class" value="<?php echo $student['class'] ?>">
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
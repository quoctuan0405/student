<html>
<head>
    <title>Delete a student</title>
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

        // Nếu là lệnh POST thì xoá sinh viên rổi redirect về trang chủ
        if (isset($_POST['id'])) {
            // Xoá sinh viên khỏi cơ sở dữ liệu
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $sql = "DELETE FROM students WHERE id = $id";
            mysqli_query($conn, $sql);
            
            // Redirect về trang chủ
            header("Location: http://localhost/student/index.php");
        }

        // Nếu trong lệnh GET biến id không tồn tại thì redirect về trang chủ
        // Eg: http://localhost/student/delete.php?id=6
        // Eg: http://localhost/student/delete.php
        if (!isset($_GET['id'])) {
            header("Location: http://localhost/student/index.php");
        }

        mysqli_close($conn);
        
    ?>

    <h1>Xoá sinh viên</h1>
    <form class="delete-form" action="./delete.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">

        <h3>Bạn có chắc bạn muốn xoá sinh viên này?</h3>

        <button type="submit">Xoá sinh viên</button>
    </form>
</body>
</html>
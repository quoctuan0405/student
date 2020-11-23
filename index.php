<html>
<head>
    <title>Dashboard</title>
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

        // Nếu là lệnh GET thì lấy tất cả các thông tin sinh viên ra khỏi database
        // Nếu là lệnh POST thì tìm kiếm trong database
        $sql = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['search']) {
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            $sql = "SELECT * FROM students
                        WHERE id LIKE '%$search%'
                        OR roll_number LIKE '%$search%'
                        OR name LIKE '%$search%'
                        OR class LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM students";
        }

        $result = mysqli_query($conn, $sql);
    ?>

    <h1>Dashboard</h1>

    <div class="table-wrapper">
        <div class="search">
            <form action="./index.php" method="POST">
                <input type="text" name="search" placeholder="Search..."/>
            </form>
        </div>

        <a href="./add.php">Thêm sinh viên</a>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>MSV</th>
                    <th>Tên</th>
                    <th>Lớp</th>
                    <th>Chỉnh sửa</th>
                    <th>Xoá</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                ?> 
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['roll_number'] ?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['class']?></td>
                                <td><a href="./edit.php?id=<?php echo $row['id']?>">Chỉnh sửa</a></td>
                                <td><a href="./delete.php?id=<?php echo $row['id']?>">Xoá</a></td>
                            </tr>
                <?php
                            $i++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php mysqli_close($conn) ?>
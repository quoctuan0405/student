<html>
<head>
    <title>Dashboard</title>
    <link href="./style.css" rel="stylesheet"/>
</head>
<body>
    <?php
        include 'database.php';
        include 'global.php';

        create_database($servername, $username, $password, $dbase);
        create_table_students($servername, $username, $password, $dbase);

        $conn = connect_to_database($servername, $username, $password, $dbase);

        $sql = "SELECT * FROM students";
        $result = mysqli_query($conn, $sql);
    ?>

    <h1>Dashboard</h1>

    <div class="table-wrapper">
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
                    if (mysqli_num_rows($result) > 0) {
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
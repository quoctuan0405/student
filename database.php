<?php

include 'global.php';

// Tạo database student nếu chưa tồn tại
function create_database($servername, $username, $password, $dbase) {
    // Tạo kết nối đến MySQL/ MariaDB
    $conn = mysqli_connect($servername, $username, $password);

    // Kiểm tra kết nối
    if (!$conn) {
        echo "Can't connect to database";
    }
    
    // Tạo database tên student
    $sql = "CREATE DATABASE IF NOT EXISTS $dbase";
    mysqli_query($conn, $sql);
    
    mysqli_close($conn);
}

// Tạo bảng students nếu bảng này chưa tồn tại
function create_table_students($servername, $username, $password, $dbase) {
    // Truy cập vào database
    $conn = mysqli_connect($servername, $username, $password, $dbase);

    // Kiểm tra kết nối
    if (!$conn) {
        echo ("Can't connect to database");
    }

    // Tạo bảng students
    $sql = "SELECT 1 FROM students LIMIT 1";
    $table_exists = mysqli_query($conn, $sql);
    if (!$table_exists) {
        $sql = "CREATE TABLE students (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            roll_number VARCHAR(30) NOT NULL,
            name VARCHAR(30) NOT NULL,
            class VARCHAR(30) NOT NULL
        )";

        mysqli_query($conn, $sql);
    }
}

// Kết nối với cơ sở dữ liệu
function connect_to_database($servername, $username, $password, $dbase) {
    // Tạo kết nối đến MySQL/ MariaDB
    $conn = mysqli_connect($servername, $username, $password, $dbase);

    // Kiểm tra kết nối
    if (!$conn) {
        echo "Can't connect to database";
    }
    
    return $conn;
}
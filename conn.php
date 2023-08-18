<?php
    // ข้อมูลเชื่อมต่อ MySQL
    $servername = "localhost";  // หรือชื่อโฮสต์ของ MySQL Server
    $username = "root";         // ชื่อผู้ใช้ MySQL
    $password = "";             // รหัสผ่าน MySQL
    $dbname = "proj_db";     // ชื่อฐานข้อมูลที่ต้องการเชื่อมต่อ

    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
    }

    // echo "เชื่อมต่อฐานข้อมูลสำเร็จ";

    // ปิดการเชื่อมต่อ
    // $conn->close();
?>
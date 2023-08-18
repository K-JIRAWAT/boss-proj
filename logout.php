<?php
session_start(); // เริ่มใช้งาน Session

// ลบค่าทั้งหมดใน Session
session_unset();

// ทำลาย Session
session_destroy();

// Redirect ไปยังหน้าเข้าสู่ระบบหรือหน้าที่คุณต้องการ
header("Location: index.php"); // เปลี่ยนเป็นหน้าที่ต้องการ
?>
<head>
    <!-- เชื่อมต่อไฟล์ CSS และ JavaScript ของ SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</head>
<?php
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['confirm'])) {
    $id = $_GET['id'];

    // อัพเดตค่า status ในฐานข้อมูล
    $sql = "UPDATE equipment_tb SET status = '1' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        // ส่งข้อความเพื่อรับทราบว่าการเปลี่ยนค่าสถานะสำเร็จ
        header("Location: main.php");
        // echo "Status updated successfully";
    } else {
        // ส่งข้อความเพื่อรับทราบเมื่อเกิดข้อผิดพลาด
        echo "Error updating status: " . $conn->error;
    }

    $conn->close();
}

?>

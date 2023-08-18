<?php
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $stock = $_POST['stock'];

    // อัพเดตข้อมูลในฐานข้อมูล
    $sql = "UPDATE equipment_tb SET name = '$name', stock = '$stock' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: main.php"); // เมื่ออัพเดตเสร็จแล้วให้กลับไปหน้า main
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

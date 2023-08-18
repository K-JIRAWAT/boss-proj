<?php
include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <br>

    <div class="container mt-5">
        <h2>ข้อมูลจากฐานข้อมูล</h2>
        <a href="add.php" class="btn btn-primary mb-2">Add Data</a> <!-- เพิ่มปุ่ม Add Data -->
        <table class="table table-hover table-bordered table-hover-shadow">
            <thead>
                <tr style="text-align: center;">
                    <th style="width:10%;">รหัส</th>
                    <th style="width:55%;">รายการครุภัทณ์</th>
                    <th style="width:25%;">จำนวนที่มี</th>
                    <th style="width:10%;">แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM equipment_tb where status = '0'"; // แก้ไขตามชื่อตารางของคุณ
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td style="text-align: center;">' . $row['id'] . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td style="text-align: center;">' . $row['stock'] . '</td>';
                        echo '<td>';
                        // echo '<a href="view.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">View</a> ';
                        echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-success btn-sm">Edit</a> ';
                        // echo '<a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" >Delete</a>';
                        echo '<a href="#" class="btn btn-danger btn-sm" onclick="return deleteRecord(' . $row['id'] . ')">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr>';
                    echo '<td></td>';
                    echo '<td style="text-align: center;">ไม่พบจ้อมูล</td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '</tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function deleteRecord(id) {
            Swal.fire({
                icon: "warning",
                title: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่?",
                showCancelButton: true,
                confirmButtonText: "ใช่, ลบข้อมูล",
                cancelButtonText: "ไม่, ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete.php?id=' + id + '&confirm=true';
                }
            });
        }
    </script>
</body>

<style>
    .table-hover-shadow tr:hover {
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
        transition: box-shadow 0.3s ease-in-out;
    }
</style>
<script>
    function confirmDelete() {
        return confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?");
    }
</script>

</html>
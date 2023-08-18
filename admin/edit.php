<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Equipment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 style="text-align: center;">แก้ไขข้อมูลอุปกรณ์</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../conn.php';
                        include 'nav.php';
                        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                            $id = $_GET['id'];

                            // ดึงข้อมูลอุปกรณ์จากฐานข้อมูล
                            $sql = "SELECT * FROM equipment_tb WHERE id = '$id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                                $name = $row['name'];
                                $stock = $row['stock'];
                                // คุณสามารถดึงข้อมูลอื่น ๆ ที่ต้องการแก้ไขจากฐานข้อมูลมาเพิ่มที่นี่
                            } else {
                                echo "ไม่พบข้อมูลอุปกรณ์ที่ต้องการแก้ไข";
                            }
                        }
                        ?>

                        <form action="update.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">ชื่ออุปกรณ์</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">จำนวนสต็อก</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $stock; ?>" required>
                            </div>
                            <!-- คุณสามารถเพิ่มฟิลด์อื่น ๆ ที่ต้องการแก้ไขได้ตามต้องการ -->

                            <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
session_start();
if (!isset($_SESSION['logged'])) {
    echo "<script>alert('ไม่สามารถเข้าสู่ระบบได้');</script>";
    echo "<script>window.location.href = 'index.php' ;</script>";
} else {
    include("templates/header.php");
    $sql = "SELECT * FROM history";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();
    ?>
    <!-- Page content -->
    <div class="container-fluid mt--9">

        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">ประวัติการซ่อมบำรุงลูกค้า</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">ค้นหา</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ลำดับรายกาณซ่อมบำรุง</th>
                                    <th scope="col">รหัสลูกค้า</th>
                                    <th scope="col">เลขไมล์ล่าสุด</th>
                                    <th scope="col">อาการของรถ</th>
                                    <th scope="col">วันที่รับการซ่อมบำรุง</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stmt as $row) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $row['history_ID']; ?>
                                        </th>
                                        <td>
                                            <?php echo $row['customer_ID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['mileage']; ?>
                                        </td>
                                        <th scope="row">
                                            <?php echo $row['symptom']; ?>
                                        </th>
                                        <td>
                                            <?php echo $row['M_date']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include("templates/footer.php");
    } ?>
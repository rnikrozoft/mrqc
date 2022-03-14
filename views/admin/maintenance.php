    <?php 
    session_start();
    if(!isset($_SESSION['logged'])){
    echo "<script>alert('ไม่สามารถเข้าสู่ระบบได้');</script>";
                    echo "<script>window.location.href = 'index.php' ;</script>";
    }else{ 
    include("templates/header.php"); 
    include ("models/newM.php");
    $sql = "SELECT * FROM maintenance";
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
                                <h3 class="mb-0">ข้อมูลรายการซ่อม</h3>
                            </div>
                            <div class="col text-right">
                            <?php  if($_SESSION['logged'][1] == '1') {  ?>
                                <button type="button" class="btn btn-sm btn-primary ni ni-fat-add" data-toggle="modal" data-target="#newmaintenance">เพิ่มรายการซ่อม</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">รหัสรายการซ่อม</th>
                                    <th scope="col">ชื่อรายการซ่อม</th>
                                    <th scope="col">ระยะเวลาในการซ่อม (นาที)</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($stmt as $row){ ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $row['M_ID']; ?>
                                    </th>
                                    <td>
                                        <?php echo $row['M_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['M_time']; ?>
                                    </td>
                                    <td>
                                        <?php  if($_SESSION['logged'][1] == '1') {  ?>

                                        <a href="#" class="btn btn-warning btn-sm update fa fa-edit" role="button" data-idForUpdate="<?php echo $row['M_ID']; ?>" data-mname="<?php echo $row['M_name']; ?>" data-mtime="<?php echo $row['M_time']; ?>"></a>
                                        <a href="../../controllers/route.php?newmaintenance=true&delete=true&idFordelete=<?php echo $row['M_ID']; ?>" class="btn btn-danger btn-sm fa fa-trash" role="button"></a>
                                        <?php } ?>
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
        }?>
        <script>
            $('.update').click(function() {
                var idForUpdate = $(this).attr("data-idForUpdate");
                var mname = $(this).attr("data-mname");
                var mtime = $(this).attr("data-mtime");

                $('#idForUpdate').val(idForUpdate);
                $('#mname').val(mname);
                $('#mtime').val(mtime);


                $('#Upmain').modal("show"); //เปิดโมดอลที่มีไอดี Upmain
            });
        </script>
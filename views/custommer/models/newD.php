<?php
$sql1 = "SELECT * FROM `user`";
$stmt1 = $conn->connect()->prepare($sql1);
$stmt1->execute();

$sql2 = "SELECT * FROM `customer`";
$stmt2 = $conn->connect()->prepare($sql2);
$stmt2->execute();

$sql3 = "SELECT * FROM `maintenance`";
$stmt3 = $conn->connect()->prepare($sql3);
$stmt3->execute();

$sql4 = "SELECT * FROM `maintenance`";
$stmt4 = $conn->connect()->prepare($sql4);
$stmt4->execute();

$sql5 = "SELECT * FROM `maintenance`";
$stmt5 = $conn->connect()->prepare($sql5);
$stmt5->execute();

$sql6 = "SELECT * FROM `maintenance`";
$stmt6 = $conn->connect()->prepare($sql6);
$stmt6->execute();

$sql7 = "SELECT * FROM `maintenance`";
$stmt7 = $conn->connect()->prepare($sql7);
$stmt7->execute();
?>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="newdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มคิวรายการซ่อม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../../controllers/route.php" method="POST">
                <!-- action="../../controllers/route.php" method="POST" name="data" -->
                <input type="hidden" name="newdetail">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="h5">รายการซ่อม</label>
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <select class="form-control" name="M_ID1" id="list1">
                                            <option value="ไม่มี" SELECT="SELECTED">ไม่มี</option>
                                            <?php foreach ($stmt3 as $row3) { ?>
                                                <option value="<?php echo $row3['M_time']; ?>"><?php echo $row3['M_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <select class="form-control" name="M_ID2" id="list2" disabled>
                                            <option value="ไม่มี" SELECT="SELECTED">ไม่มี</option>
                                            <?php foreach ($stmt4 as $row4) { ?>
                                                <option value="<?php echo $row4['M_time']; ?>" SELECT="SELECTED"><?php echo $row4['M_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <select class="form-control" name="M_ID3" id="list3" disabled>
                                            <option value="ไม่มี" SELECT="SELECTED">ไม่มี</option>
                                            <?php foreach ($stmt5 as $row5) { ?>
                                                <option value="<?php echo $row5['M_time']; ?>" SELECT="SELECTED"><?php echo $row5['M_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <select class="form-control" name="M_ID4" id="list4" disabled>
                                            <option value="ไม่มี" SELECT="SELECTED">ไม่มี</option>
                                            <?php foreach ($stmt6 as $row6) { ?>
                                                <option value="<?php echo $row6['M_time']; ?>" SELECT="SELECTED"><?php echo $row6['M_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <select class="form-control" name="M_ID5" id="list5" disabled>
                                            <option value="ไม่มี" SELECT="SELECTED">ไม่มี</option>
                                            <?php foreach ($stmt7 as $row7) { ?>
                                                <option value="<?php echo $row7['M_time']; ?>" SELECT="SELECTED"><?php echo $row7['M_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="h5">ชื่อลูกค้า</label>
                                <div class="input-group input-group-alternative">
                                    <select class="form-control" name="customer_ID">
                                        <?php foreach ($stmt2 as $row2) { ?>
                                            <option value="<?php echo $row2['customer_name']; ?>" SELECT="SELECTED"><?php echo $row2['customer_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="h5">ชื่อพนักงาน</label>
                                <select class="form-control" name="user_ID" readonly>
                                    <?php  ?> 
                                       <option  SELECT="SELECTED"><?php echo $_SESSION['logged'][0]; ?></option>
                                    <?php  ?>
                                </select> 
                                <!-- <input type="text" class="form-control" value="<?php echo $_SESSION['logged'][0]; ?>"readonly> -->
                            </div>
                            <div class="form-group">
                                <label for="" class="h5">วันที่รับการซ่อมบำรุง</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="วันที่รับการซ่อมบำรุง" type="date" name="date">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="h5">เวลาที่ต้องใช้ทั้งหมด</label>
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control" type="text" name="timeUse" id="timeUse" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="h5">ระดับความสำคัญของงาน</label>
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-chart-bar-32"></i></span>
                                                </div>
                                                <input class="form-control" type="number" name="priority">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <input type="hidden" id="list1_mName1" name="list1_mName1">
                                <input type="hidden" id="list1_mName2" name="list1_mName2">
                                <input type="hidden" id="list1_mName3" name="list1_mName3">
                                <input type="hidden" id="list1_mName4" name="list1_mName4">
                                <input type="hidden" id="list1_mName5" name="list1_mName5">

                                
                                <button type="reset" class="btn btn-danger ni ni-fat-remove" data-dismiss="modal"></button>
                                <button type="submit" class="btn btn-info ni ni-check-bold" name="insert"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="Updetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขรายการซ่อม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="../../controllers/route.php?newdetail=true&updateM=true" method="POST">
                <input type="hidden" name="ord_ID" class="ord_ID">
                <input type="hidden" name="detail_ID" class="detail_ID">
                <input type="hidden" name="newdetail">
                <input type="hidden" class="customer_name" name="customer_name">
                <input type="hidden" name="m_name">

                <div class="modal-body">

                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                            </div>
                            <input class="form-control customer_name" value="<?php echo $row2['customer_name']; ?>" type="text" name="customer_name" readonly>
                        </div>
                    </div>

                    <div class="option">

                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control"  type="hitden" name="date" id="date" readonly>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger ni ni-fat-remove" data-dismiss="modal"></button>
                    <button type="submit" class="btn btn-info ni ni-check-bold" name="update"></button>
                </div>
            </form>
        </div>
    </div>
</div>
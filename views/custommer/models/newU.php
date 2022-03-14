<?php 
    $sql = "SELECT * FROM `position`";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();
 ?>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="newuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มพนักงาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <form role="form" action="../../controllers/route.php" method="POST">
                <input type="hidden" name="newuser">
                <div class="modal-body">
                    <div class="form-group">
                    <label for="" class="h5">ตำแหน่ง</label>
                        <select class="form-control" name="position_ID" >
                    <?php foreach($stmt as $row){ ?>
                    <option value="<?php echo $row['position_ID']; ?>" SELECT="SELECTED"><?php echo $row['user_position']; ?></option>
                    <?php } ?>
                </select>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                            </div>
                            <input class="form-control" placeholder="ชื่อ - สกุล" type="text" name="user_fname">
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="" class="h5">วันที่เข้าทำงาน</label>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input class="form-control" placeholder="วันที่เข้าทำงาน" type="date" name="user_fday">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                            </div>
                            <input class="form-control" placeholder="ที่อยู่" type="text" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="" class="h5">วันเกิด</label>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input class="form-control" placeholder="วันเกิด" type="date" name="birthday">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                            </div>
                            <input class="form-control" placeholder="เลขบัตรประจำตัวประชาชน" type="text" name="id_card">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-badge"></i></span>
                            </div>
                            <input class="form-control" placeholder="ไอดี" type="text" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class=""></i></span>
                            </div>
                            <input class="form-control" placeholder="รหัสผ่าน" type="password" name="password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger ni ni-fat-remove" data-dismiss="modal"></button>
                    <button type="submit" class="btn btn-info ni ni-check-bold" name="insert"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================================================ -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="showuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" name="newuser">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ดูข้อมูล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>

            <form role="form" action="../../controllers/route.php" method="post">

                <input type="hidden" name="newuser">
                <div class="modal-body">

                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                            </div>
                            <input class="form-control" placeholder="เลขบัตรประจำตัวประชาชน" type="text" id="id" name="user_ID" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                            </div>
                            <input class="form-control" placeholder="รายละเอียดรถ" type="text" id="pid" name="position_ID" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                            </div>
                            <input class="form-control" placeholder="ชื่อ-สกุล" type="text" id="uname" name="user_fname" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input class="form-control" placeholder="ที่อยู่" id="uday" type="text" name="user_fday" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                            </div>
                            <input class="form-control" placeholder="อีเมลล์" id="address" type="text" name="address" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input class="form-control" placeholder="เบอร์โทรศัพท์" id="bday" type="date" name="birthday" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                            </div>
                            <input class="form-control" placeholder="เบอร์โทรศัพท์" id="card" type="text" name="id_card" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                   
                    <button type="reset" class="btn btn-danger ni ni-fat-remove" data-dismiss="modal"></button>
                    
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ============================================================================================ -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="Upuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>

            <form role="form" action="../../controllers/route.php" method="post">
                <input type="hidden" name="newuser">
                <input type="hidden" name="idForUpdate" id="idForUpdate">  <!-- ส่งอันนี้มาทุกครังเพื่อเป็นตัวบอกว่าจะอัพเดทไอดีไหน -->
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                            </div>
                            <input class="form-control" placeholder="ชื่อ-สกุล" type="text" id="fname" name="user_fname">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input class="form-control" placeholder="ที่อยู่" id="fday" type="text" name="user_fday">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                            </div>
                            <input class="form-control" placeholder="อีเมลล์" id="add" type="text" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input class="form-control" placeholder="เบอร์โทรศัพท์" id="brith" type="date" name="birthday">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                            </div>
                            <input class="form-control" placeholder="เบอร์โทรศัพท์" id="idcard" type="number" name="id_card" pattern="[0-9]{13}" title="Three letter country code" required>
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
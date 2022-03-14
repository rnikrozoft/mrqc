<?php 
    $sql = "SELECT * FROM `maintenance`";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();
 ?>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="newmaintenance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มลูกค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <form role="form" action="../../controllers/route.php" method="POST">
                <input type="hidden" name="newmaintenance">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-settings"></i></span>
                            </div>
                            <input class="form-control" placeholder="ชื่อรายการซ่อม" type="text" name="M_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                            </div>
                            <input class="form-control" placeholder="ระยะเวลาในการซ่อม" type="text" name="M_time" pattern="[0-9]{2-3}" title="กรุณากรอกให้ตรงตามข้อกำหนด" required>
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

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="Upmain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <form role="form" action="../../controllers/route.php" method="POST">
                <input type="hidden" name="idForUpdate" id="idForUpdate">
                <input type="hidden" name="newmaintenance">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-settings"></i></span>
                            </div>
                            <input class="form-control" placeholder="ชื่อรายการซ่อม" type="text" id="mname" name="M_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                            </div>
                            <input class="form-control" placeholder="ระยะเวลาในการซ่อม" type="text" id="mtime" name="M_time" pattern="[0-9]{2-3}" title="กรุณากรอกให้ตรงตามข้อกำหนด" required>
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
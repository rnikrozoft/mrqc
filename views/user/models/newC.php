<?php 
    $sql = "SELECT * FROM `customer`";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();
 ?>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="newcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เพิ่มลูกค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="../../controllers/route.php" method="POST">
      <input type="hidden" name="customers">
      <div class="modal-body">
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-address-card"></i></span>
                    </div>
                    <input class="form-control" placeholder="เลขบัตรประจำตัวประชาชน" type="number"name="C_idcard" pattern="[0-9]{13}" title="Three letter country code" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-car"></i></span>
                    </div>
                    <input class="form-control" placeholder="รายละเอียดรถ" type="text"name="car_detail"required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control" placeholder="ชื่อ-สกุล" type="text"name="customer_name"required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="ที่อยู่" type="text"name="address"required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                    </div>
                    <input class="form-control" placeholder="อีเมลล์" type="email"name="email" pattern="[A-Za-z]{}" title="Three letter country code" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input class="form-control" placeholder="เบอร์โทรศัพท์" type="number"name="phone_num" pattern="[0-9]{10}" title="Three letter country code" required>
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
<div class="modal fade" id="showCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" name="newcustomer">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ดูข้อมูลลูกค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form role="form" action="../../controllers/route.php" method="post">
    
      <input type="hidden" name="customers">
      <div class="modal-body">

            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-address-card"></i></span>
                    </div>
                    <input class="form-control" placeholder="เลขบัตรประจำตัวประชาชน" type="text" id="cardID" name="C_idcard" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-car"></i></span>
                    </div>
                    <input class="form-control" placeholder="รายละเอียดรถ" type="text"  id="car_detail" name="car_detail" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control" placeholder="ชื่อ-สกุล" type="text" id="cusname" name="customer_name" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="ที่อยู่" id="address" type="text" name="address" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                    </div>
                    <input class="form-control" placeholder="อีเมลล์" id="email" type="text" name="email" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input class="form-control" placeholder="เบอร์โทรศัพท์" id="phoneNum" type="text" name="phone_num" readonly>
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
<div class="modal fade" id="UpCustomers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลลูกค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form role="form" action="../../controllers/route.php" method="post">
      <input type="hidden" name="customers">
      <input type="hidden" name="idForUpdate" id="idForUpdate">
      <div class="modal-body">

      <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-address-card"></i></span>
                    </div>
                    <input class="form-control" placeholder="เลขบัตรประจำตัวประชาชน" type="number" id="idc" name="idc">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-car"></i></span>
                    </div>
                    <input class="form-control" placeholder="รายละเอียดรถ" type="text"  id="cdetail" name="cdetail">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control" placeholder="ชื่อ-สกุล" type="text" id="cname" name="cname">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="ที่อยู่" id="add" type="text" name="add">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                    </div>
                    <input class="form-control" placeholder="อีเมลล์" id="mail" type="email" name="mail" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input class="form-control" placeholder="เบอร์โทรศัพท์" id="phone" type="number" name="phone">
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
  <?php 
  session_start();
  if(!isset($_SESSION['logged'])){
    echo "<script>alert('ไม่สามารถเข้าสู่ระบบได้');</script>";
                  echo "<script>window.location.href = 'index.php' ;</script>";
  }else{ 
  include ("templates/header.php"); 
  include ("models/newU.php");
  $sql = "SELECT * FROM user";
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
                    <h3 class="mb-0">ข้อมูลพนักงาน</h3>
                  </div>
                
                  <div class="col text-right">
                  <?php  if($_SESSION['logged'][1] == '1') {  ?>
                  <button type="button" class="btn btn-sm btn-primary ni ni-fat-add" data-toggle="modal" data-target="#newuser">เพิ่มพนักงาน</button>
                  <?php } ?>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                          <thead class="thead-light">
                              <tr>
                                  <th scope="col">ชื่อ - สกุล</th>
                                  <th scope="col">ตำแหน่ง</th>
                                  <th>จัดการข้อมูลลูกค้า</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach($stmt as $row){ ?>
                              <tr>
                                  <th scope="row">
                                  <?php echo $row['user_fname']; ?>
                                  </th>
                                  <td>
                                  <?php  echo  ( $row['position_ID'] ==1 ? "ผู้ดูแลระบบ" : "พนักงาน"); ?>
                                
                                  </td>
                                  <td>
                                      <?php  if($_SESSION['logged'][1] == '1') {  ?>
                                      <a href="#" class="btn btn-default btn-sm show fa fa-search" role="button" 
                                      data-id="<?php echo $row['user_ID']; ?>" 
                                      data-pid="<?php  echo  ( $row['position_ID'] ==1 ? "ผู้ดูแลระบบ" : "พนักงาน"); ?>" 
                                      data-uname="<?php echo $row['user_fname']; ?>" 
                                      data-uday="<?php echo $row['user_fday']; ?>"
                                      data-address="<?php echo $row['address']; ?>" 
                                      data-bday="<?php echo $row['birthday']; ?>" 
                                      data-card="<?php echo $row['id_card']; ?>">
                                      </a>

                                      <a href="#" class="btn btn-warning btn-sm update fa fa-edit" role="button" 
                                      data-idForUpdate="<?php echo $row['user_ID']; ?>"  
                                      data-fname="<?php echo $row['user_fname']; ?>" 
                                      data-fday="<?php echo $row['user_fday']; ?>"
                                      data-add="<?php echo $row['address']; ?>" 
                                      data-brith="<?php echo $row['birthday']; ?>" 
                                      data-idcard="<?php echo $row['id_card']; ?>"></a>
                                      <a href="../../controllers/route.php?newuser=true&delete=true&idFordelete=<?php echo $row['user_ID']; ?>" class="btn btn-danger btn-sm fa fa-trash" role="button"></a>
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
          $('.show').click(function() {
              var id = $(this).attr("data-id");
              var pid = $(this).attr("data-pid");
              var uname = $(this).attr("data-uname");
              var uday = $(this).attr("data-uday");
              var address = $(this).attr("data-address");
              var bday = $(this).attr("data-bday");
              var card = $(this).attr("data-card");

              $('#id').val(id);
              $('#pid').val(pid);
              $('#uname').val(uname);
              $('#uday').val(uday);
              $('#address').val(address);
              $('#bday').val(bday);
              $('#card').val(card);

              $('#showuser').modal("show"); //เปิดโมดอลที่มีไอดี showuser
          });

          $('.update').click(function() {
              var idForUpdate = $(this).attr("data-idForUpdate");
              var fname = $(this).attr("data-fname");
              var fday = $(this).attr("data-fday");
              var add = $(this).attr("data-add");
              var brith = $(this).attr("data-brith");
              var idcard = $(this).attr("data-idcard");

              $('#idForUpdate').val(idForUpdate); //ส่งอันนี้ไปทุกครังที่หน้า route.php
              $('#fname').val(fname);
              $('#fday').val(fday);
              $('#add').val(add);
              $('#brith').val(brith);
              $('#idcard').val(idcard);

              $('#Upuser').modal("show"); //เปิดโมดอลที่มีไอดี Upuser
          });
      </script>

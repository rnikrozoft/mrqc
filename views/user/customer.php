    <?php 
    session_start();
    if(!isset($_SESSION['logged'])){
    echo "<script>alert('ไม่สามารถเข้าสู่ระบบได้');</script>";
                    echo "<script>window.location.href = 'index.php' ;</script>";
    }else{ 
    include ("templates/header.php"); 
    include ("models/newC.php");
    $sql = "SELECT * FROM customer";
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
                                <h3 class="mb-0">ข้อมูลลูกค้า</h3>
                            </div>
                            <div class="col text-right">
                            <?php  if($_SESSION['logged'][1] == '1') {  ?>
                                <button type="button" class="btn btn-sm btn-primary ni ni-fat-add" data-toggle="modal" data-target="#newcustomer">เพิ่มลูกค้า</button>
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
                                    <th scope="col">รายละเอียดรถ</th>
                                    <th>จัดการข้อมูลลูกค้า</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($stmt as $row){ ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $row['customer_name']; ?>
                                    </th>
                                    <td>
                                        <?php echo $row['car_detail']; ?>
                                    </td>
                                    <td>
                                        <?php  if($_SESSION['logged'][1] == '1') {  ?>
                                        <a href="#" class="btn btn-default btn-sm show fa fa-search" role="button" data-id="<?php echo $row['customer_ID']; ?>" data-idcard="<?php echo $row['C_idcard']; ?>" data-car_detail="<?php echo $row['car_detail']; ?>" data-cusname="<?php echo $row['customer_name']; ?>"
                                            data-address="<?php echo $row['address']; ?>" data-email="<?php echo $row['email']; ?>" data-phoneNum="<?php echo $row['phone_num']; ?>"></a>

                                        <a href="#" class="btn btn-warning btn-sm update fa fa-edit" role="button" data-idForUpdate="<?php echo $row['customer_ID']; ?>" data-idc="<?php echo $row['C_idcard']; ?>" data-cdetail="<?php echo $row['car_detail']; ?>" data-cname="<?php echo $row['customer_name']; ?>"
                                            data-add="<?php echo $row['address']; ?>" data-mail="<?php echo $row['email']; ?>" data-phone="<?php echo $row['phone_num']; ?>"></a>
                                        <a href="../../controllers/route.php?customers=true&delete=true&idFordelete=<?php echo $row['customer_ID']; ?>" class="btn btn-danger btn-sm fa fa-trash" role="button"></a>
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
        } ?>
        <script>
            $('.show').click(function() {
                var cardID = $(this).attr("data-idcard");
                var car_detail = $(this).attr("data-car_detail");
                var cusname = $(this).attr("data-cusname");
                var address = $(this).attr("data-address");
                var email = $(this).attr("data-email");
                var phoneNum = $(this).attr("data-phoneNum");

                $('#car_detail').val(car_detail);
                $('#cardID').val(cardID);
                $('#cusname').val(cusname);
                $('#address').val(address);
                $('#email').val(email);
                $('#phoneNum').val(phoneNum);

                $('#showCustomer').modal("show"); //เปิดโมดอลที่มีไอดี showCustomer
            });

            $('.update').click(function() {
                var idForUpdate = $(this).attr("data-idForUpdate");
                var idc = $(this).attr("data-idc");
                var cdetail = $(this).attr("data-cdetail");
                var cname = $(this).attr("data-cname");
                var add = $(this).attr("data-add");
                var mail = $(this).attr("data-mail");
                var phone = $(this).attr("data-phone");

                $('#idForUpdate').val(idForUpdate);
                $('#cdetail').val(cdetail);
                $('#idc').val(idc);
                $('#cname').val(cname);
                $('#add').val(add);
                $('#mail').val(mail);
                $('#phone').val(phone);

                $('#UpCustomers').modal("show"); //เปิดโมดอลที่มีไอดี UpCustomers
            });
        </script>
        
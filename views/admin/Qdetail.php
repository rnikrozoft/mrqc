<?php
session_start();
if (!isset($_SESSION['logged'])) {
    echo "<script>alert('ไม่สามารถเข้าสู่ระบบได้');</script>";
    echo "<script>window.location.href = 'index.php' ;</script>";
} else {
    include("templates/header.php");
    include("models/newD.php");
    function changeDate($m, $year)
    {
        $result;
        $mount;
        $year = $year + 543;
        switch ($m) {
            case '01':
                $mount = 'มกราคม';
                break;
            case '02':
                $mount = 'กุมภาพันธ์';
                break;
            case '03':
                $mount = 'มีนาคม';
                break;
            case '04':
                $mount = 'เมษายน';
                break;
            case '05':
                $mount = 'พฤภาคม';
                break;
            case '06':
                $mount = 'มิถุนายน';
                break;
            case '07':
                $mount = 'กรกฏาคม';
                break;
            case '08':
                $mount = 'สิงหาคม';
                break;
            case '09':
                $mount = 'กันยายน';
                break;
            case '10':
                $mount = 'ตุลาคม';
                break;
            case '11':
                $mount = 'พฤศจิกายน';
                break;
            case '12':
                $mount = 'ธันวาคม';
                break;
        }
        $result[0] = $mount;
        $result[1] = $year;
        return $result;
    }
    ?>


    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <h3 class="h5">จัดคิวการซ่อมบำรุง</h3>
                            </div>
                            <div class="col-6">
                                <form>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="date" class="form-control input-sm" name="date" required>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary fa fa-search "></button>
                                        </div>
                                    </div>
                                </form>
                                <?php if (isset($_GET['date'])) {
                                    $date_explode = explode("-", $_GET['date']);

                                    $res = changeDate($date_explode[1], $date_explode[0]);

                                    $mount = $res[0];
                                    $year = $res[1];
                                    $day = $date_explode[2];

                                    echo "<h5 class='h5'>รายการซ่อมวันที่ : " . $day . "-" . $mount . "-" . $year . "</h5>";
                                } ?>
                            </div>
                            <div class="col-4 text-right">
                            <h5 class="h5">เลือก Algorithm การจัดเวลา</h5>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="FCFS">
                                            <label class="form-check-label">FCFS</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="SJF">
                                            <label class="form-check-label">SJF</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="PRI">
                                            <label class="form-check-label">priority</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_GET['date'])) { ?>
                        <div class="table-responsive">

                        <?php
                            $sql_PRI = "SELECT DISTINCT ord_id from detail where M_name != 'ไม่มี' AND date = '$_GET[date]' ORDER BY time ASC ";
                            $stmt_PRI = $conn->connect()->prepare($sql_PRI);
                            $stmt_PRI->execute();
                            ?>
                            <div class="" style="">
                                <div class="row">
                                    <div class="col-2">
                                        <h2 class="offset-1">ลำดับคิวการซ่อม</h2>
                                    </div>
                                </div>
                                <table class="table align-items-center table-flush" >
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ชื่อ - สกุล ลูกค้า</th>
                                            <th scope="col">รายการซ่อม (นาที)</th>
                                            <th scope="col">ใช้เวลาซ่อม</th>
                                            <th scope="col">เวลาแจ้งซ่อม</th>
                                            <th scope="col">พนักงานที่รับผิดชอบ</th>
                                            <th>Priority</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form id="updateForm" action="../../controllers/route.php" method="POST">
                                            <input type="hidden" name="newdetail">
                                            <input type="hidden" name="updatePriorityall">
                                            <input type="hidden" name="date" value="<?php echo $_GET['date']; ?>">
                                            <?php
                                            $i = 1;
                                            $val = 0;
                                            $l3 = 1;
                                            $total3 = 0;
                                            $wait3 = 0;
                                            foreach ($stmt_PRI as $row_PRI) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <?php
                                                    $_id = $row_PRI['ord_id'];
                                                    $sql_PRI2 = "SELECT * FROM detail where ord_id = $_id LIMIT 1 ";
                                                    $stmt_PRI2 = $conn->connect()->prepare($sql_PRI2);
                                                    $stmt_PRI2->execute();

                                                    foreach ($stmt_PRI2 as $row_PRI2) {

                                                        $_data = [
                                                            "ord_id" => $row_PRI2["ord_ID"],
                                                            "PRI" => $row_PRI2["priority"]
                                                        ];
                                                        ?>
                                                        <td><?php echo $row_PRI2['customer_name']; ?> </td>
                                                        <?php
                                                        $sql_PRI3 = "SELECT detail.M_name,maintenance.M_time 
                                        FROM detail JOIN maintenance on detail.M_name = maintenance.M_name 
                                        where detail.ord_id = $_id ";
                                                        $stmt_PRI3 = $conn->connect()->prepare($sql_PRI3);
                                                        $stmt_PRI3->execute();
                                                        echo  ' <td>';
                                                        $sum[$l3] = 0;
                                                        $sum2 = 0;
                                                        foreach ($stmt_PRI3 as $row_PRI3) {
                                                            echo "- " . $row_PRI3['M_name'] . " : " . $row_PRI3['M_time'] . ' นาที<br>';
                                                            $sum[$l3] = $sum[$l3] + $row_PRI3['M_time'];
                                                        }
                                                        echo  ' </td>';
                                                        $s3 = $l3 - 1;
                                                        if($l3 > 0){
                                                            if($s3 == 0){
                                                                $wait3 = $wait3 + 0;
                                                            }else{
                                                                $wait3 = $wait3 + ($sum[$s3]);
                                                            }
                                                            $total3 = $total3 + $wait3;
                                                        }
                                                         ?>
                                                        <td><?php echo $sum[$l3] . " นาที"; ?> </td>
                                                        <td><?php echo $row_PRI2['time']; ?></td>
                                                        <td><?php echo $row_PRI2['user_fname']; ?> </td>
                                                        <td>

                                                            <div class="input-group input-group-sm ">

                                                                <input type="hidden" name="ord_ID[]" value="<?php echo $row_PRI2['ord_ID']; ?>">
                                                                <input type="number" class="form-control" name="updatePriority[]" value="<?= $row_PRI2['priority']; ?>">
                                                                <!-- <div class="input-group-append">
                                                                                                                                                                                                                                                                                <button class="btn btn-info btn-sm" type="submit" >บันทึก</button>
                                                                                                                                                                                                                                                                            </div> -->
                                                            </div>

                                                        </td>
                                                    <?php  $l3++; } $i++;  } ;?> 

                                            </tr>
                                            <tr>
                                                <td colspan="6" class="text-right"> 
                                                <!-- <h5 class="h5">ใช้เวลาซ่อมเฉลี่ย</h5>
                                                </td>
                                                <td>
                                                <h5 class="h5"><?php echo $total3 / ($l3-1)  ?> นาที</h5> -->
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-info btn-sm">บันทึก</button>
                                                </td>
                                        </form>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <?php
                            $sql_id = "SELECT DISTINCT ord_id from detail where M_name != 'ไม่มี' AND date = '$_GET[date]' ORDER BY time ASC";
                            $stmt_id = $conn->connect()->prepare($sql_id);
                            $stmt_id->execute();
                            $result = $stmt_id->fetchAll();
                            $last = count($result);
                            $stmt_id = $conn->connect()->prepare($sql_id);

                            $stmt_id->execute();

                            ?>
                            <div class="FCFS" style="display: none">
                                <div class="row">
                                    <div class="col-2">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="algo" id="exampleRadios2" value="FCFS">
                                    <label class="form-check-label" for="exampleRadios2">
                                       <h2> FCFS </h2>
                                    </label>
                                    </div>
                                    </div>
                                </div>
                                <table class="table align-items-center table-flush table-info">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ชื่อ - สกุล ลูกค้า</th>
                                            <th scope="col">รายการซ่อม (นาที)</th>
                                            <th scope="col">ใช้เวลาซ่อม</th>
                                            <th scope="col">เวลาแจ้งซ่อม</th>
                                            <th scope="col">พนักงานที่รับผิดชอบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $val = 0;
                                        $l = 1;
                                        $total = 0;
                                        $wait = 0;
                                        foreach ($stmt_id as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <?php
                                                $_id = $row['ord_id'];
                                                $sql2 = "SELECT * FROM detail where ord_id = $_id LIMIT 1";
                                                $stmt2 = $conn->connect()->prepare($sql2);
                                                $stmt2->execute();


                                                foreach ($stmt2 as $row2) {


                                                    ?>
                                                    <td><?php echo $row2['customer_name']; ?> </td>
                                                    <?php
                                                    $sql3 = "SELECT detail.M_name,maintenance.M_time 
                                            FROM detail JOIN maintenance on detail.M_name = maintenance.M_name 
                                            where detail.ord_id = $_id ";
                                                    $stmt3 = $conn->connect()->prepare($sql3);
                                                    $stmt3->execute();
                                                    echo  ' <td>';
                                                    $sum[$l] = 0;
                                                    $sum2 = 0;
                                                    foreach ($stmt3 as $row3) {
                                                        echo "- " . $row3['M_name'] . " : " . $row3['M_time'] . ' นาที<br>';
                                                        $sum[$l] = $sum[$l] + $row3['M_time'];
                                                    }
                                                    echo  ' </td>';
                                                    $s = $l - 1;
                                                    if ($l > 0) {
                                                        if ($s == 0) {
                                                            $wait = $wait + 0;
                                                        } else {
                                                            $wait = $wait + ($sum[$s]);
                                                        }
                                                        $total = $total + $wait;
                                                    }


                                                    ?>
                                                    <td><?php echo $sum[$l] . " นาที "; ?> </td>
                                                    <td><?php echo $row2['time']; ?></td>
                                                    <td><?php echo $row2['user_fname']; ?> </td>
                                                    <?php

                                                    $l++;
                                                }
                                                $i++;
                                            }; ?>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">
                                                <h5 class="h5">ระยะเวลารอคอยเฉลี่ย</h5>
                                            </td>
                                            <td>
                                                <h5 class="h5"><?php echo $total / ($l - 1)  ?> นาที</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <?php
                            $sql_SJF = "SELECT DISTINCT ord_id,all_time from detail where M_name != 'ไม่มี' AND date = '$_GET[date]' ORDER BY all_time,time ASC";
                            $stmt_SJF = $conn->connect()->prepare($sql_SJF);
                            $stmt_SJF->execute();
                            ?>

                            <div class="SJF" style="display: none">
                                <div class="row">
                                <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="algo" id="exampleRadios2" value="SJF">
                                    <label class="form-check-label" for="exampleRadios2">
                                    <h2> SJF</h2>
                                    </label>
                                    </div>
                                    </div>
                                </div>
                                <table class="table align-items-center table-flush table-success">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ชื่อ - สกุล ลูกค้า</th>
                                            <th scope="col">รายการซ่อม (นาที)</th>
                                            <th scope="col">ใช้เวลาซ่อม</th>
                                            <th scope="col">เวลาแจ้งซ่อม</th>
                                            <th scope="col">พนักงานที่รับผิดชอบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php 
                                    $i=1; 
                                    $val = 0;
                                    $l2 = 1;
                                    $total2 = 0;
                                    $wait2 = 0;
                                    foreach($stmt_SJF as $row_SJF){  
                                ?>
                                <tr>
                                  <td><?php echo $i; ?></td>  
                                <?php
                                    $_id = $row_SJF['ord_id'];
                                    $sql_SJF2 = "SELECT * FROM detail where ord_id = $_id LIMIT 1";
                                    $stmt_SJF2 = $conn->connect()->prepare($sql_SJF2);
                                    $stmt_SJF2->execute();
            
                                    foreach ($stmt_SJF2 as $row_SJF2){ 
                                ?>
                                    <td><?php echo $row_SJF2['customer_name']; ?>  </td>  
                                <?php 
                                    $sql_SJF3 = "SELECT detail.M_name,maintenance.M_time 
                                            FROM detail JOIN maintenance on detail.M_name = maintenance.M_name 
                                            where detail.ord_id = $_id";
                                    $stmt_SJF3 = $conn->connect()->prepare($sql_SJF3);
                                    $stmt_SJF3->execute();
                            echo  ' <td>' ; 
                                    $sum[$l2] = 0;
                                    $sum2 = 0;
                                    foreach ($stmt_SJF3 as $row_SJF3 ) {
                                        echo "- ".$row_SJF3['M_name']." : ".$row_SJF3['M_time'] . ' นาที<br>';
                                        $sum[$l2] = $sum[$l2]+$row_SJF3['M_time'];
                                    }
                            echo  ' </td>' ; 
                            $s2 = $l2 - 1;
                            if($l2 > 0){
                                if($s2 == 0){
                                    $wait2 = $wait2 + 0;
                                }else{
                                    $wait2 = $wait2 + ($sum[$s2]);
                                }
                                $total2 = $total2 + $wait2;
                            }
  
                           
                            ?>
                                    <td><?php echo $sum[$l2]." นาที"; ?>  </td>  
                                    <td><?php echo $row_SJF2['time']; ?></td>
                                    <td><?php echo $row_SJF2['user_fname']; ?> </td>
                                    <?php
                               
                               $l2++; } $i++;  } ;?>
                               </tr> 
                               <tr>
                                   <td colspan="5" class="text-right">
                                       <h5 class="h5">ระยะเวลารอคอยเฉลี่ย</h5>
                                   </td>
                                   <td>
                                       <h5 class="h5"><?php echo $total2 / ($l2-1)  ?> นาที</h5>
                                   </td>
                               </tr>            
                            </tbody>
                                </table>
                            </div>

                            <?php
                            $sql_PRI = "SELECT DISTINCT ord_id from detail where M_name != 'ไม่มี' AND date = '$_GET[date]' ORDER BY priority,time ASC ";
                            $stmt_PRI = $conn->connect()->prepare($sql_PRI);
                            $stmt_PRI->execute();
                            ?>
                            <div class="PRI" style="display: none">
                                <div class="row">
                                    <div class="col-2">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="algo" id="exampleRadios2" value="PRI">
                                    <label class="form-check-label" for="exampleRadios2">
                                    <h2> Priority</h2>
                                    </label>
                                    </div>
                                    </div>
                                </div>
                                <table class="table align-items-center table-flush table-warning">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ชื่อ - สกุล ลูกค้า</th>
                                            <th scope="col">รายการซ่อม (นาที)</th>
                                            <th scope="col">ใช้เวลาซ่อม</th>
                                            <th scope="col">เวลาแจ้งซ่อม</th>
                                            <th scope="col">พนักงานที่รับผิดชอบ</th>
                                            <th>Priority</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form id="updateForm" action="../../controllers/route.php" method="POST">
                                            <input type="hidden" name="newdetail">
                                            <input type="hidden" name="updatePriorityall">
                                            <input type="hidden" name="date" value="<?php echo $_GET['date']; ?>">
                                            <?php
                                            $i = 1;
                                            $val = 0;
                                            $l3 = 1;
                                            $total3 = 0;
                                            $wait3 = 0;
                                            foreach ($stmt_PRI as $row_PRI) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <?php
                                                    $_id = $row_PRI['ord_id'];
                                                    $sql_PRI2 = "SELECT * FROM detail where ord_id = $_id LIMIT 1 ";
                                                    $stmt_PRI2 = $conn->connect()->prepare($sql_PRI2);
                                                    $stmt_PRI2->execute();

                                                    foreach ($stmt_PRI2 as $row_PRI2) {

                                                        $_data = [
                                                            "ord_id" => $row_PRI2["ord_ID"],
                                                            "PRI" => $row_PRI2["priority"]
                                                        ];
                                                        ?>
                                                        <td><?php echo $row_PRI2['customer_name']; ?> </td>
                                                        <?php
                                                        $sql_PRI3 = "SELECT detail.M_name,maintenance.M_time 
                                        FROM detail JOIN maintenance on detail.M_name = maintenance.M_name 
                                        where detail.ord_id = $_id ";
                                                        $stmt_PRI3 = $conn->connect()->prepare($sql_PRI3);
                                                        $stmt_PRI3->execute();
                                                        echo  ' <td>';
                                                        $sum[$l3] = 0;
                                                        $sum2 = 0;
                                                        foreach ($stmt_PRI3 as $row_PRI3) {
                                                            echo "- " . $row_PRI3['M_name'] . " : " . $row_PRI3['M_time'] . ' นาที<br>';
                                                            $sum[$l3] = $sum[$l3] + $row_PRI3['M_time'];
                                                        }
                                                        echo  ' </td>';
                                                        $s3 = $l3 - 1;
                                                        if($l3 > 0){
                                                            if($s3 == 0){
                                                                $wait3 = $wait3 + 0;
                                                            }else{
                                                                $wait3 = $wait3 + ($sum[$s3]);
                                                            }
                                                            $total3 = $total3 + $wait3;
                                                        }
                                                         ?>
                                                        <td><?php echo $sum[$l3] . " นาที"; ?> </td>
                                                        <td><?php echo $row_PRI2['time']; ?></td>
                                                        <td><?php echo $row_PRI2['user_fname']; ?> </td>
                                                        <td>

                                                            <div class="input-group input-group-sm ">

                                                                <input type="hidden" name="ord_ID[]" value="<?php echo $row_PRI2['ord_ID']; ?>">
                                                                <?php echo $row_PRI2['priority']; ?>
                                                                <!-- <div class="input-group-append">
                                                                                                                                                                                                                                                                                <button class="btn btn-info btn-sm" type="submit" >บันทึก</button>
                                                                                                                                                                                                                                                                            </div> -->
                                                            </div>

                                                        </td>
                                                    <?php  $l3++; } $i++;  } ;?> 

                                            </tr>
                                            <tr>
                                                <td colspan="6" class="text-right"> 
                                                <h5 class="h5">ระยะเวลารอคอยเฉลี่ย</h5>
                                                </td>
                                                <td>
                                                <h5 class="h5"><?php echo $total3 / ($l3-1)  ?> นาที</h5>
                                                </td>
                                                <!-- <td>
                                                    <button type="submit" class="btn btn-info btn-sm">บันทึก</button>
                                                </td> -->
                                        </form>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php  if($_SESSION['logged'][1] == '1') {  ?>
                <?php if(isset($_GET["date"])){ ?>
                    <div class="text-right">
                        <button class="btn mt-2 btn-primary checkAlgo" date="<?php echo $_GET["date"]; ?>">จัดลำดับคิว</button>
                    </div>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include("templates/footer.php");
    include 'models/select-algorithm.php';
} ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#FCFS").click(function() {
            if ($("#FCFS").prop("checked") == true) {
                $(".FCFS").removeAttr("style");
            } else {
                $(".FCFS").attr("style", "display:none");
            }
        });

        $("#SJF").click(function() {
            if ($("#SJF").prop("checked") == true) {
                $(".SJF").removeAttr("style");
            } else {
                $(".SJF").attr("style", "display:none");
            }
        });

        $("#PRI").click(function() {
            if ($("#PRI").prop("checked") == true) {
                $(".PRI").removeAttr("style");
            } else {
                $(".PRI").attr("style", "display:none");
            }
        });

        $(".checkAlgo").click(function(){
            var NameAlgo = $("input[name='algo']:checked").val();
            var date =  $(this).attr("date");

            if(NameAlgo =="FCFS" || NameAlgo == "SJF" || NameAlgo =="PRI"){
                window.location.href = "check_Algo.php?Name="+NameAlgo+"&date="+date;
            }
        });
    });


</script>
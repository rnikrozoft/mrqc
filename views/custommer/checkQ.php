<?php 
session_start();

    
    include("templates/header.php"); 
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
    

    $sql = "SELECT * FROM `algo_save` WHERE DATE(date)=CURDATE()";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()==1){
      $row = $stmt->FETCH(PDO::FETCH_ASSOC);
      
      if($row["status"]=="FCFS"){ ?>
  <?php
                            $sql_id = "SELECT DISTINCT ord_id from detail where M_name != 'ไม่มี' AND DATE(date)=CURDATE() ORDER BY time ASC";
                            $stmt_id = $conn->connect()->prepare($sql_id);
                            $stmt_id->execute();
                            $result = $stmt_id->fetchAll();
                            $last = count($result);
                            $stmt_id = $conn->connect()->prepare($sql_id);

                            $stmt_id->execute();

                            ?>
                             <!-- Page content -->
    <div class="container-fluid mt--9">
    <div class="FCFS" >
    <div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">ลำดับคิวการซ่อมบำรุง</h3>
                        <?php 
                                    
                                    $date_arry = date("Y/m/d");
                                    $date_explode = explode("/",$date_arry);

                                    $res = changeDate($date_explode[1], $date_explode[0]);

                                    $mount = $res[0];
                                    $year = $res[1];
                                    $day = $date_explode[2];


                                    echo "<h5 class='h5'>รายการซ่อมวันที่ : " . $day . "-" . $mount . "-" . $year . "</h5>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ชื่อ - สกุล ลูกค้า</th>
                                            <th scope="col">รายการซ่อม (นาที)</th>
                                            <th scope="col">ใช้เวลาซ่อม</th>
                                            <th scope="col">เวลาแจ้งซ่อม</th>
                                            <th>เวลาเริ่มต้น</th>
                                            <th>เวลาสิ้นสุด</th>
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
                                                    <td>
                                                <?php 
                                                    if(isset($sumTime)){
                                                        echo  $selectedTime = $sumTime;
                                                    }else{
                                                        echo $selectedTime = "08:00:00 am";
                                                    }
                                                 ?>  
                                                    </td>
                                                    <td>
                                                <?php 
                                                    $endTime = strtotime("+$sum[$l] minutes",strtotime($selectedTime));
                                                    echo $sumTime = date('h:i:s a',$endTime);
                                                ?>
                                                    </td>
                                                    <td><?php echo $row2['user_fname']; ?> </td>
                                                    <?php

                                            $l++; } $i++;  } ;?>
                                        </tr>
                                        <!-- <tr>
                                            <td colspan="5" class="text-right">
                                                <h5 class="h5">ระยะเวลารอคอยเฉลี่ย</h5>
                                            </td>
                                            <td>
                                                <h5 class="h5"><?php echo $total / ($l - 1)  ?> นาที</h5>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php }else if($row["status"]=="SJF"){ ?>
  <?php
                            $sql_SJF = "SELECT DISTINCT ord_id,all_time from detail where M_name != 'ไม่มี' AND DATE(date)=CURDATE() ORDER BY all_time,time ASC";
                            $stmt_SJF = $conn->connect()->prepare($sql_SJF);
                            $stmt_SJF->execute();
                            ?>
                    <!-- Page content -->
                    <div class="container-fluid mt--9">
                    <div class="SJF">
                    <div class="row">
                    <div class="col-xl-12 mb-5 mb-xl-0">
                    <div class="card shadow">
                    <div class="card-header border-0">
                    <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-2">ลำดับคิวการซ่อมบำรุง</h3>
                        <?php 
                                    
                                    $date_arry = date("Y/m/d");
                                    $date_explode = explode("/",$date_arry);

                                    $res = changeDate($date_explode[1], $date_explode[0]);

                                    $mount = $res[0];
                                    $year = $res[1];
                                    $day = $date_explode[2];


                                    echo "<h5 class='h5'>รายการซ่อมวันที่ : " . $day . "-" . $mount . "-" . $year . "</h5>";
                        ?>
                    </div>
                    </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ชื่อ - สกุล ลูกค้า</th>
                                            <th scope="col">รายการซ่อม (นาที)</th>
                                            <th scope="col">ใช้เวลาซ่อม</th>
                                            <th scope="col">เวลาแจ้งซ่อม</th>
                                            <th>เวลาเริ่มต้น</th>
                                            <th>เวลาสิ้นสุด</th>
                                            <th scope="col">ผู้รับผิดชอบ</th>
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
                                    <td>
                                                <?php 
                                                    if(isset($sumTime)){
                                                        echo  $selectedTime = $sumTime;
                                                    }else{
                                                        echo $selectedTime = "08:00:00 am";
                                                    }
                                                 ?>  
                                    </td>
                                                    <td>
                                                <?php 
                                                    $endTime = strtotime("+".$sum[$l2]."minutes",strtotime($selectedTime));
                                                    echo $sumTime = date('h:i:s a',$endTime);
                                                ?>
                                                    </td>
                                    <td><?php echo $row_SJF2['user_fname']; ?> </td>
                                    <?php
                               
                               $l2++; } $i++;  } ;?>
                               </tr> 
                               <!-- <tr>
                                   <td colspan="5" class="text-right">
                                       <h5 class="h5">ระยะเวลารอคอยเฉลี่ย</h5>
                                   </td>
                                   <td>
                                       <h5 class="h5"><?php echo $total2 / ($l2-1)  ?> นาที</h5>
                                   </td>
                               </tr>             -->
                            </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

      <?php }else{ ?>
<?php
                            $sql_PRI = "SELECT DISTINCT ord_id from detail where M_name != 'ไม่มี' AND DATE(date)=CURDATE() ORDER BY priority,time ASC ";
                            $stmt_PRI = $conn->connect()->prepare($sql_PRI);
                            $stmt_PRI->execute();
                            ?>
                                                 <!-- Page content -->
    <div class="container-fluid mt--9">
    <div class="PRI">
    <div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">ลำดับคิวการซ่อมบำรุง</h3>
                        <?php 
                                    
                                    $date_arry = date("Y/m/d");
                                    $date_explode = explode("/",$date_arry);

                                    $res = changeDate($date_explode[1], $date_explode[0]);

                                    $mount = $res[0];
                                    $year = $res[1];
                                    $day = $date_explode[2];


                                    echo "<h5 class='h5'>รายการซ่อมวันที่ : " . $day . "-" . $mount . "-" . $year . "</h5>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ชื่อ - สกุล ลูกค้า</th>
                                            <th scope="col">รายการซ่อม (นาที)</th>
                                            <th scope="col">ใช้เวลาซ่อม</th>
                                            <th scope="col">เวลาแจ้งซ่อม</th>
                                            <th>เวลาเริ่มต้น</th>
                                            <th>เวลาสิ้นสุด</th>
                                            <th scope="col">ผู้รับผิดชอบ</th>
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
                                                        <td>
                                                <?php 
                                                    if(isset($sumTime)){
                                                        echo  $selectedTime = $sumTime;
                                                    }else{
                                                        echo $selectedTime = "08:00:00 am";
                                                    }
                                                 ?>  
                                                    </td>
                                                    <td>
                                                <?php 
                                                    $endTime = strtotime("+$sum[$l3] minutes",strtotime($selectedTime));
                                                    echo $sumTime = date('h:i:s a',$endTime);
                                                ?>
                                                    </td>
                                                        <td><?php echo $row_PRI2['user_fname']; ?> </td>
                                                       
                                                    <?php  $l3++; } $i++;  } ;?>

                                            </tr>
                                            <!-- <tr>
                                                <td colspan="6" class="text-right"> 
                                                <h5 class="h5">ระยะเวลารอคอยเฉลี่ย</h5>
                                                </td>
                                                <td>
                                                <h5 class="h5"><?php echo $total3 / ($l3-1)  ?> นาที</h5>
                                                </td> -->
                                                <!-- <td>
                                                    <button type="submit" class="btn btn-info btn-sm">บันทึก</button>
                                                </td> -->
                                        </form>
                                        <!-- </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                            
<?php      }
    }else{
      echo "ไม่พบข้อมูล";
    } 
?>
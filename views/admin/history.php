<?php
session_start();

if (!isset($_SESSION['logged'])) {
    echo "<script>alert('ไม่สามารถเข้าสู่ระบบได้');</script>";
    echo "<script>window.location.href = 'index.php' ;</script>";
} else {
    include("templates/header.php");
    include("models/newD.php");
    ?>

    <?php
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
                                <h3 class="h5">สถิติรายการซ่อมบำรุง</h3>
                            </div>
                            <div class="col-7">
                                <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="get">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="month" class="form-control" name="date">
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary fa fa-search"></button>
                                        </div>
                                    </div>
                                </form>
                                <?php if (isset($_GET['date'])) {
                                    $date_explode = explode("-", $_GET['date']);

                                    // echo  $date_explode[0] . " " .  $date_explode[1] . " " .  $date_explode[2];
                                    $res = changeDate($date_explode[1], $date_explode[0]);

                                    $mount = $res[0];
                                    $year = $res[1];
                                    // $day = $date_explode[2];

                                    echo "<h5 class='h5'>รายการซ่อมทั้งหมดของเดือน : " . $mount . "-" . $year . "</h5>";
                                } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['date'])) {

                        $sql_id = "SELECT M_name, COUNT(*) AS 'countMname' from detail where date LIKE '$_GET[date]%' group by M_name order by COUNT(*)  DESC";
                        $stmt_id = $conn->connect()->prepare($sql_id);
                        $stmt_id->execute();

                        ?>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">รายการซ่อม</th>
                                        <th scope="col">จำนวนครั้ง</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $val = 0;
                                    foreach ($stmt_id as $row) {

                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                           
                                                <td><?php echo $row['M_name']; ?> </td>
                                                <td><?php echo $row['countMname']; ?></td>
                                            <?php

                                            
                                            $i++; ?>
                                            <input type="hidden" id="m_name<?php echo $i; ?>" mName="<?php echo $row["M_name"]; ?>" countMname="<?php echo $row["countMname"]; ?>" >
                                       <?php }; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" id="count" value="<?php echo $i; ?>">
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Footer -->
        <?php
        include("templates/footer.php");
    }
    ?>
    <script>

    var count = $("#count").val();

    for(i=1;i<count;i++){
        var data = [];
        
        var Mname = $("#m_name"+i).attr("mName");
        // var count_M = $("#m_name"+i).attr("countMname");

        data[i] = Mname;
        // data[i+1] = count_M;

        console.log(data);

    }
    

    // var ctx = document.getElementById('myChart').getContext('2d');
    // var chart = new Chart(ctx, {
    //     // The type of chart we want to create
    //     type: 'horizontalBar',

    //     // The data for our dataset
    //     data: {
    //         labels: [data["M_NAME"]],
    //         datasets: [{
    //             backgroundColor: 'rgb(255, 99, 132)',
    //             borderColor: 'rgb(255, 99, 132)',
    //             data: [data["VAL"]]
    //         }]
    //     },

    //     // Configuration options go here
    //     options: {}
    // });

    </script>
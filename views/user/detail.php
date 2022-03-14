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
                                <h3 class="h5">รายการซ่อมบำรุง</h3>
                            </div>
                            <div class="col-7">
                                <form>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="date" class="form-control" name="date">
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
                                    $day = $date_explode[2];

                                    echo "<h5 class='h5'>รายการซ่อมวันที่ : " . $day . "-" . $mount . "-" . $year . "</h5>";
                                } ?>
                            </div>
                            <div class="col-3 text-right">
                                <button type="button" class="btn btn-sm btn-primary ni ni-fat-add add-data">เพิ่มคิวการซ่อม</button>
                                <!-- data-toggle="modal" data-target="#newdetail" -->
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['date'])) {
                        $sql = "SELECT * FROM detail where M_name != 'ไม่มี' AND date = '$_GET[date]' ORDER BY ord_ID ASC";
                        $stmt = $conn->connect()->prepare($sql);
                        $stmt->execute();


                        $sql_id = "SELECT DISTINCT ord_id from detail where M_name != 'ไม่มี' AND date = '$_GET[date]'";
                        $stmt_id = $conn->connect()->prepare($sql_id);
                        $stmt_id->execute();

                        $sql1 = "SELECT * FROM detail 
                            JOIN maintenance on maintenance.M_name = detail.M_name
                            WHERE detail.date = '$_GET[date]' ";
                        $stmt1 = $conn->connect()->prepare($sql1);
                        $stmt1->execute();

                        ?>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ลำดับคิว</th>
                                        <th scope="col">ชื่อ - สกุล ลูกค้า</th>
                                        <th scope="col">รายการซ่อม</th>
                                        <th scope="col">พนักงานที่รับผิดชอบ</th>
                                        <th scope="col">จัดการข้อมูล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $val = 0;
                                    foreach ($stmt_id as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $i; ?> </td>

                                            <?php
                                            $_id = $row['ord_id'];
                                            $sql2 = "SELECT * FROM detail where ord_id = $_id LIMIT 1 ";
                                            $stmt2 = $conn->connect()->prepare($sql2);
                                            $stmt2->execute();

                                            foreach ($stmt2 as $row2) { ?>
                                                <td>
                                                    <?php echo $row2['customer_name']; ?>
                                                </td>
                                                <?php
                                                $sql3 = "SELECT M_name FROM detail where ord_id = $_id ";
                                                $stmt3 = $conn->connect()->prepare($sql3);
                                                $stmt3->execute();
                                                echo  ' <td>';
                                                foreach ($stmt3 as $row3) {

                                                    $data = [
                                                        $row3['M_name']
                                                    ];
                                                    $arrayName = array(
                                                        'name' => $row3['M_name']
                                                    );
                                                    echo "- " . $row3['M_name']  . '<br>';
                                                }
                                                echo  ' </td>';
                                                ?>

                                                <td>
                                                    <?php echo $row2['user_fname']; ?> </td>
                                                <td>
                                                    <?php
                                                    if ($_SESSION['logged'][1] == '1') {  ?>
                                                        <a href="#" class="btn btn-warning btn-sm update fa fa-edit" role="button" data-data='<?php echo $row2['ord_ID']; ?>' data-date='<?php echo $row2['date'] ?>'></a>

                                                        <!-- <a href="../../controllers/route.php?newdetail=true&select=true&idforUpdate=<?php echo $row2['ord_ID']; ?>&date=<?php echo $row2['date'] ?>" class="btn btn-danger btn-sm fa fa-trash" role="button"></a><a href="#" class="btn btn-warning btn-sm update fa fa-edit" role="button" data-idForUpdate="<?php echo $row['M_ID']; ?>" data-mname="<?php echo $row['M_name']; ?>" data-mtime="<?php echo $row['M_time']; ?>"></a> -->
                                                        <a href="../../controllers/route.php?newdetail=true&delete=true&idFordelete=<?php echo $row2['ord_ID']; ?>&date=<?php echo $row2['date'] ?>" class="btn btn-danger btn-sm fa fa-trash" role="button"></a>
                                                    <?php
                                                }
                                                ?>
                                                </td>
                                            <?php }
                                        $i++;
                                    } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>



        <!-- Footer -->
        <?php
        include("templates/footer.php");
    }
    ?>
    <script>
        $('.update').click(function() {
            var data_str = $(this).attr("data-data");
            var data_date = $(this).attr("data-date");


            $.post("../../controllers/route.php?newdetail=true&select=true&idforUpdate=" + data_str + "&date=" + data_date, function(data) {
                $.post("../../controllers/route.php?newdetail=true&getmaintenance=true", function(datamt) {
                    data = JSON.parse(data);
                    datamt = JSON.parse(datamt);
                    console.log(data);
                    $('.ord_ID').val(data[0][0]);
                    // $('.detail_ID').val(data[0][0]); //ส่งอันนี้ไปทุกครังที่หน้า route.php
                    // $('.m_name').val(data[0][0]);
                    $('#date').val(data[0][5]);
                    var option = "";
                    for (var i = 0; i < data.length; i++) {
                        //onchange=\"updatefunc(this,'"+data[i][1]+"');\"
                        option += "<div class=\"form-group\"><select name=\"maintain[" + i + "]\"  class=\"form-control input-group-alternative m_name\" name=\"m_name\">";
                        for (var j = 0; j < datamt.length; j++) {
                            var iResult = datamt[j][1].localeCompare(data[i][3]);
                            if (iResult == 0) {
                                option += "<option value=\"" + data[i][1] + "," + datamt[j][1] + "\" selected>" + datamt[j][1] + "</option>";
                            } else {
                                option += "<option value=\"" + data[i][1] + "," + datamt[j][1] + "\">" + datamt[j][1] + "</option>";
                            }

                        }
                        option += "</select></div>";
                    }
                    $('.option').html(option);
                    $('#Updetail').modal("show"); //เปิดโมดอลที่มีไอดี Updetail
                });

            });



        });

        function updatefunc(value, id) {
            var value = (value.value || value.options[value.selectedIndex].value);
            var id = id;
            $.post("../../controllers/route.php?newdetail=true&updatedetailmt=true", {
                id: id,
                value: value
            }, function(result) {
                alert('update');
            });
        }

        $('#Updetail').on('hidden.bs.modal', function() {
            location.reload();
        })
        //======================================================================
        $("#list1").click(function(event) { //เมื่อเลือก list 1 จะมาเช็คบรรทัดที่ 124

            if ($("#list1").val() == "ไม่มี") { //เช็คว่าเลือก ไม่มี ใช่ไหม ถ้าใช่ ไปทำบรรทัด 126
                $('#list2').val("ไม่มี"); //ปิดช่อง list 2
                $('#list2').prop("disabled", true); //ปิดช่อง list 2

                $('#list3').val("ไม่มี"); //ปิดช่อง list 2
                $('#list3').prop("disabled", true); //ปิดช่อง list 2

                $('#list4').val("ไม่มี"); //ปิดช่อง list 2
                $('#list4').prop("disabled", true); //ปิดช่อง list 2

                $('#list5').val("ไม่มี"); //ปิดช่อง list 2
                $('#list5').prop("disabled", true); //ปิดช่อง list 2
            } else {
                $('#list2').prop("disabled", false);
            }

            $("#list2").change(function(event) {

                if ($("#list2").val() == "ไม่มี") {
                    $('#list3').val("ไม่มี"); //ปิดช่อง list 2
                    $('#list3').prop("disabled", true);

                    $('#list4').val("ไม่มี"); //ปิดช่อง list 2
                    $('#list4').prop("disabled", true);

                    $('#list5').val("ไม่มี"); //ปิดช่อง list 2
                    $('#list5').prop("disabled", true);
                } else {
                    $('#list3').prop("disabled", false);
                }

                $("#list3").change(function(event) {

                    if ($("#list3").val() == "ไม่มี") {
                        $('#list4').val("ไม่มี"); //ปิดช่อง list 2
                        $('#list4').prop("disabled", true);

                        $('#list5').val("ไม่มี"); //ปิดช่อง list 2
                        $('#list5').prop("disabled", true);
                    } else {
                        $('#list4').prop("disabled", false);
                    }

                    $("#list4").change(function(event) {

                        if ($("#list4").val() == "ไม่มี") {
                            $('#list5').val("ไม่มี"); //ปิดช่อง list 2
                            $('#list5').prop("disabled", true);
                        } else {
                            $('#list5').prop("disabled", false);
                        }
                    });

                });

            });
        });

        //======================================================================
        $(".add-data").click(function() {

            $("#timeUse").val("0");

            $("#newdetail").modal("show");

            var sum = 0;

            $("#list1").click(function() {
                var time1 = $(this).val();
                var name = $("#list1 option:selected").text();
                parseInt(time1);

                $("#timeUse").val(time1);
                $("#list1_mName1").val(name);


                $("#list2").click(function() {
                    var time2 = $(this).val();
                    sum = parseInt(time1) + parseInt(time2);

                    var name = $("#list2 option:selected").text();
                    $("#list1_mName2").val(name);


                    if (isNaN(sum)) {
                        $("#timeUse").val(parseInt(time1));
                        $("#list1_mName2").val("ไม่มี");
                    } else {
                        $("#timeUse").val(sum);
                    }

                    $("#list3").click(function() {
                        var time3 = $(this).val();
                        sum = parseInt(time1) + parseInt(time2) + parseInt(time3);

                        var name = $("#list3 option:selected").text();
                        $("#list1_mName3").val(name);


                        if (isNaN(sum)) {
                            $("#timeUse").val(parseInt(time1) + parseInt(time2));
                            $("#list1_mName3").val("ไม่มี");

                        } else {
                            $("#timeUse").val(parseInt(sum));
                        }

                        $("#list4").click(function() {
                            var time4 = $(this).val();
                            sum = parseInt(time1) + parseInt(time2) + parseInt(time3) + parseInt(time4);

                            var name = $("#list4 option:selected").text();
                            $("#list1_mName4").val(name);


                            if (isNaN(sum)) {
                                $("#timeUse").val(parseInt(time1) + parseInt(time2) + parseInt(time3));
                                $("#list1_mName4").val("ไม่มี");
                            } else {
                                $("#timeUse").val(parseInt(sum));
                            }

                            $("#list5").click(function() {
                                var time5 = $(this).val();
                                sum = parseInt(time1) + parseInt(time2) + parseInt(time3) + parseInt(time4) + parseInt(time5);

                                var name = $("#list5 option:selected").text();
                                $("#list1_mName5").val(name);


                                if (isNaN(sum)) {
                                    $("#timeUse").val(parseInt(time1) + parseInt(time2) + parseInt(time3) + parseInt(time4));
                                    $("#list1_mName5").val("ไม่มี");

                                } else {
                                    $("#timeUse").val(parseInt(sum));
                                }
                            });

                        });

                    });

                });
            });
        });
    </script>
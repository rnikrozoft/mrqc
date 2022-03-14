<div class="modal fade" id="select-algorithm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <?php 
                $sql_id = "SELECT DISTINCT ord_id from detail where M_name != 'ไม่มี' AND date = '$_GET[date]' ORDER BY time ASC ";
                $stmt_id = $conn->connect()->prepare($sql_id);
                $stmt_id->execute();
            ?>
            <form action="test.php" method="GET">
                <input type="hidden" name="time">
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ลำดับคิว</th>
                                <th scope="col">ชื่อ - สกุล ลูกค้า</th>
                                <th scope="col">รายการซ่อม (นาที)</th>
                                <th scope="col">เวลาที่บันทึกข้อมูล</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i=1; 
                            $val = 0;
                            foreach($stmt_id as $row){ 
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                        <?php
                            $_id = $row['ord_id'];
                            $sql2 = "SELECT * FROM detail where ord_id = $_id LIMIT 1 ";
                            $stmt2 = $conn->connect()->prepare($sql2);
                            $stmt2->execute();
                            foreach ($stmt2 as $row2){ 
                        ?>
                        <td><?php echo $row2['customer_name']; ?></td>
                        <?php 
                            $sql3 = "SELECT M_name FROM detail where ord_id = $_id ";
                            $stmt3 = $conn->connect()->prepare($sql3);
                            $stmt3->execute();
                            echo  ' <td>' ; 
                            $j =1;
                            foreach ($stmt3 as $row3 ) {
                                echo "<span name='span".$j."'>- ".$row3['M_name']  . '</span><br>';
                            $j++;
                            }
                            echo  ' </td>' ; 
                        ?>
                        <td><?php echo $row2['time']; ?></td>
                        <?php
                            } $i++; } 
                        ?>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="j" value="<?php echo $j ?>">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="date" value="<?php echo $_GET['date']; ?>">ยืนยัน</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
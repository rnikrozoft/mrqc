<div class="modal fade" id="select-algorithm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ลำดับคิวการซ่อม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <?php 
                $sql_id = "SELECT DISTINCT ord_id from detail where M_name != 'ไม่มี' AND date = '$_GET[date]' ORDER BY time ASC ";
                $stmt_id = $conn->connect()->prepare($sql_id);
                $stmt_id->execute();
            ?>
            <form action="home.php" method="POST">
                <input type="hidden" name="time">
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ลำดับคิว</th>
                                <th scope="col">ชื่อ - สกุล ลูกค้า</th>
                                <th scope="col">รายการซ่อม (นาที)</th>
                                <th scope="col">เวลาที่แจ้งซ่อม</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i=1; 
                            $j=1;
                            $val = 0;
                            foreach($stmt_id as $row){ 
                        ?>
                                <tr><td><?php echo $i; ?></td>
                                <?php
                                    $_id = $row['ord_id'];
                                    $sql2 = "SELECT customer_name,user_fname,time FROM detail where ord_id = $_id LIMIT 1 ";
                                    $stmt2 = $conn->connect()->prepare($sql2);
                                    $stmt2->execute();
                                    
                                    foreach ($stmt2 as $row2){ 
                                        ?>
                                        <td><?php echo $row2['customer_name']; ?></td>
                                        <?php 
                                            $sql3 = "SELECT detail.M_name,maintenance.M_time 
                                                    FROM detail JOIN maintenance
                                                    ON detail.M_name = maintenance.M_name
                                                    where detail.ord_id = $_id ";
                                            $stmt3 = $conn->connect()->prepare($sql3);
                                            $stmt3->execute();
                                            echo  ' <td>' ; 
                                            foreach ($stmt3 as $row3 ) {
                                                echo "- ".$row3['M_name']." : ".$row3['M_time']  . ' นาที<br>';
                                                $arr_mName[$i][$j] = $row3['M_name'];
                                                $arr_mTime[$i][$j] = $row3['M_time'];
                                                $j++;
                                            }
                                            echo  '</td>' ; 
                                        ?>
                                            <td><?php echo $row2['time']; ?></td>
                                        <?php

                                    } 
                                    $arr_i[$i] = $i;
                                    $arr_name[$i] = $row2['customer_name'];
                                    $i++; 
                                } 
                                ?>
                                <input type="hidden" name="data_i" value="<?php print_r($arr_i); ?>">
                                <input type="hidden" name="data_name" value="<?php print_r($arr_name); ?>">
                                <input type="hidden" name="data_mName" value="<?php print_r($arr_mName); ?>">
                                <input type="hidden" name="data_mTime" value="<?php print_r($arr_mTime); ?>">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info ni ni-check-bold" name="date" value="<?php echo $_GET['date']; ?>"></button>
                    <button type="reset" class="btn btn-danger ni ni-fat-remove" data-dismiss="modal"></button>
                </div>
            </form>
        </div>
    </div>
</div>
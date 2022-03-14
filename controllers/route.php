<?php

// ==========Authen==========
if (isset($_REQUEST['authen'])) {
    require_once 'authen.php';
    $conn = new AuthenticationsControllers();

    // login
    if (isset($_POST['login'])) {
        $mData = [
            $_POST['username'],
            $_POST['password'],
        ];

        if ($row = $conn->login($mData)) {
            session_start();
            $_SESSION['logged'] = [
                $row['user_fname'],
                $row['position_ID']
            ];

            if ($_SESSION['logged'][1] == '1') {
                header("Location:../views/admin/home.php");
            } else {
                header("Location:../views/user/home.php");
            }
        } else {
            echo "<script>alert('ไม่สามารถเข้าสู่ระบบได้');</script>";
            echo "<script>window.location.href = '../views/admin/index.php' ;</script>";
        }
    }

    // logout
    if (isset($_GET['logout'])) {
        session_start();
        session_destroy();
        header("Location:../views/admin/index.php");
    }
}
// ==========Authen==========



// ==============================
if (isset($_REQUEST['newuser'])) { //ชื่อใต้ฟอร์ม

    require_once 'newuser.php';
    $conn = new newuser();

    // newuser
    if (isset($_POST['insert'])) { //ชื่อปุ่ม

        $mData = [
            $_POST['position_ID'],
            $_POST['user_fname'],
            $_POST['user_fday'],
            $_POST['address'],
            $_POST['birthday'],
            $_POST['id_card'],
            $_POST['username'],
            $_POST['password'],
        ];

        if ($row = $conn->insert($mData)) {
            header("Location:../views/admin/user.php");
        } else {
            echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
            echo "<script>window.location.href = '../views/admin/user.php' ;</script>";
        }
    }
    // header("Location:../views/admin/user.php");
    // update
    //   if(isset($_POST['update'])){
    //     $mData = [
    //         $_POST['fname'],
    //         $_POST['fday'],
    //         $_POST['add'],
    //         $_POST['brith'],
    //         $_POST['idcard'],
    //         $_POST['idForUpdate']
    //     ];

    //     if ($row = $conn->update($mData)) {
    //         header("Location:../views/admin/user.php");
    //         } else {
    //             echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
    //             echo "<script>window.location.href = '../views/admin/user.php' ;</script>";
    //         }
    // }

    // ==============================

    // delete
    if (isset($_GET['delete'])) {
        $mData =  $_GET['idFordelete'];


        if ($row = $conn->delete($mData)) {
            header("Location:../views/admin/user.php");
        } else {
            echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
            echo "<script>window.location.href = '../views/admin/user.php' ;</script>";
        }
    }
}
// ==============================




// ==============================
if (isset($_REQUEST['customers'])) {

    require_once 'newcustomer.php';
    $conn = new newcustomer();

    // insert
    if (isset($_POST['insert'])) {
        $mData = [
            $_POST['C_idcard'],
            $_POST['car_detail'],
            $_POST['customer_name'],
            $_POST['address'],
            $_POST['email'],
            $_POST['phone_num'],
        ];
        if ($row = $conn->insert($mData)) {
            header("Location:../views/admin/customer.php");
        } else {
            echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
            echo "<script>window.location.href = '../views/admin/customer.php' ;</script>";
        }
    }

    // update
    if (isset($_POST['update'])) {
        $mData = [
            $_POST['idc'],
            $_POST['cdetail'],
            $_POST['cname'],
            $_POST['add'],
            $_POST['mail'],
            $_POST['phone'],
            $_POST['idForUpdate']
        ];

        if ($row = $conn->update($mData)) {
            header("Location:../views/admin/customer.php");
        } else {
            echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
            echo "<script>window.location.href = '../views/admin/customer.php' ;</script>";
        }
    }

    // ==============================

    // delete
    if (isset($_GET['delete'])) {
        $mData =  $_GET['idFordelete'];


        if ($row = $conn->delete($mData)) {
            header("Location:../views/admin/customer.php");
        } else {
            echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
            echo "<script>window.location.href = '../views/admin/customer.php' ;</script>";
        }
    }
}
// ==============================

// ==============================
if (isset($_REQUEST['newuser'])) { //ชื่อใต้ฟอร์ม

    require_once 'newuser.php';
    $conn = new newuser();

    // // newuser
    // if(isset($_POST['insert'])){ //ชื่อปุ่ม

    //     $mData = [
    //         $_POST['position_ID'],
    //         $_POST['user_fname'],
    //         $_POST['user_fday'],
    //         $_POST['address'],
    //         $_POST['birthday'],
    //         $_POST['id_card'],
    //         $_POST['username'],
    //         $_POST['password']
    //     ];

    //     if ($row = $conn->insert($mData)) {
    //         header("Location:../views/admin/user.php");
    //         } else {
    //             echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
    //             echo "<script>window.location.href = '../views/admin/user.php' ;</script>";
    //         }
    // }

    // update
    if (isset($_POST['update'])) { //ชื่อปุ่ม

        $mData = [
            $_POST['user_fname'],
            $_POST['user_fday'],
            $_POST['address'],
            $_POST['birthday'],
            $_POST['id_card'],
            // $_POST['password'],
            $_POST['idForUpdate'] //ส่งอันนี้มาทุกครังเพื่อเป็นตัวบอกว่าจะอัพเดทไอดีไหน

        ];

        if ($row = $conn->update($mData)) {
            header("Location:../views/admin/user.php");
        } else {
            echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
            echo "<script>window.location.href = '../views/admin/user.php' ;</script>";
        }
    }
}
// ==============================

// ==============================
if (isset($_REQUEST['newmaintenance'])) {

    require_once 'newmaintenance.php';
    $conn = new newmaintenance();

    // newmaintenance
    if (isset($_POST['insert'])) {
        $mData = [
            $_POST['M_name'],
            $_POST['M_time'],

        ];
        if ($row = $conn->insert($mData)) {
            header("Location:../views/admin/maintenance.php");
        } else {
            echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
            echo "<script>window.location.href = '../views/admin/maintenance.php' ;</script>";
        }
    }


    // update
    if (isset($_POST['update'])) {

        $mData = [
            $_POST['M_name'],
            $_POST['M_time'],
            $_POST['idForUpdate'] //ตัวนี้เป็นไอดีที่จะเอาไป where ใน mysql
        ];

        if ($row = $conn->update($mData)) {
            header("Location:../views/admin/maintenance.php");
        } else {
            echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
            echo "<script>window.location.href = '../views/admin/maintenance.php' ;</script>";
        }
    }

    // ==============================

    // delete
    if (isset($_GET['delete'])) {
        $mData =  $_GET['idFordelete'];


        if ($row = $conn->delete($mData)) {
            header("Location:../views/admin/maintenance.php");
        } else {
            echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
            echo "<script>window.location.href = '../views/admin/maintenance.php' ;</script>";
        }
    }
}
// ==============================





// ==============================

if (isset($_REQUEST['newdetail'])) {

    require_once 'newdetail.php';
    $conn = new newdetail();

    require_once 'includes/connectDB.php';
    $connectDB = new connectDB();

    if (isset($_GET['select'])) {
        $sql = "SELECT * FROM `detail` WHERE `ord_ID` = '" . $_GET['idforUpdate'] . "'";
        $stmt = $connectDB->connect()->prepare($sql); // ทำการติดต่อ mysql

        $stmt->execute();
        $orderObject = array();
        $orderObject = $stmt->fetchAll();
        echo json_encode($orderObject, JSON_UNESCAPED_UNICODE);
        exit;
    }
    if (isset($_GET['updatedetailmt'])) {
        $sql = "UPDATE `detail` SET `M_name`= '" . $_POST["value"] . "' WHERE `detail_ID` = '" . $_POST["id"] . "' ";
        $stmt = $connectDB->connect()->prepare($sql); // ทำการติดต่อ mysql
        $stmt->execute();
        exit;
    }

    if (isset($_GET['updateM'])) {

        $time = array();
        

        for ($i = 0; $i < sizeof($_POST['maintain']); $i++) {
                $data = explode(',', $_POST['maintain'][$i]);
                $sqlTime = "SELECT M_time from maintenance WHERE M_name = '$data[1]' ";
                $stmt = $connectDB->connect()->prepare($sqlTime); // ทำการติดต่อ mysql
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $resultTime[] = $row["M_time"];
        }
        $test = array_sum($resultTime);

        for ($i = 0; $i < sizeof($_POST['maintain']); $i++) {
            $data = explode(',', $_POST['maintain'][$i]);
            $sql = "UPDATE `detail` SET `M_name`= '" . $data[1] . "', all_time = '".$test."' WHERE `detail_ID` = '" . ($i + 1) . "' AND ord_ID = '" . $_POST["ord_ID"] . "' ";
            $stmt = $connectDB->connect()->prepare($sql); // ทำการติดต่อ mysql
            $stmt->execute();
        }

        header("Location: ../views/admin/detail.php?date=" . $_POST['date']);
    }


    if (isset($_GET['getmaintenance'])) {
        $sql = "SELECT * FROM `maintenance` WHERE 1";
        $stmt = $connectDB->connect()->prepare($sql); // ทำการติดต่อ mysql

        $stmt->execute();
        $orderObject = array();
        $orderObject = $stmt->fetchAll();
        echo json_encode($orderObject, JSON_UNESCAPED_UNICODE);
    }

    // newdetail
    if (isset($_POST['insert'])) {

        echo $sql = "SELECT * FROM detail ORDER BY ord_ID DESC LIMIT 1"; //หาค่า ord_ID ที่มากที่สุดในตาราง detail มา 1 ค่า
        $stmt = $connectDB->connect()->prepare($sql); // ทำการติดต่อ mysql
        $stmt->execute(); // ทำการติดต่อ mysql

        $row = $stmt->fetch(PDO::FETCH_ASSOC); //เอาค่า ord_ID ที่ได้มาเก็บใน row

        $last_id = $row['ord_ID'] + 1; //ประกาศตัวแปร last_id มาเก็บ ค่า row + 1

        $count = 0; //ประกาศ count = 0

        if (isset($_POST['M_ID1'])) {
            if ($_POST['M_ID1'] == "ไม่มี") {
                $count == 0;
            } else {
                $count += 1;
            }
        }
        if (isset($_POST['M_ID2'])) {
            if ($_POST['M_ID2'] == "ไม่มี") {
                $count == 0;
            } else {
                $count += 1;
            }
        }
        if (isset($_POST['M_ID3'])) {
            if ($_POST['M_ID3'] == "ไม่มี") {
                $count == 0;
            } else {
                $count += 1;
            }
        }
        if (isset($_POST['M_ID4'])) {
            if ($_POST['M_ID4'] == "ไม่มี") {
                $count == 0;
            } else {
                $count += 1;
            }
        }
        if (isset($_POST['M_ID5'])) {
            if ($_POST['M_ID5'] == "ไม่มี") {
                $count == 0;
            } else {
                $count += 1;
            }
        }

        for ($i = 1; $i < $count + 1; $i++) { // วนลูปตามค่า count

            $mData = [
                $i,
                $_POST['customer_ID'],
                $_POST['list1_mName' . $i],
                $_POST['user_ID'],
                $_POST['date'],
                $last_id,
                $_POST['timeUse'],
                $_POST['priority']
            ];

            // print_r($mData);
            if ($conn->insert($mData)) {
                header("Location:../views/admin/detail.php?date=$mData[4]");
            }
            // else {
            //     echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
            //     echo "<script>window.location.href = '../views/admin/detail.php' ;</script>";
            // }

            // print_r($mData);
        }
    }



    // update
    if (isset($_POST['update'])) {

        $mData = [

            $_POST['m_name'],

            $_POST['ord_ID'],
            $_POST['maintain']
        ];

        // if ($row = $conn->update($mData)) {
        //     header("Location:../views/admin/detail.php");
        // } else {
        //     echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
        //     echo "<script>window.location.href = '../views/admin/detail.php' ;</script>";
        // }
        print_r($mData);
    }


    // delete
    if (isset($_GET['delete'])) {
        $mData =  [
            $_GET['idFordelete'],
            $_GET['date']
        ];
        if ($row = $conn->delete($mData)) {
            header("Location:../views/admin/detail.php?date=$mData[1]");
        }
    }

    if (isset($_POST['updatePriorityall'])) {

        for ($i = 0; $i < sizeof($_POST['ord_ID']); $i++) {
            $mData = [
                $_POST['ord_ID'][$i],
                $_POST['updatePriority'][$i],
                $_POST['date']
            ];
            $row = $conn->updatePriority($mData);
            header("Location:../views/admin/Qdetail.php?date=$mData[2]");
        }
    }

    // deletepriority
    if (isset($_GET['deletepriority'])) {
        $mData =  [
            $_GET['deletepriority'],
            $_GET['date']
        ];
        if ($row = $conn->delete($mData)) {
            header("Location:../views/admin/Qdetail.php?date=$mData[1]");
        }
    }
}

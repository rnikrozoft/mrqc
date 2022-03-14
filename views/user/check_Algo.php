<?php 
    require_once '../../controllers/includes/connectDB.php';
    $conn = new connectDB();

    //    // หาค่าวันที่ในตาราง algo_save ก่อรว่ามีวันที่เลือกจาก $_GET["date"] ไหม
    //    //select date from algo_save where date = $_GET["date"]

    //    //หลังจากหาเสร็จ ก็เช็คว่า หาเจอไหม ถ้าเจอให้ทำ update ถ้าไม่เจอทำ insert

       $sql = "SELECT date FROM `algo_save` WHERE date = '$_GET[date]' ";
       $stmt = $conn->connect()->prepare($sql);
       $stmt->execute();

       if($stmt->rowCount()==1){
            $sql = "UPDATE `algo_save` SET `status`= '$_GET[Name]' WHERE date = '$_GET[date]' ";
            $stmt = $conn->connect()->prepare($sql);
            $stmt->execute();
       }else{
            $sql = "INSERT INTO `algo_save`(`date`, `status`) VALUES ('$_GET[date]','$_GET[Name]')";
            $stmt = $conn->connect()->prepare($sql);
            $stmt->execute();
       }

    header("Location:home.php?date=".$_GET["date"]."");
?>
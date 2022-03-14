<?php require_once 'includes/connectDB.php';

class newdetail extends connectDB
{



    public function insert($mData)
    {

        $sql = "INSERT INTO `detail`(`ord_ID`, `detail_ID`, `customer_name`, `M_name`, `user_fname`, `date`, `time`, `priority`, `all_time`)
                VALUES (:ord_ID,:detail_ID,:customer_name,:M_name,:user_fname,:date,NOW(),:priority,:all_time)";
        $stmt = $this->connect()->prepare($sql);

        try {
            $stmt->execute(
                array(
                    ":ord_ID" => $mData[5],
                    ":detail_ID" => $mData[0],
                    ":customer_name" => $mData[1],
                    ":M_name" => $mData[2],
                    ":user_fname" => $mData[3],
                    ":date" => $mData[4],
                    ":priority" => $mData[7],
                    ":all_time" => $mData[6],
                )
            );

            if ($stmt->rowCount() >= 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
            // return false;
        }
    }

    public function update($mData)
    {

        $sql = "UPDATE `detail` 
                SET 
                    `M_name`=:maintain
                    
                WHERE ord_ID = :ord_ID AND detail_ID = :detail_ID";
        $stmt = $this->connect()->prepare($sql);

        try {

            $stmt->execute(
                array(

                    ":maintain" => $mData[0],
                    ":ord_ID" => $mData[1],
                    ":detail_ID" => $mData[2]

                )
            );

            if ($stmt->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // echo $e->getMessage();
            return false;
        }
    }

    public function delete($mData)
    {

        $sql = "DELETE FROM `detail` WHERE `ord_ID` = :idFordelete";
        $stmt = $this->connect()->prepare($sql);

        try {
            $stmt->execute(
                array(
                    ":idFordelete" => $mData[0]
                )
            );

            return true;
        } catch (PDOException $e) {
            // echo $e->getMessage();
            return false;
        }
    }

    public function updatePriority($mData)
    {

        $sql = "UPDATE `detail`
                SET `priority`= :priority WHERE ord_ID = :ord_ID";
        $stmt = $this->connect()->prepare($sql);

        try {
            $stmt->execute(
                array(
                    ":priority" => $mData[1],
                    ":ord_ID" => $mData[0]
                )
            );

            return true;
        } catch (PDOException $e) {
            // echo $e->getMessage();
            return false;
        }
    }
    public function deletepriority($mData)
    {


        $sql = "DELETE FROM `detail` WHERE `priority` = :deletepriority";
        $stmt = $this->connect()->prepare($sql);

        try {
            $stmt->execute(
                array(
                    ":deletepriority" => $mData[0]
                )
            );

            return true;
        } catch (PDOException $e) {
            // echo $e->getMessage();
            return false;
        }
    }
}

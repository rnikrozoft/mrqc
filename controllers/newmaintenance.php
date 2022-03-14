<?php require_once 'includes/connectDB.php';

class newmaintenance extends connectDB
{

    public function insert ($mData)
    {

        $sql = "INSERT INTO `maintenance` (`M_name`, `M_time`) 
        VALUES (:M_name, :M_time)";
        $stmt = $this->connect()->prepare($sql);

        try {

            $stmt->execute(
                array(
                    ":M_name" => $mData[0],
                    ":M_time" => $mData[1],
                    
                ));

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

    public function update ($mData)
    {

        $sql = "UPDATE `maintenance` SET `M_name`= :M_name,`M_time`= :M_time WHERE M_ID = :idForUpdate";
        $stmt = $this->connect()->prepare($sql);

        try {

            $stmt->execute(
                array(
                    ":M_name" => $mData[0],
                    ":M_time" => $mData[1],
                    "idForUpdate" => $mData[2]
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

    public function delete ($mData)
    {

        $sql = "DELETE FROM `maintenance` WHERE `M_ID` = :idFordelete";
        $stmt = $this->connect()->prepare($sql);

        try {

            $stmt->execute(
        array( 
            ":idFordelete" => $mData
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
}
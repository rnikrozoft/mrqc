<?php require_once 'includes/connectDB.php';

class newcustomer extends connectDB
{

    public function insert ($mData)
    {

        $sql = "INSERT INTO `customer` (`customer_ID`, `C_idcard`, `car_detail`, `customer_name`, `address`, `email`, `phone_num`) 
        VALUES (NULL, :C_idcard, :car_detail, :customer_name, :address, :email, :phone_num)";
        $stmt = $this->connect()->prepare($sql);

        try {

            $stmt->execute(
                array(
                    ":C_idcard" => $mData[0],
                    ":car_detail" => $mData[1],
                    ":customer_name" => $mData[2],
                    ":address" => $mData[3],
                    ":email" => $mData[4],
                    ":phone_num" => $mData[5],
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

        $sql = "UPDATE `customer` SET 
                                        `C_idcard`= :C_idcard,
                                        `car_detail`= :car_detail,
                                        `customer_name`= :customer_name,
                                        `address`=:address,
                                        `email`=:email,
                                        `phone_num`=:phone_num 
                                        WHERE customer_ID = :idForUpdate";
        $stmt = $this->connect()->prepare($sql);

        try {

            $stmt->execute(
                array(
                    ":C_idcard" => $mData[0],
                    ":car_detail" => $mData[1],
                    ":customer_name" => $mData[2],
                    ":address" => $mData[3],
                    ":email" => $mData[4],
                    ":phone_num" => $mData[5],
                    ":idForUpdate" => $mData[6],

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
    public function delete ($mData)
    {

        $sql = "DELETE FROM `customer` WHERE `customer_ID` = :idFordelete";
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


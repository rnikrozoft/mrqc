<?php require_once 'includes/connectDB.php';

class newuser extends connectDB
{

    public function insert($mData)
    {

        $sql = "INSERT INTO `user`(`position_ID`, `user_fname`, `user_fday`, `address`, `birthday`, `id_card`, `username`, `password`) 
                VALUES (:position_ID,:user_fname,:user_fday,:address,:birthday,:id_card,:username,:password)";
        $stmt = $this->connect()->prepare($sql);

        try {

            $stmt->execute(
                array(
                    ":position_ID" => $mData[0],
                    ":user_fname" => $mData[1],
                    ":user_fday" => $mData[2],
                    ":address" => $mData[3],
                    ":birthday" => $mData[4],
                    ":id_card" => $mData[5],
                    ":username" => $mData[6],
                    ":password" => $mData[7],
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

        $sql = "UPDATE `user` 
                SET `user_fname`=:user_fname,
                    `user_fday`=:user_fday,   
                    `address`=:address,
                    `birthday`=:birthday,
                    `id_card`=:id_card
                WHERE user_ID = :idForUpdate";
        $stmt = $this->connect()->prepare($sql);

        try {

            $stmt->execute(
                array(
                    ":user_fname" => $mData[0],
                    ":user_fday" => $mData[1],
                    ":address" => $mData[2],
                    ":birthday" => $mData[3],
                    ":id_card" => $mData[4],
                    ":idForUpdate" => $mData[5], //ส่งอันนี้มาทุกครังเพื่อเป็นตัวบอกว่าจะอัพเดทไอดีไหน
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

        $sql = "DELETE FROM `user` WHERE `user_ID` = :idFordelete";
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
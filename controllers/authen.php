<?php require_once 'includes/connectDB.php';

class AuthenticationsControllers extends connectDB
{

    public function login($mData)
    {

        $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
        $stmt = $this->connect()->prepare($sql);

        try {

            $stmt->execute(
                array(
                    ":username" => $mData[0],
                    ":password" => $mData[1]
                ));

            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            // echo $e->getMessage();
            return false;
        }
    }
}
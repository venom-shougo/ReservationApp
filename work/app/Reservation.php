<?php

namespace Reservation\Reserve;
use Reservation\DB\Database;

class Reserve extends Database
{
    protected $tableName = 'reserve';

    public function registerReservation(array $reserveData):bool
    {
        $result = false;
        $sql = "INSERT INTO
                    $this->tableName(reserve_date, reserve_time, reserve_num, name, email, tel, comment)
                VALUES
                    (:reserve_date, :reserve_time, :reserve_num, :name, :email, :tel, :comment)";
        $pdo = $this->connect();
        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':reserve_date', (string)$reserveData['reserve_date'], \PDO::PARAM_STR);
            $stmt->bindValue(':reserve_time', (string)$reserveData['reserve_time'], \PDO::PARAM_STR);
            $stmt->bindValue(':reserve_num', (string)$reserveData['reserve_num'], \PDO::PARAM_INT);
            $stmt->bindValue(':name', (string)$reserveData['name'], \PDO::PARAM_STR);
            $stmt->bindValue(':email', (string)$reserveData['email'], \PDO::PARAM_STR);
            $stmt->bindValue(':tel', (string)$reserveData['tel'], \PDO::PARAM_STR);
            $stmt->bindValue(':comment', (string)$reserveData['comment'], \PDO::PARAM_STR);
            $result = $stmt->execute();
            $pdo->commit();
            return $result;
        } catch(\PDOException $e) {
            $pdo->rollback();
            echo 'DB登録失敗' . $e->getMessage();
            return $result;
        }
    }
}

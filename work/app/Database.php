<?php
namespace Reservation\DB;
class Database
{
    protected $tableName;

    /**
     * データベース接続
     *
     * @return 
     */
    public static function connect(): \PDO
    {
        try {
        $pdo = new \PDO(
            DSN, DB_USER, DB_PASS,
            [
                \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
            return $pdo;
        } catch (\PDOException $e) {
        echo '接続エラー' . $e->getMessage();
        exit;
        }
    }

    /**
     * ショップデータ取得
     *
     * @param string $shopId
     * @return array|boolean
     */
    public static function getShopData(string $shopId): array|bool
    {
        $result = false;
        $sql = "SELECT * FROM shop WHERE id = :id";
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $shopId, \PDO::PARAM_STR);
            $stmt->execute();
            $shopId = $stmt->fetch();
            return $shopId;
        } catch(\PDOException $e) {
            echo 'データ取得失敗' . $e->getMessage();
            return $result;
        }
    }

    public static function getReservationLimit(string $reserve_date, string $reserve_time): string|bool
    {
        $result = false;
        $sql = "SELECT
                    SUM(reserve_num)
                FROM reservation
                WHERE DATE_FORMAT(reserve_date, '%Y%m%d') = :reserve_date
                AND DATE_FORMAT(reserve_time, '%H:%i') = :reserve_time
                GROUP BY
                    reserve_date, reserve_time
                LIMIT 1";
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':reserve_date', $reserve_date, \PDO::PARAM_STR);
            $stmt->bindValue(':reserve_time', $reserve_time, \PDO::PARAM_STR);
            $stmt->execute();
            $reservCount = $stmt->fetchColumn();
            return $reservCount;
        } catch(\PDOException $e) {
            echo 'データ取得失敗' . $e->getMessage();
            return $result;
        }

    }
}

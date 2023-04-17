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
    protected function connect(): \PDO
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
    public function getShopData(string $shopId): array|bool
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

    /**
     * ショップ登録前同一ID検証
     *
     * @param integer $shopId
     * @return boolean
     */
    public function identityValidation(string $shopId): bool
    {
        $result = false;
        $sql = "SELECT COUNT(id) FROM shop WHERE shop_id = :shop_id";

        try {
            $stmt = self::connect()->prepare($sql);
            $stmt->bindValue(':shop_id', $shopId, \PDO::PARAM_STR);
            $stmt->execute();
            $shopId = $stmt->fetch();
            if ($shopId['COUNT(id)'] == SAME_ID_COUNT) {
                $result = true;
                return $result;
            } else {
                return $result;
            }
        } catch (\PDOException $e) {
            echo '同一ID検証失敗' . $e->getMessage();
            return $result;
        }
    }

    /**
     * ショップログイン
     *
     * @param string $shopId
     * @param string $shopPass
     * @return array|bool
     */
    public function shopLogin(string $shopId, string $shopPass):array|bool
    {
        $result = false;
        $sql = "SELECT * FROM shop WHERE shop_id = :shop_id AND password = :password LIMIT 1";

        try {
            $stmt = self::connect()->prepare($sql);
            $stmt->bindValue(':shop_id', $shopId, \PDO::PARAM_STR);
            $stmt->bindValue(':password', $shopPass, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch(\Exception $e) {
            echo 'ログイン失敗' . $e->getMessage();
            return $result;
        }
    }

    /**
     * 予約者の予約日時から予約可能人数を取得
     *
     * @param string $reserve_date
     * @param string $reserve_time
     * @return string|boolean
     */
    public function getReservationLimit(string $reserve_date, string $reserve_time): string|bool
    {
        $reservCount = false;
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
            return $reservCount;
        }
    }

    /**
     * 予約リストから予約者取得
     *
     * @param string $year
     * @param string $month
     * @return array|boolean
     */
    public function getReservationInformation(string $year, string $month): array|bool
    {
        $result = false;
        $sql = "SELECT
                    *
                FROM reservation
                WHERE DATE_FORMAT(reserve_date, '%Y%m') = :yyyymm
                ORDER BY
                    reserve_date, reserve_time";
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':yyyymm', $year.$month, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch(\PDOException $e) {
            echo 'データ取得失敗' . $e->getMessage();
            return $result;
        }

    }


}

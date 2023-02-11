<?php
namespace Reservation\DB;
class Database
{
    protected $tableName;
    public static function connect()
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

    public static function getShopData(string $shopId): array|bool
    {
        $result = false;
        $sql = "SELECT * FROM shops WHERE id = :id";
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
}

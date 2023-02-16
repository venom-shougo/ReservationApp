<?php
namespace Reservation\Shop;
use Reservation\DB\Database;
/**
 * クラス定義
 * class UserLogicは連想配列で値を使う
 */
class ShopLogic extends Database
{
    private string $shopName;
    private string $shopId;
    private string $shopEmail;
    private string $shopPassword;

    public function __construct($shopNameNew, $shopIdNew, $shopEmailNew, $shopPassNew)
    {
        $this->shopName = $shopNameNew;
        $this->shopId = $shopIdNew;
        $this->shopEmail = $shopEmailNew;
        $this->shopPassword = password_hash($shopPassNew, PASSWORD_DEFAULT);
    }
    /**
   * 同じメールアドレスをチェック
   * @return bool $result true|false
   */
    public function createShop()
    {
        $result = false;
        $sql = "INSERT INTO shop
                    (shop_name, shop_id, email, password)
                VALUES
                    (:shop_name, :shop_id, :email, :password)";
        $pdo = $this->connect();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':shop_name', $this->shopName, \PDO::PARAM_STR);
            $stmt->bindValue(':shop_id', $this->shopId, \PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->shopEmail, \PDO::PARAM_STR);
            $stmt->bindValue(':password', $this->shopPassword, \PDO::PARAM_STR);
            $result = $stmt->execute();
            $pdo->commit();
        } catch (\PDOException $e) {
            $pdo->rollback();
            echo 'ショップ登録失敗' . $e->getMessage();
            return $result;
        }
        return $result;
    }

    /**
     * メールアドレス仮登録
     * @param array $temporary
     * @return bool $result
     */
    // public static function registerEmail($temporary)
    // {
    //     $result = false;

    //     $sql = "INSERT INTO users (email, register_token, register_token_sent_at) VALUES (:email, :register_token, :register_token_at)";


    //     $email = $temporary['email'];
    //     // var_dump($email);
    //     $token = Token::registerToken();
    //     // var_dump($token);
    //     // exit;
    //     try {
    //         Database::connect()->beginTransaction();
    //         $stmt = Database::connect()->prepare($sql);
    //         $stmt->bindValue(':email', $email, \PARAM_STR);
    //         $stmt->bindValue(':register_token', $token,\PARAM_STR);
    //         $stmt->bindValue(':register_token_at', (new DateTime())->format('Y-m-d H:i:s'));
    //         $stmt->execute();

    //         mb_language("Japanese");
    //         mb_internal_encoding("UTF-8");

    //         $url = 'http://http://localhost:8561/register.php?token={$token}';
    //         $subject = '会員登録ありがとうございます';
    //         $body = <<<EOD
    //         会員登録ありがとうございます！

    //         24時間以内に下記URLへアクセスし本登録を完了してください。
    //         {$url}
    //         EOD;

    //         // $headers = 'From:' . mb_encode_mimeheader(wb.work.atelier@gmail.com) . '<' . '>';

    //         // $isSent = mb_send_mail($email,  $subject, $body, $headers);
    //         $result = Database::connect()->commit();
    //         return $result;
    //     } catch(PDOException $e) {
    //         Database::connect()->rollBack();
    //         echo '失敗しました' . $e->getMessage();
    //         return $result;
    //     }
    // }


    // /**
    //  * ユーザ取得
    //  */
    // public static function getUsers()
    // {
    //     $sql = "SELECT * FROM users";

    //     try {
    //         $stmt = Database::connect()->query($sql);
    //         $user = $stmt->fetch();
    //         return $user;
    //     } catch (PDOException $e) {
    //         return false;
    //     }
    // }
}

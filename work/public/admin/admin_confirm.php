<?php
require_once(__DIR__ . '/../../app/config.php');
use Reservation\Shop\ShopLogic;

$error = [];
var_dump($_SESSION['signup']);
//* 確定ボタンが押されたらPOST判定
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //* セッションの値を変数に代入
    $shopName = $_SESSION['signup']['shop_name'];
    $shopId = $_SESSION['signup']['shop_id'];
    $shopemail = $_SESSION['signup']['email'];
    $shopPass = $_SESSION['signup']['password'];

    //* ショップ登録処理
    $shop = new ShopLogic($shopName, $shopId, $shopemail, $shopPass);
    //* 登録成功判定
    if (!$createShop = $shop->createShop()) {
        unset($_SESSION['signup']);
        header('Location: ./admin_complete.php');
        exit;
    } else {
        //* 登録失敗処理
        $_SESSION['createShopError'] = "店舗登録ができません。\n最初からやり直して下さい。";
        unset($_SESSION['signup']);
        header('Location: ./admin_complete.php');
        exit;
    }
} else {
    //* complete.phpから遷移してきた場合の処理
    if (!isset($_SESSION['signup'])) {
        $error['common'] = '不正なアクセス';
    }
}

include('../_header.php');

?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>
<?php if (isset($error['common'])) : ?>
    <div class="alert alert-danger text-center" role="alert"><?= Utils::h($error['common']); ?></div>
    <div class="d-grid gap-2 p-2"><a class="btn btn-secondary rounded-pill" href="admin_signup.php">戻る</a></div>
<?php else : ?>
    <h1 class="h2 text-center p-3">店舗登録確認画面</h1>
    <div class="form-background mt-5">
        <form method="post">
            <table class="table bg-white mt-5">
                <tbody>
                    <tr>
                        <th scope="row">【1】店舗名</th>
                        <td><?= Utils::h($_SESSION['signup']['shop_name']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">【2】店舗ID</th>
                        <td><?= Utils::h($_SESSION['signup']['shop_id']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">【3】メールアドレス</th>
                        <td><?= Utils::h($_SESSION['signup']['email']); ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-grid gap-2 p-2">
                <button class="btn btn-primary rounded-pill" type="submit">予約確定</button>
                <a class="btn btn-secondary rounded-pill" href="admin_signup.php">戻る</a>
            </div>
        </form>
    </div>
<?php endif; ?>
    <?php
    include('../_footer.php');

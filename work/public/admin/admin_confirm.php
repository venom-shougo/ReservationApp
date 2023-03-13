<?php
require_once(__DIR__ . '/../../app/config.php');
include('../_header.php');
use Reservation\Shop\ShopLogic;


$error = [];

//* 確定ボタンが押されたらPOST判定
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //* セッションの値を変数に代入
    $shopName = $_SESSION['signup']['shop_name'];
    $shopId = $_SESSION['signup']['shop_id'];
    $shopemail = $_SESSION['signup']['email'];
    $shopPass = $_SESSION['signup']['password'];

    //* ショップ登録処理
    $shop = new ShopLogic($shopName, $shopId, $shopemail, $shopPass);
        if ($createShop = $shop->createShop()) {
            header('Location: ./admin_complete.php');
            exit;
        }
} else {
    echo '不正なアクセス';
}


?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">店舗登録確認画面</h1>
<div class="form-background mt-5">
    <form action="" method="post">
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
<?php
    include('../_footer.php');

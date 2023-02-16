<?php

require_once(__DIR__ . '/../../app/config.php');

use Reservation\Shop\ShopLogic;
use Reservation\DB\Database;
use Reservation\Validation\Validation as Vali;

$error =[];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $signup = $_POST;
    $shopName = $_POST['shop_name'];
    $shopId = $_POST['shop_id'];
    $shopemail = $_POST['email'];
    $shopPass = $_POST['password'];
    if (empty(Vali::validateSignup($signup))) {
        echo '検証エラーなし';
        //* バリデーションエラーが無かったらDBに同IDがないかバリデーション
        if ($db->identityValidation($signup['shop_id'])) {
            //* 同IDがあったらエラー表示
            $error['shop_id_error'] = 'IDがすでに使われています。違うIDを入力して下さい。';
        } else {
            //* 同IDがなかったらセッションにPOST値を代入しadminn_confirm.phpへ遷移
            $shop = new ShopLogic($shopName, $shopId, $shopemail, $shopPass);
            $createShop = $shop->createShop();
            echo '同じIDなし';
        }
    } else {
        //* 入力バリデーションエラーがあったらエラー表示
        $error = Vali::validateSignup($signup);
        echo '検証エラーあり';
    }
}

include('../_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">店舗新規登録</h1>
<div class="form-background mt-5">
    <form class="m-3" method="post">

        <div class="mb-3">
            <label for="validationServer01">【1】店舗名</label>
            <input type="text" class="form-control rounded-3 <?php if (isset($error['shop_name_error']))echo 'is-invalid'; ?>" name="shop_name" id="validationServer01" placeholder="店舗名">
            <div id="validationServer01Feedback" class="invalid-feedback"><?= Utils::h($error['shop_name_error']); ?></div>
        </div>

        <div class="mb-3">
            <label for="validationServer02">【2】店舗ID</label>
            <input type="text" class="form-control rounded-3 <?php if (isset($error['shop_id_error']))echo 'is-invalid'; ?>" name="shop_id" id="validationServer02" placeholder="店舗ID">
            <div id="validationServer02Feedback" class="invalid-feedback"><?= Utils::h($error['shop_id_error']); ?></div>
        </div>

        <div class="mb-3">
            <label for="validationServer03">【3】メールアドレス</label>
            <input type="text" class="form-control rounded-3 <?php if (isset($error['shop_email_err']))echo 'is-invalid'; ?>" name="email" id="validationServer03" placeholder="メールアドレス">
            <div id="validationServer03Feedback" class="invalid-feedback"><?= Utils::h($error['shop_email_err']); ?></div>
        </div>

        <div class="mb-3">
            <label for="validationServer04">【4】パスワード</label>
            <input type="password" class="form-control rounded-3 <?php if (isset($error['shop_password_error']))echo 'is-invalid'; ?>" name="password" id="validationServer04" placeholder="パスワード">
            <div id="validationServer04Feedback" class="invalid-feedback"><?= Utils::h($error['shop_password_error']); ?></div>
        </div>

        <div class="d-grid gap-2 p-2">
            <button class="btn btn-primary rounded-pill mb-1" type="submit">確認画面へ</button>
            <button class="btn btn-secondary rounded-pill" type="submit">戻る</button>
        </div>
    </form>
</div>

<?php
    include('../_footer.php');

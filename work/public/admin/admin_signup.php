<?php

require_once(__DIR__ . '/../../app/config.php');

use Reservation\DB\Database;
use Reservation\Validation\Validation as Vali;

unset($_SESSION['createShopError']);
$error =[];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $signup = $_POST;
    $shopName = $_POST['shop_name'];
    $shopId = $_POST['shop_id'];
    $shopEmail = $_POST['email'];
    $shopPass = $_POST['password'];
    if (empty(Vali::validateSignup($signup))) {
        //* バリデーションエラーが無かったらDBに同IDがないかバリデーション
        if ($db->identityValidation($signup['shop_id'])) {
            //* 同IDがあったらエラー表示
            $error['shop_id_error'] = 'IDがすでに使われています。違うIDを入力して下さい。';
        } else {
            //* 同IDがなかったらセッションにPOST値を代入しadminn_confirm.phpへ遷移
            $_SESSION['signup'] = $signup;
            header('Location: ./admin_confirm.php');
            exit;
        }
    } else {
        //* 入力バリデーションエラーがあったらエラー表示
        $error = Vali::validateSignup($signup);
        echo '検証エラーあり';
    }
} else {
    //* 店舗登録確認画面から戻ってきた場合の処理
    if (isset($_SESSION['signup'])) {
        $shopName = $_SESSION['signup']['shop_name'];
        $shopId = $_SESSION['signup']['shop_id'];
        $shopEmail = $_SESSION['signup']['email'];
    } else {
        //* 登録エラー、不正アクセスで戻ってきた時の処理
        $shopName = '';
        $shopId = '';
        $shopEmail = '';
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
            <input type="text" class="form-control rounded-3 <?php if (isset($error['shop_name_error']))echo 'is-invalid'; ?>" name="shop_name" id="validationServer01" placeholder="店舗名" value="<?php if (isset($shopName)); echo $shopName; ?>">
            <div id="validationServer01Feedback" class="invalid-feedback"><?= Utils::h($error['shop_name_error']); ?></div>
        </div>

        <div class="mb-3">
            <label for="validationServer02">【2】店舗ID</label>
            <input type="text" class="form-control rounded-3 <?php if (isset($error['shop_id_error']))echo 'is-invalid'; ?>" name="shop_id" id="validationServer02" placeholder="店舗ID" value="<?php if (isset($shopId)); echo $shopId; ?>">
            <div id="validationServer02Feedback" class="invalid-feedback"><?= Utils::h($error['shop_id_error']); ?></div>
        </div>

        <div class="mb-3">
            <label for="validationServer03">【3】メールアドレス</label>
            <input type="text" class="form-control rounded-3 <?php if (isset($error['shop_email_err']))echo 'is-invalid'; ?>" name="email" id="validationServer03" placeholder="メールアドレス" value="<?php if (isset($shopEmail)); echo $shopEmail; ?>">
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

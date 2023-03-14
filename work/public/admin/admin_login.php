<?php
require_once(__DIR__ . '/../../app/config.php');
use Reservation\DB\Database;
use Reservation\Validation\Validation as Vali;

//* ログイン済みの処理
if (isset($_SESSION['shop_user'])) {
    header('Location: ./admin_reserve_list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $loginId = $_POST['shop_id'];
    $loginPass = $_POST['password'];

    $error = [];
    //* ログインバリデーション
    if (empty($error = Vali::validateLogin($loginId, $loginPass))) {
        //* DBに登録されたショップと入力された値が一致したらログイン成功処理
        if ($shopUser = $db->shopLogin($loginId, $loginPass)) {
            $_SESSION['shop_user'] = $shopUser;
            //* ホーム画面へ遷移
            header('Location: ./admin_reserve_list.php');
            exit;
        } else {
            //* ショップが登録されてない処理
            $error['common'] = '店舗IDまたはパスワードが一致しません。';
        }
    }
} else {
    //* POST以外でアクセス時の処理
    $loginId = '';
    $loginPass = '';
}


include('../_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>
<h1 class="h2 text-center p-3">店舗ログイン画面</h1>
<div class="container form-background rounded-3">
    <?php if (isset($error['common'])) : ?>
        <div class="alert alert-danger text-center" role="alert"><?= Utils::h($error['common']); ?></div>
    <?php endif; ?>
    <form class="m-3 mt-5 p-2" method="post">
        <div class="mb-3">
            <label for="validationServer01">【1】店舗ID</label>
            <input type="text" class="form-control rounded-3 <?php if (isset($error['shop_id_error'])); echo 'is-invalid'; ?>" id="validationServer01" name="shop_id" placeholder="店舗ID" value="<?php if (isset($loginId)); echo Utils::h($loginId); ?>">
            <div id="validationServer01Feedback" class="invalid-feedback"><?= Utils::h($error['shop_id_error']); ?></div>
        </div>
        <div class="mb-3">
            <label for="validationServer02">【2】パスワード</label>
            <input type="password" class="form-control rounded-3 <?php if (isset($error['shop_password_error'])); echo 'is-invalid'; ?>" id="validationServer02" name="password" placeholder="パスワード">
            <div id="validationServer02Feedback" class="invalid-feedback"><?= Utils::h($error['shop_password_error']); ?></div>
        </div>
        <div class="d-grid gap-2 mx-4 p-2">
            <button class="btn btn-primary rounded-pill mb-1" type="submit">ログイン</button>
        </div>
    </form>
</div>
<?php
    include('../_footer.php');

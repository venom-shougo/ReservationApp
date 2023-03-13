<?php
require_once(__DIR__ . '/../../app/config.php');
include('../_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>
<?php if (isset($_SESSION['createShopError'])) : ?>
    <div class="alert alert-danger text-center" role="alert"><?= Utils::h($_SESSION['createShopError']); ?></div>
    <div class="d-grid gap-2 p-2"><a class="btn btn-secondary rounded-pill" href="admin_signup.php">戻る</a></div>
<?php else : ?>
<h1 class="h2 text-center p-3">店舗登録完了</h1>
<div class="container">

    <div class="card text-center mt-5">
        <div class="card-body">
            <i class="bi bi-check-lg complete-icon"></i>
            <h2 class="card-title">登録が完了しました</h2>
        </div>
        <div class="d-grid gap-2 mx-4 my-3">
            <a class="btn btn-primary rounded-pill mb-1" href="admin_login.php">ログインへ</a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
    include('../_footer.php');
// 店舗登録完了画面

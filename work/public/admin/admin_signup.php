<?php
include('../_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">店舗新規登録</h1>
<div class="form-background mt-5">
    <form class="m-3" action="admin_confirm.php" method="post">
        <div class="mb-3">
            <label for="floatingInput1">【1】店舗名</label>
            <input type="text" class="form-control rounded-3" id="floatingInput1" placeholder="店舗名">
        </div>
        <div class="mb-3">
            <label for="floatingInput2">【2】店舗ID</label>
            <input type="text" class="form-control rounded-3" id="floatingInput2" placeholder="店舗ID">
        </div>
        <div class="mb-3">
            <label for="floatingInput3">【3】メールアドレス</label>
            <input type="email" class="form-control rounded-3" id="floatingInput3" placeholder="メールアドレス">
        </div>
        <div class="mb-3">
            <label for="floatingInput4">【4】パスワード</label>
            <input type="password" class="form-control rounded-3" id="floatingInput4" placeholder="パスワード">
        </div>
        <div class="d-grid gap-2 p-2">
            <button class="btn btn-primary rounded-pill mb-1" type="submit">確認画面へ</button>
            <button class="btn btn-secondary rounded-pill" type="submit">戻る</button>
        </div>
    </form>
</div>
<?php
    include('../_footer.php');

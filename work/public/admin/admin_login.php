<?php
include('../_header.php');
?>
<header class="text-white bg-dark text-center p-3">SAMPEL SHOP</header>

<h1 class="h2 text-center p-3">店舗ログイン画面</h1>
<div class="container form-background">
    <form class="m-3 mt-5" action="admin_reserve_list.php" method="post">
        <div class="mb-3">
            <label for="floatingInput2">【1】店舗ID</label>
            <input type="text" class="form-control rounded-3" id="floatingInput2" placeholder="店舗ID">
        </div>
        <div class="mb-3">
            <label for="floatingInput4">【2】パスワード</label>
            <input type="password" class="form-control rounded-3" id="floatingInput4" placeholder="パスワード">
        </div>
        <div class="d-grid gap-2 mx-4 p-2">
            <button class="btn btn-primary rounded-pill mb-1" type="submit">ログイン</button>
        </div>
    </form>
</div>
<?php
    include('../_footer.php');
//
